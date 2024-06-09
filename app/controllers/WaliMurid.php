<?php

class WaliMurid extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Guru'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }


    public function dataTables()
    {
        $waliMuridModel = $this->model('WaliMurid_model');
        $dataAll = $waliMuridModel->getAll();
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/WaliMurid/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/WaliMurid/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
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
            ['url' => BASEURL . '/WaliMurid', 'label' => 'Wali Murid'],
        ];
        $waliMuridModel = $this->model('WaliMurid_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $waliMuridModel->getAll();
        ob_start();
        include_once $this->view('app/waliMurid/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman WaliMurid');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/waliMurid/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $waliMuridModel = $this->model('WaliMurid_model');

        $action = BASEURL . '/WaliMurid/store/';
        $data['action'] = $action;

        ob_start();
        include_once $this->view('app/waliMurid/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/WaliMurid/update/' . $id;
        $waliMuridModel = $this->model('WaliMurid_model');

        $data['action'] = $action;
        $data['row'] = $waliMuridModel->getById($id);
        ob_start();
        include_once $this->view('app/waliMurid/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $waliMuridModel = $this->model('WaliMurid_model');
            $waliMuridModel->create($data);
            echo json_encode('Berhasil menambahkan waliMurid');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $waliMuridModel = $this->model('WaliMurid_model');
            $waliMuridModel->update($data, $id);
            echo json_encode('Berhasil mengubah waliMurid');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $waliMuridModel = $this->model('WaliMurid_model');
            $waliMuridModel->delete($id);
            echo json_encode('Berhasil delete waliMurid');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
