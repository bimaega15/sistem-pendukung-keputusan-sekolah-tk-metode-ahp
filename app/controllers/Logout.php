<?php

class Logout extends Controller
{
    public function index()
    {
        unset($_SESSION['logged_in']);
        unset($_SESSION['users_id']);
        session_destroy();

        setcookie('remember_token', '', time() - 3600, '/', null, null, true);

        header('Location: ' . BASEURL . '/');
        exit;
    }
}
