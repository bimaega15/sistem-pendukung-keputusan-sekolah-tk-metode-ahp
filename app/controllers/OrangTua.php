<?php

class OrangTua extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Admin'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }


    public function dataTables()
    {
        $OrangTuaModel = $this->model('OrangTua_model');
        $dataAll = $OrangTuaModel->getAll();
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/OrangTua/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/OrangTua/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
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
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/OrangTua', 'label' => 'OrangTua'],
        ];
        $OrangTuaModel = $this->model('OrangTua_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $OrangTuaModel->getAll();
        ob_start();
        include_once $this->view('app/orangTua/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Orang Tua');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/orangTua/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $OrangTuaModel = $this->model('OrangTua_model');

        $action = BASEURL . '/OrangTua/store/';
        $data['action'] = $action;

        ob_start();
        include_once $this->view('app/orangtua/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/OrangTua/update/' . $id;
        $OrangTuaModel = $this->model('OrangTua_model');

        $data['action'] = $action;
        $data['row'] = $OrangTuaModel->getById($id);
        ob_start();
        include_once $this->view('app/orangtua/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $OrangTuaModel = $this->model('OrangTua_model');
            $OrangTuaModel->create($data);
            echo json_encode('Berhasil menambahkan Orang Tua');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $OrangTuaModel = $this->model('OrangTua_model');
            $OrangTuaModel->update($data, $id);
            echo json_encode('Berhasil mengubah Orang Tua');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $OrangTuaModel = $this->model('OrangTua_model');
            $OrangTuaModel->delete($id);
            echo json_encode('Berhasil delete Orang Tua');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
