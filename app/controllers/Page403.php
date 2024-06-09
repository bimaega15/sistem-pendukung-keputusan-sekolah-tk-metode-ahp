<?php

class Page403 extends Controller
{
    public function index()
    {
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Page403', 'label' => '403 Error Page'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        ob_start();
        include_once $this->view('app/page403/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Page 403');
        $template->assign('content', $content);

        $template->display($this->view('layouts/app'));
    }
}
