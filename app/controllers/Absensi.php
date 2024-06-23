<?php

class Absensi extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Guru',  'Orang Tua'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }


    public function dataTables()
    {
        $utils = new Utils();
        $myProfile = $utils->myProfile();

        $userKelas = null;
        if (isset($_GET['userKelas'])) {
            $userKelas = ($_GET['userKelas']);
        }

        $users_id_siswa = null;
        $namaRoles = $myProfile['nama_roles'];
        if ($namaRoles == 'Orang Tua') {
            $users_id_siswa = $myProfile['users_id_siswa'];
        }

        $siswaModel = $this->model('Siswa_model');
        $dataAll = $siswaModel->getAll($users_id_siswa, $userKelas);
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a target="_blank" href="' . BASEURL . '/AbsensiSiswa?siswa_id=' . $value['id'] . '" class="btn btn-info btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';

            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . '
            </div>';
            $data[] = [
                'nama_profile' => $value['nama_profile'],
                'alamat_profile' => $value['alamat_profile'],
                'jeniskelamin_profile' => $value['jeniskelamin_profile'] == 'L' ? 'Laki-laki' : "Perempuan",
                'nomorhp_profile' => $value['nomorhp_profile'],
                'action' => $buttonAction,
            ];
        }

        $totalRecords = $dataCount;
        $recordsFiltered = $dataCount;
        $draw = isset($_GET['draw']) ? intval($_GET['draw']) : 0;
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        );

        echo json_encode($response);
    }
    public function index()
    {

        $kelasId = null;
        $userKelas = null;
        $rowKelas = null;
        if (isset($_GET['kelasId'])) {
            $kelasId = $_GET['kelasId'];
            $kelasSiswaModel = $this->model('KelasSiswa_model');
            $kelasModel = $this->model('Kelas_model');
            $getKelas = $kelasSiswaModel->getAll($kelasId);
            $userKelas = array_column($getKelas, 'users_id');
            $rowKelas = $kelasModel->getById($kelasId);
        }

        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Absensi', 'label' => 'Absensi'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        $data['rowKelas'] = $rowKelas;
        ob_start();
        include_once $this->view('app/absensi/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Absensi Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="userKelas" data-value="' . htmlspecialchars(json_encode($userKelas)) . '"></script>
        <script src="' . BASEURL . '/public/js/app/absensi/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }
}
