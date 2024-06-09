<?php

class Profile extends Controller
{
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
    }


    public function index()
    {
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Profile', 'label' => 'My Profile'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        ob_start();
        include_once $this->view('app/myProfile/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman My Profile');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/myProfile/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }

    public function output()
    {
        ob_start();
        include_once $this->view('app/myProfile/output');
        $content = ob_get_clean();

        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/Profile/update/' . $id;
        $data['action'] = $action;
        ob_start();
        include_once $this->view('app/myProfile/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $siswaModel = $this->model('Users_model');
            $siswaModel->update($data, $id);
            echo json_encode('Berhasil mengubah profile');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
