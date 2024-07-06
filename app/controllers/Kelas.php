<?php


class Kelas extends Controller
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
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        $usersId = null;
        $namaRoles = $myProfile['nama_roles'];

        if ($namaRoles == 'Guru') {
            $usersId = $myProfile['id'];
        }
        $KelasModel = $this->model('Kelas_model');
        $dataAll = $KelasModel->getAll($usersId);
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/Kelas/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/Kelas/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'tingkat_kelas' => $value['tingkat_kelas'],
                'nama_kelas' => $value['nama_kelas'],
                'nama_profile' => $value['nama_profile'],
                'jumlah_siswa' => '
                    <a target="_blank" href="' . BASEURL . '/KelasSiswa?kelas_id=' . $value['id'] . '" class="badge badge-success w-100">
                        <i class="fa-solid fa-users"></i> ' . $value['jumlah_siswa'] . ' Siswa
                    </a>',
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
        $util = new Utils();
        $myProfile = $util->myProfile();
        $namaRoles = $myProfile['nama_roles'];
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Kelas', 'label' => 'Kelas'],
        ];
        $KelasModel = $this->model('Kelas_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $KelasModel->getAll();
        $data['namaRoles'] = $namaRoles;
        ob_start();
        include_once $this->view('app/kelas/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Kelas');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="namaRoles" data-value="' . $namaRoles . '"></script>
        <script src="' . BASEURL . '/public/js/app/kelas/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $action = BASEURL . '/Kelas/store/';
        $data['action'] = $action;
        // $data['kelas'] = $this->datastatis['kelas'];
        ob_start();
        include_once $this->view('app/kelas/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/Kelas/update/' . $id;
        $KelasModel = $this->model('Kelas_model');

        $data['action'] = $action;
        $data['row'] = $KelasModel->getById($id);
        ob_start();
        include_once $this->view('app/kelas/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $KelasModel = $this->model('Kelas_model');
            $KelasModel->create($data);
            echo json_encode('Berhasil menambahkan Kelas');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $KelasModel = $this->model('Kelas_model');
            $KelasModel->update($data, $id);
            echo json_encode('Berhasil mengubah Kelas');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $KelasModel = $this->model('Kelas_model');
            $KelasModel->delete($id);
            echo json_encode('Berhasil delete Kelas');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
