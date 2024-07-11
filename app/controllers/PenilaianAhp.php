<?php

use Dompdf\Dompdf;

class PenilaianAhp extends Controller
{
    public $datastatis = [];
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();
        require_once './app/config/datastatis.php';
        $this->datastatis = $data['statis'];

        $allowMyProfile = ['Orang Tua'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }

    public function index()
    {
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        $namaRoles = $myProfile['nama_roles'];

        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/PenilaianAhp', 'label' => 'Penilaian AHP'],
        ];

        $valueMatriks = [];
        $valueMatriksAlternatif = [];

        $dataKriteria = [];
        $data['kriteria'] = $this->model('Kriteria_model')->getAll();
        foreach ($data['kriteria'] as $key1 => $item1) {
            foreach ($data['kriteria'] as $key2 => $item2) {

                $nilai = null;
                $kriteria_id1 = $item1['id'];
                $kriteria_id2 = $item2['id'];

                $dataMatriksKriteria = json_decode($this->model('MatriksAhp_model')->getAhpKriteria(), true);
                if ($dataMatriksKriteria != null) {
                    $dataSelected = $dataMatriksKriteria['matriks_perbandingan_original'][$kriteria_id1][$kriteria_id2] ?? '';
                } else {
                    $dataSelected = $_SESSION['ahp_kriteria']['matriks_perbandingan_original'][$kriteria_id1][$kriteria_id2] ?? '';
                }

                if ($key1 == $key2) {
                    $nilai = '<span 
                    data-kriteria_id1="' . $item1['id'] . '"
                    data-kriteria_id2="' . $item2['id'] . '"
                    data-row="' . $key1 . '" data-column="' . $key2 . '" 
                    data-value="1"
                    class="invers_matrix data_matriks">
                    1
                    </span>';
                }

                if ($key2 > $key1) {

                    $nilai = '
                    <select name="select_matrix" class="form-control data_matriks"
                    data-kriteria_id1="' . $item1['id'] . '"
                    data-kriteria_id2="' . $item2['id'] . '"
                    data-value="' . $dataSelected . '"
                    data-row="' . $key1 . '" data-column="' . $key2 . '">
                        <option value="">-- Pilih Value --</option>';
                    foreach ($this->datastatis['matriks'] as $value => $item) {
                        $selectedData = strval($value) == $dataSelected ? 'selected' : '';
                        $nilai .= '<option value="' . $value . '" ' . $selectedData . '>' . $item . '</option>';
                    }
                    $nilai .= '
                    </select>';
                }

                if ($key1 != $key2) {
                    if ($key1 > $key2) {
                        $nilai = '<span 
                        data-kriteria_id1="' . $item1['id'] . '"
                        data-kriteria_id2="' . $item2['id'] . '"
                        data-row="' . $key1 . '" data-column="' . $key2 . '" 
                        data-value="' . $dataSelected . '"
                        class="invers_matrix data_matriks">
                        ' . $dataSelected . '
                        </span>';
                    }
                }

                $valueMatriks[$item1['kode_kriteria']][$key2] = $nilai;
            }

            $dataKriteria[$item1['kode_kriteria']] = $item1['nama_kriteria'];
        }

        $data['alternatif'] = $this->model('Siswa_model')->getAll(null, null, true);
        $dataAlternatif = [];
        foreach ($data['alternatif'] as $key1 => $item1) {
            foreach ($data['alternatif'] as $key2 => $item2) {
                $nilai = null;
                $alternatif_id1 = $item1['id'];
                $alternatif_id2 = $item2['id'];

                if ($key1 == $key2) {
                    $nilai = '<span 
                    data-alternatif_id1="' . $item1['id'] . '"
                    data-alternatif_id2="' . $item2['id'] . '"
                    data-row="' . $key1 . '" data-column="' . $key2 . '" 
                    data-value="1"
                    class="invers_matrix data_matriks">
                    1
                    </span>';
                }

                if ($key2 > $key1) {
                    $nilai = '
                    <select name="select_matrix" class="form-control data_matriks"
                    data-alternatif_id1="' . $item1['id'] . '"
                    data-alternatif_id2="' . $item2['id'] . '"
                    data-value="' . $dataSelected . '"
                    data-row="' . $key1 . '" data-column="' . $key2 . '">
                        <option value="">-- Pilih Value --</option>';
                    foreach ($this->datastatis['matriks'] as $value => $item) {
                        $nilai .= '<option value="' . $value . '">' . $item . '</option>';
                    }
                    $nilai .= '
                    </select>';
                }

                if ($key1 != $key2) {
                    if ($key1 > $key2) {
                        $nilai = '<span 
                        data-alternatif_id1="' . $item1['id'] . '"
                        data-alternatif_id2="' . $item2['id'] . '"
                        data-row="' . $key1 . '" data-column="' . $key2 . '" 
                        data-value="' . $dataSelected . '"
                        class="invers_matrix data_matriks">
                        ' . $dataSelected . '
                        </span>';
                    }
                }

                $valueMatriksAlternatif[$item1['kode_profile']][$key2] = $nilai;
            }
            $dataAlternatif[$item1['kode_profile']] = $item1['nama_profile'];
        }

        $data['toconvert_alternatif'] = $dataAlternatif;
        $data['value_matrix'] = $valueMatriks;
        $data['value_matrix_alternatif'] = $valueMatriksAlternatif;
        $data['toconvert_kriteria'] = $dataKriteria;
        $data['breadcrumbs'] = $breadcrumbItems;
        $data['namaRoles'] = $namaRoles;
        ob_start();
        include_once $this->view('app/penilaianAhp/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Penilaian AHP');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/penilaianAhp/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function resultDataAhp()
    {
        //1 Mengambil matriks kriteria dari model MatriksAhp_model dan mendekode data JSON menjadi array asosiatif
        $dataMatriksKriteria = json_decode($this->model('MatriksAhp_model')->getAhpKriteria(), true);

        //2 Mengambil matriks alternatif dari model MatriksAlternatif_model
        $dataMatriksAlternatif = $this->model('MatriksAlternatif_model')->getAhpAlternatif();

        //3 Inisialisasi array untuk menyimpan data AHP Alternatif
        $dataAhpAlternatif = [];

        if ($dataMatriksAlternatif) {
            //4 Memproses setiap item dalam data matriks alternatif
            foreach ($dataMatriksAlternatif as $key => $item) {
                //5 Mendekode data JSON AHP Alternatif menjadi array asosiatif
                $getAhpAlternatif = json_decode($item['ahp_alternatif'], true);

                //6 Memasukkan data AHP Alternatif ke dalam array $dataAhpAlternatif
                foreach ($getAhpAlternatif as $alternatif_id => $itemValue) {
                    //7
                    $dataAhpAlternatif[$alternatif_id] = $itemValue;
                }
            }
        }

        //8 Mengatur variabel $ahpKriteria menggunakan data matriks kriteria atau dari sesi jika tidak tersedia
        $ahpKriteria = $dataMatriksKriteria !== null ? $dataMatriksKriteria : (isset($_SESSION['ahp_kriteria']) ? $_SESSION['ahp_kriteria'] : []);

        //9 Mengatur variabel $ahpAlternatif menggunakan data AHP Alternatif atau dari sesi jika tidak tersedia
        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);

        //10 Mengambil semua data kriteria dari model Kriteria_model
        $kriteria = $this->model('Kriteria_model')->getAll();

        //11 Menyusun data yang akan dikirim sebagai JSON response
        echo json_encode([
            'ahp_kriteria' => $ahpKriteria,
            'ahp_alternatif' => $ahpAlternatif,
            'kriteria' => $kriteria,
        ]);
    }


    public function initialData()
    {
        echo json_encode([
            'data_statis' => $this->datastatis,
        ]);
    }

    public function prosesAhp()
    {
        $data = $_POST;
        $output = Utils::perhitunganAHP($data, $this->datastatis);
        $dataOutput = json_encode($output);
        if ($data['is_kriteria']) {
            $this->model('MatriksAhp_model')->updateMatriksKriteria($dataOutput);
            $_SESSION['ahp_kriteria'] = $output;
        } else {
            $kriteria_id = $data['kriteria_id'];
            $setOutput[$data['kriteria_id']] = $output;
            $setOutput = json_encode($setOutput);
            $this->model('MatriksAlternatif_model')->updateMatriksAlternatif($kriteria_id, $setOutput);

            $_SESSION['ahp_alternatif'][$data['kriteria_id']] = $output;
        }
        echo json_encode($data);
    }

    private function dataResultAhp()
    {
        // Mengambil semua data dari URL query string (GET request)
        $dataGet = $_GET;

        // Mengambil data AHP Kriteria dari model dan mendekodenya dari format JSON menjadi array asosiatif
        $dataMatriksKriteria = json_decode($this->model('MatriksAhp_model')->getAhpKriteria(), true);

        // Mengambil data AHP Alternatif dari model
        $dataMatriksAlternatif = $this->model('MatriksAlternatif_model')->getAhpAlternatif();

        // Inisialisasi array untuk menyimpan data AHP Alternatif
        $dataAhpAlternatif = [];

        // Memproses setiap item dalam data AHP Alternatif
        if ($dataMatriksAlternatif) {
            foreach ($dataMatriksAlternatif as $key => $item) {
                // Mendekode data AHP Alternatif dari format JSON menjadi array asosiatif
                $getAhpAlternatif = json_decode($item['ahp_alternatif'], true);

                // Memasukkan data AHP Alternatif ke dalam array $dataAhpAlternatif
                foreach ($getAhpAlternatif as $alternatif_id => $itemValue) {
                    $dataAhpAlternatif[$alternatif_id] = $itemValue;
                }
            }
        }

        // Jika data AHP Kriteria tidak null, gunakan data tersebut; jika tidak, cek sesi untuk data AHP Kriteria
        $ahpKriteria = $dataMatriksKriteria !== null ? $dataMatriksKriteria : (isset($_SESSION['ahp_kriteria']) ? $_SESSION['ahp_kriteria'] : []);

        // Jika ada data AHP Alternatif, gunakan data tersebut; jika tidak, cek sesi untuk data AHP Alternatif
        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);

        // Jika tipe data yang diminta adalah 'kriteria'
        if ($dataGet['tipe'] == 'kriteria') {
            // Mengambil semua data kriteria dari model
            $data['kriteria'] = $this->model('Kriteria_model')->getAll();

            // Inisialisasi array untuk menyimpan data kriteria yang diproses
            $pushKriteria = [];
            $dataKriteria = [];

            // Memproses setiap item dalam data kriteria
            foreach ($data['kriteria'] as $key => $item) {
                $pushKriteria[$item['id']] = $item;
                $dataKriteria[$item['kode_kriteria']] = $item;
            }

            // Menyimpan data kriteria yang diproses ke dalam array $data
            $data['kriteria'] = $pushKriteria;
            $data['toconvert_kriteria'] = $dataKriteria;

            // Menyimpan data AHP Kriteria ke dalam array $data
            $data['ahp_kriteria'] = $ahpKriteria;
        } else {
            // Jika tipe data yang diminta adalah 'alternatif'
            // Mengambil data kriteria berdasarkan ID dari model
            $data['kriteria'] = $this->model('Kriteria_model')->getById($dataGet['kriteria_id']);

            // Mengambil semua data alternatif dari model
            $data['alternatif'] = $this->model('Siswa_model')->getAll(null, null, true);

            // Inisialisasi array untuk menyimpan data alternatif yang diproses
            $pushAlternatif = [];
            $dataAlternatif = [];

            // Memproses setiap item dalam data alternatif
            foreach ($data['alternatif'] as $key => $item) {
                $pushAlternatif[$item['id']] = $item;
                $dataAlternatif[$item['kode_profile']] = $item['nama_profile'];
            }

            // Menyimpan data alternatif yang diproses ke dalam array $data
            $data['alternatif'] = $pushAlternatif;
            $data['toconvert_alternatif'] = $dataAlternatif;

            // Menyimpan data AHP Alternatif untuk kriteria tertentu ke dalam array $data
            $data['ahp_alternatif'] = $ahpAlternatif[$dataGet['kriteria_id']];
        }

        // Mengembalikan array yang berisi tipe data dan data yang telah diproses
        return [
            'tipe' => $dataGet['tipe'],
            'data' => $data
        ];
    }

    public function resultAhp()
    {
        // Memanggil metode dataResultAhp() dan menyimpan hasilnya ke variabel $resultAhp
        $resultAhp = $this->dataResultAhp();

        // Mengambil nilai 'tipe' dari hasil $resultAhp dan menyimpannya ke variabel $tipe
        $tipe = $resultAhp['tipe'];

        // Mengambil nilai 'data' dari hasil $resultAhp dan menyimpannya ke variabel $data
        $data = $resultAhp['data'];

        // Memeriksa apakah tipe adalah 'kriteria'
        if ($tipe == 'kriteria') {
            // Memulai output buffering
            ob_start();

            // Menyertakan file view dengan data yang diberikan
            include_once $this->view('app/penilaianAhp/result', $data);

            // Mengambil konten dari buffer
            $content = ob_get_clean();

            // Menampilkan konten
            echo ($content);
        } else {
            // Memulai output buffering
            ob_start();

            // Menyertakan file view dengan data yang diberikan
            include_once $this->view('app/penilaianAhp/resultAhp', $data);

            // Mengambil konten dari buffer
            $content = ob_get_clean();

            // Menampilkan konten
            echo ($content);
        }
    }


    private function manageHasilAkhir()
    {
        //mengambilkan semua data kriteria dan alternatif
        $dataMatriksKriteria = json_decode($this->model('MatriksAhp_model')->getAhpKriteria(), true);
        $dataMatriksAlternatif = $this->model('MatriksAlternatif_model')->getAhpAlternatif();
        $dataAhpAlternatif = [];
        foreach ($dataMatriksAlternatif as $key => $item) {
            $getAhpAlternatif = json_decode($item['ahp_alternatif'], true);
            foreach ($getAhpAlternatif as $alternatif_id => $itemValue) {
                $dataAhpAlternatif[$alternatif_id] = $itemValue;
            }
        }

        $ahpKriteria = $dataMatriksKriteria !== null ? $dataMatriksKriteria : (isset($_SESSION['ahp_kriteria']) ? $_SESSION['ahp_kriteria'] : []);
        if(count($ahpKriteria) == 0){
            http_response_code(400);
            echo json_encode('Data Kriteria Belum Di Proses');
            exit;
        }

        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);
        if(count($ahpAlternatif) == 0){
            http_response_code(400);
            echo json_encode('Data Alternatif Belum Di Proses');
            exit;
        }

        $data['ahp_kriteria'] = $ahpKriteria;
        $data['ahp_alternatif'] = $ahpAlternatif;
        $data['kriteria'] = $this->model('Kriteria_model')->getAll();
        $pushKriteria = [];
        $save_hasil_akhir = [];
        $dataKriteria = [];
        foreach ($data['kriteria'] as $key => $item) {
            $pushKriteria[$item['id']] = $item;
            $dataKriteria[$item['kode_kriteria']] = $item['nama_kriteria'];
        }
        $data['kriteria'] = $pushKriteria;
        $data['toconvert_kriteria'] = $dataKriteria;
        $pushAlternatif = [];
        foreach ($data['ahp_alternatif'] as $kriteria_id => $jenis) {
            foreach ($jenis as $keyJenis => $itemAlternatif) {
                if ($keyJenis === 'perhitungan_bobot_prioritas') {
                    foreach ($itemAlternatif as $alternatifId => $value) {
                        $pushAlternatif[$alternatifId][$kriteria_id] = $value;
                    }
                }
            }
        }
        $data['bobot_alternatif'] = $pushAlternatif;
        $save_hasil_akhir['bobot_alternatif'] = $pushAlternatif;

        $data['alternatif'] = $this->model('Siswa_model')->getAll(null, null, true);
        $pushDataAlternatif = [];
        foreach ($data['alternatif'] as $key => $item) {
            $pushDataAlternatif[$item['id']] = $item;
        }
        $data['alternatif'] = $pushDataAlternatif;


        $pushNewBobot = [];
        foreach ($data['bobot_alternatif'] as $alternatifId => $itemKriteria) {
            foreach ($itemKriteria as $kriteria_id => $value) {
                $bobotKriteria = $data['ahp_kriteria']['perhitungan_bobot_prioritas'][$kriteria_id];
                $calculate = $value * $bobotKriteria;
                $pushNewBobot[$alternatifId][$kriteria_id] = $calculate;
            }
        }
        $data['bobot_akhir'] = $pushNewBobot;
        $save_hasil_akhir['bobot_akhir'] = $pushNewBobot;

        $sumBobot = [];
        foreach ($pushNewBobot as $alternatif_id => $item) {
            $sumBobot[$alternatif_id] = array_sum($item);
        }

        $hasilBobot = $sumBobot;
        $data['hasil_bobot'] = $hasilBobot;
        $save_hasil_akhir['hasil_bobot'] = $hasilBobot;

        $data['ranking'] = $hasilBobot;
        arsort($data['ranking']);
        $save_hasil_akhir['ranking'] = $data['ranking'];
        $_SESSION['hasil_akhir'] = $save_hasil_akhir;
        $dataHasilAkhir = json_encode($save_hasil_akhir);
        $this->model('HasilAkhir_model')->updateHasilAkhir($dataHasilAkhir);

        return $data;
    }

    public function lastResultAhp()
    {
        $data = $this->manageHasilAkhir();
        ob_start();
        include_once $this->view('app/penilaianAhp/lastResultAhp', $data);
        $content = ob_get_clean();
        echo ($content);
    }
    public function lastResultAhpPdf()
    {
        $dompdf = new Dompdf();

        $data = $this->manageHasilAkhir();
        $html = '';
        ob_start();
        include_once $this->view('app/penilaianAhp/print/lastResultAhp', $data);
        $html = ob_get_clean();


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('document.pdf', [
            'Attachment' => 0
        ]);
    }

    public function resultAhpPdf()
    {
        $dompdf = new Dompdf();

        $resultAhp = $this->dataResultAhp();
        $tipe = $resultAhp['tipe'];
        $data = $resultAhp['data'];

        $html = '';
        if ($tipe == 'kriteria') {
            ob_start();
            include_once $this->view('app/penilaianAhp/print/result', $data);
            $html = ob_get_clean();
        } else {
            ob_start();
            include_once $this->view('app/penilaianAhp/print/resultAhp', $data);
            $html = ob_get_clean();
        }

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('document.pdf', [
            'Attachment' => 0
        ]);
    }
}
