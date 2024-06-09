<?php

class LaporanAbsensi extends Controller
{
    public $datastatis;
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        require_once './app/config/datastatis.php';
        $this->datastatis = $data['statis'];
    }


    public function dataTables()
    {
        $dataGet = $_GET;
        $dari_tanggal = $dataGet['dari_tanggal'];
        $sampai_tanggal = $dataGet['sampai_tanggal'];
        $siswa_id = $dataGet['siswa_id'];

        $absensiModel = $this->model('Absensi_model');
        $dataAll = $absensiModel->getAll($siswa_id, $dari_tanggal, $sampai_tanggal, true);


        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {

            $data[] = [
                'nama_absensi' => $value['nama_absensi'],
                'keterangan_absensi' => $value['keterangan_absensi'],
                'jumlah_absensi' => $value['jumlah_absensi'],
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

        $dataGet = $_GET;
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/Absensi', 'label' => 'Absensi'],
            ['url' => BASEURL . '/LaporanAbsensi?siswa_id=' . $dataGet['siswa_id'], 'label' => 'Absensi Siswa'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        $data['siswa'] = $this->model('Siswa_model')->getById($dataGet['siswa_id']);
        ob_start();
        include_once $this->view('app/laporanAbsensi/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Laporan Absensi Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="siswa_id" data-value="' . $dataGet['siswa_id'] . '"></script>
        <script src="' . BASEURL . '/public/js/app/laporanAbsensi/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }
}
