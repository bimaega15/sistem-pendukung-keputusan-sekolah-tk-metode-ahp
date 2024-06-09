<?php

class PerkembanganNilai extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Guru', 'Wali Murid','Orang Tua'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }

    public function index()
    {
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        $namaRoles = $myProfile['nama_roles'];

        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Perkembangan Nilai', 'label' => 'Perkembangan Nilai'],
        ];

        $dataHasilAkhir = $this->model('HasilAkhir_model')->getHasilAkhir();
        $hasilAkhir = $dataHasilAkhir != null ? json_decode($dataHasilAkhir, true) : ($_SESSION['hasil_akhir'] ?? '');
        $data['breadcrumbs'] = $breadcrumbItems;
        $data['hasil_akhir'] = $hasilAkhir;
        $data['namaRoles'] = $namaRoles;

        ob_start();
        include_once $this->view('app/perkembanganNilai/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Perkembangan Nilai');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/perkembanganNilai/index.js"></script>');

        $template->display($this->view('layouts/app'));
    }

    public function loadData()
    {
        $dataHasilAkhir = $this->model('HasilAkhir_model')->getHasilAkhir();
        $data['hasil_akhir'] = $dataHasilAkhir != null ? json_decode($dataHasilAkhir, true) : $_SESSION['hasil_akhir'];
        $data['alternatif'] = $this->model('Siswa_model')->getAll();
        $data['ranking'] = (array_values($data['hasil_akhir']['ranking']));
        $pushAlternatif = [];
        foreach ($data['alternatif'] as $key => $item) {
            $pushAlternatif[$item['id']] = $item;
        }
        $data['alternatif'] = $pushAlternatif;
        $label = [];
        foreach ($data['hasil_akhir']['ranking'] as $alternatif_id => $value) {
            $label[] = $data['alternatif'][$alternatif_id]['nama_profile'];
        }
        $data['label'] = ($label);
        echo json_encode($data);
    }
}
