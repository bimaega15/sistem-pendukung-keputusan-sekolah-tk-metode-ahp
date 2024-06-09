<?php

class Login extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->alreadyLogin();
    }

    public function index()
    {
        $template = new Template();
        ob_start();
        require_once $this->view('home/index');
        $content = ob_get_clean();

        $template->assign('title', 'Halaman Login');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/home/index.js"></script>');
        $template->display($this->view('layouts/template'));
    }

    public function store()
    {
        $data = $_POST;
        $users = $this->model('Users_model');
        $login = $users->login($data);
        if ($login) {
            $password = $login['password_users'];
            
            if ($password == md5($data['password_users'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['users_id'] = $login['id'];

                if (isset($data['remember_users'])) {
                    $remember_token = bin2hex(random_bytes(16));
                    $token_expiration = time() + (7 * 24 * 60 * 60);
                    $users->setRememberToken($login['id'], $remember_token, $token_expiration);
                    setcookie('remember_token', $remember_token, time() + $token_expiration, "/", null, null, true);
                }
                $utils = new Utils();

                echo json_encode([
                    'status' => true,
                    'title' => 'Successfully',
                    'message' => 'Berhasil login',
                    'result' => $utils->myProfile(),
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'title' => 'Failed',
                    'message' => 'Password anda salah',
                ]);
            }
        } else {
            echo json_encode([
                'status' => false,
                'title' => 'Failed',
                'message' => 'Username atau email anda salah',
            ]);
        }
    }
}
