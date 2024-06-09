<?php

class Peran extends Controller
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
        $peranModel = $this->model('Peran_model');
        $dataAll = $peranModel->getAll();
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/Peran/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/Peran/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'nama_roles' => $value['nama_roles'],
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
            ['url' => BASEURL . '/Peran', 'label' => 'Peran'],
        ];
        $peranModel = $this->model('Peran_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $peranModel->getAll();
        ob_start();
        include_once $this->view('app/peran/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Peran');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/peran/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $peranModel = $this->model('Peran_model');

        $action = BASEURL . '/Peran/store/';
        $data['action'] = $action;

        ob_start();
        include_once $this->view('app/peran/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/Peran/update/' . $id;
        $peranModel = $this->model('Peran_model');

        $data['action'] = $action;
        $data['row'] = $peranModel->getById($id);
        ob_start();
        include_once $this->view('app/peran/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $peranModel = $this->model('Peran_model');
            $peranModel->create($data);
            echo json_encode('Berhasil menambahkan peran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $peranModel = $this->model('Peran_model');
            $peranModel->update($data, $id);
            echo json_encode('Berhasil mengubah peran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $peranModel = $this->model('Peran_model');
            $peranModel->delete($id);
            echo json_encode('Berhasil delete peran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
