<?php

class Register extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->alreadyLogin();
    }

    public function index()
    {
        $siswaModel = $this->model('Siswa_model');
        $getKode = $siswaModel->getKode();

        $data['kode_profile'] = $getKode;
        $template = new Template();
        ob_start();
        require_once $this->view('register/index');
        $content = ob_get_clean();

        $template->assign('title', 'Halaman Register');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/register/index.js"></script>');
        $template->display($this->view('layouts/template'));
    }

    public function store()
    {
        try {
            $data = $_POST;
            $siswaModel = $this->model('Siswa_model');
            $siswaModel->create($data);
            echo json_encode('Berhasil menambahkan siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
