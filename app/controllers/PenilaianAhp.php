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

        $data['alternatif'] = $this->model('Siswa_model')->getAll();
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
                        data-value=""
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

        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);

        $kriteria = $this->model('Kriteria_model')->getAll();
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
        $dataGet = $_GET;
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

        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);


        if ($dataGet['tipe'] == 'kriteria') {
            $data['kriteria'] = $this->model('Kriteria_model')->getAll();
            $pushKriteria = [];
            $dataKriteria = [];
            foreach ($data['kriteria'] as $key => $item) {
                $pushKriteria[$item['id']] = $item;
                $dataKriteria[$item['kode_kriteria']] = $item;
            }
            $data['kriteria'] = $pushKriteria;
            $data['toconvert_kriteria'] = $dataKriteria;

            $data['ahp_kriteria'] = $ahpKriteria;
        } else {
            $data['kriteria'] = $this->model('Kriteria_model')->getById($dataGet['kriteria_id']);
            $data['alternatif'] = $this->model('Siswa_model')->getAll();
            $pushAlternatif = [];
            $dataAlternatif = [];
            foreach ($data['alternatif'] as $key => $item) {
                $pushAlternatif[$item['id']] = $item;
                $dataAlternatif[$item['kode_profile']] = $item['nama_profile'];
            }
            $data['alternatif'] = $pushAlternatif;
            $data['toconvert_alternatif'] = $dataAlternatif;

            $data['ahp_alternatif'] = $ahpAlternatif[$dataGet['kriteria_id']];
        }

        return [
            'tipe' => $dataGet['tipe'],
            'data' => $data
        ];
    }
    public function resultAhp()
    {
        $resultAhp = $this->dataResultAhp();
        $tipe = $resultAhp['tipe'];
        $data = $resultAhp['data'];
        if ($tipe == 'kriteria') {
            ob_start();
            include_once $this->view('app/penilaianAhp/result', $data);
            $content = ob_get_clean();
            echo ($content);
        } else {
            ob_start();
            include_once $this->view('app/penilaianAhp/resultAhp', $data);
            $content = ob_get_clean();
            echo ($content);
        }
    }

    private function manageHasilAkhir()
    {
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

        $ahpAlternatif = count($dataAhpAlternatif) > 0 ? $dataAhpAlternatif : (isset($_SESSION['ahp_alternatif']) ? $_SESSION['ahp_alternatif'] : []);

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

        $data['alternatif'] = $this->model('Siswa_model')->getAll();
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
