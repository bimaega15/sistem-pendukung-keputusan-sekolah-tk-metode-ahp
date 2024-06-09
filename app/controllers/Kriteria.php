<?php

class Kriteria extends Controller
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
        $kriteriaModel = $this->model('Kriteria_model');
        $dataAll = $kriteriaModel->getAll();
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/Kriteria/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/Kriteria/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'kode_kriteria' => $value['kode_kriteria'],
                'nama_kriteria' => $value['nama_kriteria'],
                'keterangan_kriteria' => $value['keterangan_kriteria'],
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
            ['url' => BASEURL . '/Kriteria', 'label' => 'Kriteria'],
        ];
        $kriteriaModel = $this->model('Kriteria_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $kriteriaModel->getAll();
        ob_start();
        include_once $this->view('app/kriteria/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Kriteria');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/kriteria/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $kriteriaModel = $this->model('Kriteria_model');

        $action = BASEURL . '/Kriteria/store/';
        $data['action'] = $action;
        $data['max_kode'] = $kriteriaModel->getKode();

        ob_start();
        include_once $this->view('app/kriteria/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/Kriteria/update/' . $id;
        $kriteriaModel = $this->model('Kriteria_model');

        $data['action'] = $action;
        $data['row'] = $kriteriaModel->getById($id);
        $data['max_kode'] = $kriteriaModel->getKode();
        ob_start();
        include_once $this->view('app/kriteria/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $kriteriaModel = $this->model('Kriteria_model');
            $kriteriaModel->create($data);
            echo json_encode('Berhasil menambahkan kriteria');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $kriteriaModel = $this->model('Kriteria_model');
            $kriteriaModel->update($data, $id);
            echo json_encode('Berhasil mengubah kriteria');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $kriteriaModel = $this->model('Kriteria_model');
            $kriteriaModel->delete($id);
            echo json_encode('Berhasil delete kriteria');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
