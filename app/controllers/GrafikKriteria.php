<?php

class GrafikKriteria extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Guru', 'Wali Murid'];
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
            ['url' => BASEURL . '/Grafik Kriteria', 'label' => 'Grafik Kriteria'],
        ];

        $dataHasilAkhir = $this->model('HasilAkhir_model')->getHasilAkhir();
        $hasilAkhir = $dataHasilAkhir != null ? json_decode($dataHasilAkhir, true) : ($_SESSION['hasil_akhir'] ?? '');
        $data['breadcrumbs'] = $breadcrumbItems;
        $data['hasil_akhir'] = $hasilAkhir;

        ob_start();
        include_once $this->view('app/grafikKriteria/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Grafik Kriteria');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/grafikKriteria/index.js"></script>');

        $template->display($this->view('layouts/app'));
    }

    public function loadData()
    {
        $dataMatriksKriteria = json_decode($this->model('MatriksAhp_model')->getAhpKriteria(), true);
        $dataKriteria = $this->model('Kriteria_model')->getAll();

        $dataBobot = [];
        $datalabel = [];
        foreach ($dataKriteria as $index => $item) {
            $bobot = $dataMatriksKriteria['perhitungan_bobot_prioritas'];
            $bobotMatriks = $bobot[$item['id']];
            $dataBobot[] = doubleval(number_format($bobotMatriks, 3));
            $datalabel[] = $item['nama_kriteria'];
        }

        echo json_encode([
            'label' => $datalabel,
            'value' => $dataBobot,
        ]);
    }
}
