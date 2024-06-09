<?php

class Pengaturan extends Controller
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


    public function index()
    {
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Pengaturan', 'label' => 'Pengaturan'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        ob_start();
        include_once $this->view('app/pengaturan/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Pengaturan');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/pengaturan/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $action = BASEURL . '/pengaturan/store/';

        $pengaturanModel = $this->model('Pengaturan_model');
        $getAll = $pengaturanModel->getAll();
        if (count($getAll) > 0) {
            $action = BASEURL . '/pengaturan/update/' . $getAll[0]['id'];
        }

        $data['row'] = $pengaturanModel->getAll()[0];
        $data['action'] = $action;
        ob_start();
        include_once $this->view('app/pengaturan/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $gambar_pengaturan = Utils::uploadFile('gambar_pengaturan', 'uploads/pengaturan/', '');
            $data['gambar_pengaturan'] = $gambar_pengaturan;

            $pengaturanModel = $this->model('Pengaturan_model');
            $pengaturanModel->create($data);
            echo json_encode('Berhasil setting aplikasi');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;

            $pengaturanModel = $this->model('Pengaturan_model');
            $getData = $pengaturanModel->getById($id);

            $gambar_pengaturan = Utils::uploadFile('gambar_pengaturan', 'uploads/pengaturan/', $getData['gambar_pengaturan']);
            $data['gambar_pengaturan'] = $gambar_pengaturan;

            $pengaturanModel = $this->model('Pengaturan_model');
            $pengaturanModel->update($data, $id);
            echo json_encode('Berhasil setting aplikasi');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
