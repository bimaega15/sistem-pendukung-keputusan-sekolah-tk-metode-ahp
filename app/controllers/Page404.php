<?php

class Page404 extends Controller
{
    public function index()
    {
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Page404', 'label' => '404 Error Page'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        ob_start();
        include_once $this->view('app/page404/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Page 404');
        $template->assign('content', $content);

        $template->display($this->view('layouts/app'));
    }
}
