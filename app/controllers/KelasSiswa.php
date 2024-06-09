<?php


class KelasSiswa extends Controller
{
    private $datastatis;
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Admin', 'Guru'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }

        require_once './app/config/datastatis.php';
        $this->datastatis = $data['statis'];
    }


    public function dataTables()
    {
        $util = new Utils();
        $myProfile = $util->myProfile();
        $namaRoles = $myProfile['nama_roles'];

        $kelas_id = $_GET['kelas_id'];
        $KelasSiswaModel = $this->model('KelasSiswa_model');
        $dataAll = $KelasSiswaModel->getAll($kelas_id);
        $dataCount = count($dataAll);

        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonActionDeleteEdit = '
            <a class="dropdown-item btn-edit" href="' . BASEURL . '/KelasSiswa/edit/' . $value['id'] . '?kelas_id=' . $kelas_id . '"><i class="fa-regular fa-circle"></i> Edit</a>
            <a class="dropdown-item btn-delete" href="' . BASEURL . '/KelasSiswa/delete/' . $value['id'] . '"><i class="fa-regular fa-circle"></i> Delete</a>
            ';

            $buttonPenilaian = '<a class="dropdown-item" href="' . BASEURL . '/AbsensiSiswa?siswa_id=' . $value['users_id'] . '" target="_blank"><i class="fa-regular fa-circle"></i> Absensi Siswa</a>
            <a class="dropdown-item" href="' . BASEURL . '/PenilaianSiswa?siswa_id=' . $value['users_id'] . '" target="_blank"><i class="fa-regular fa-circle"></i> Nilai Siswa</a>';

            $buttonAction = '
        <div class="text-center">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu">';
            if ($namaRoles == 'Admin') {
                $buttonAction .= $buttonActionDeleteEdit;
            }
            if ($namaRoles == 'Guru') {
                $buttonAction .= $buttonPenilaian;
            }
            $buttonAction .= '
                </div>
            </div>
        </div>';
            $data[] = [
                'kode_profile' => $value['kode_profile'],
                'nama_profile' => $value['nama_profile'],
                'jeniskelamin_profile' => $value['jeniskelamin_profile'],
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
        $utils = new Utils();
        $myProfile = $utils->myProfile();

        $template = new Template();
        // breadcrumbs
        $kelas_id = $_GET['kelas_id'];
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Kelas', 'label' => 'Kelas'],
            ['url' => BASEURL . '/KelasSiswa?kelas_id=' . $kelas_id, 'label' => 'Kelas Siswa'],
        ];
        $KelasSiswaModel = $this->model('KelasSiswa_model');
        $KelasModel = $this->model('Kelas_model');

        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $KelasSiswaModel->getAll($kelas_id);
        $data['kelas'] = $KelasModel->getById($kelas_id);
        $data['kelas_id'] = $kelas_id;
        $data['nama_roles'] = $myProfile['nama_roles'];

        ob_start();
        include_once $this->view('app/kelasSiswa/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Kelas Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="kelas_id" data-value="' . $kelas_id . '"></script>
        <script src="' . BASEURL . '/public/js/app/kelasSiswa/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $kelas_id = $_GET['kelas_id'];

        $action = BASEURL . '/KelasSiswa/store/';
        $data['action'] = $action;
        $data['kelas_id'] = $kelas_id;
        ob_start();
        include_once $this->view('app/kelasSiswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }


    public function edit($id)
    {
        $kelas_id = $_GET['kelas_id'];
        $action = BASEURL . '/KelasSiswa/update/' . $id;
        $KelasSiswaModel = $this->model('KelasSiswa_model');

        $data['action'] = $action;
        $data['row'] = $KelasSiswaModel->getById($id, $kelas_id);
        $data['kelas_id'] = $kelas_id;

        ob_start();
        include_once $this->view('app/kelasSiswa/formEdit', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function getData()
    {
        $kelas_id = $_GET['kelas_id'];
        $id = $_GET['id'];
        $KelasSiswaModel = $this->model('KelasSiswa_model');
        $data['row'] = $KelasSiswaModel->getById($id, $kelas_id);
        echo json_encode($data);
    }

    public function store()
    {
        try {
            $data = $_POST;
            $KelasSiswaModel = $this->model('KelasSiswa_model');
            $KelasSiswaModel->create($data);
            echo json_encode('Berhasil menambahkan Kelas Siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $users_id = $data['users_id'];
            $kelas_id = $data['kelas_id'];
            $users_id_now = $data['users_id_now'];

            $KelasSiswaModel = $this->model('KelasSiswa_model');
            $checkSiswa = $KelasSiswaModel->checkSiswa($users_id, $kelas_id, $users_id_now);

            if ($checkSiswa > 0) {
                header('HTTP/1.1 400 Bad Request');
                throw new Exception('Siswa sudah terdaftar dalam kelas ini.');
            }

            $KelasSiswaModel->update($data, $id);
            echo json_encode('Berhasil mengubah Kelas Siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $KelasSiswaModel = $this->model('KelasSiswa_model');
            $KelasSiswaModel->delete($id);
            echo json_encode('Berhasil delete Kelas Siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function getDataKelas()
    {
        $kelas_id = $_GET['kelas_id'];
        $KelasSiswaModel = $this->model('KelasSiswa_model');
        $dataAll = $KelasSiswaModel->getAll($kelas_id);
        $dataUsers = array_column($dataAll, 'users_id');
        $data['row'] =  $dataUsers;
        echo json_encode($data);
    }
}
