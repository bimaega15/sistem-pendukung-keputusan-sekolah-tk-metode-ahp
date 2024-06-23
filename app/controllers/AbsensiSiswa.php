<?php

class AbsensiSiswa extends Controller
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
        $absensiModel = $this->model('Absensi_model');
        $dataAll = $absensiModel->getAll($dataGet['siswa_id']);
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/AbsensiSiswa/edit/' . $value['id'] . '?siswa_id=' . $dataGet['siswa_id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/AbsensiSiswa/delete/' . $value['id'] . '?siswa_id=' . $dataGet['siswa_id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'tanggal_absensi' => Utils::formatTanggal($value['tanggal_absensi']),
                'nama_absensi' => $value['nama_absensi'],
                'keterangan_absensi' => $value['keterangan_absensi'],
                'action' => $buttonAction,
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
            ['url' => BASEURL . '/AbsensiSiswa?siswa_id=' . $dataGet['siswa_id'], 'label' => 'Absensi Siswa'],
        ];

        $data['breadcrumbs'] = $breadcrumbItems;
        $data['siswa'] = $this->model('Siswa_model')->getById($dataGet['siswa_id']);
        ob_start();
        include_once $this->view('app/absensiSiswa/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Absensi Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="siswa_id" data-value="' . $dataGet['siswa_id'] . '"></script>
        <script src="' . BASEURL . '/public/js/app/absensiSiswa/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }


    public function create()
    {
        $dataGet = $_GET;
        $absensiModel = $this->model('Absensi_model');

        $action = BASEURL . '/AbsensiSiswa/store?siswa_id=' . $dataGet['siswa_id'];
        $data['action'] = $action;
        $data['jenisAbsensi'] = $this->datastatis['jenis_absensi'];

        ob_start();
        include_once $this->view('app/absensiSiswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $dataGet = $_GET;
        $action = BASEURL . '/AbsensiSiswa/update/' . $id . '?siswa_id=' . $dataGet['siswa_id'];
        $absensiModel = $this->model('Absensi_model');

        $data['action'] = $action;
        $data['row'] = $absensiModel->getById($id);
        $data['jenisAbsensi'] = $this->datastatis['jenis_absensi'];

        ob_start();
        include_once $this->view('app/absensiSiswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $dataGet = $_GET;
            $mergeData = array_merge($data, ['users_id' => $dataGet['siswa_id']]);
            $absensiModel = $this->model('Absensi_model');
            $absensiModel->create($mergeData);
            echo json_encode('Berhasil menambahkan absensi');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $dataGet = $_GET;
            $mergeData = array_merge($data, ['users_id' => $dataGet['siswa_id']]);
            $absensiModel = $this->model('Absensi_model');
            $absensiModel->update($mergeData, $id);
            echo json_encode('Berhasil mengubah absensi');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $absensiModel = $this->model('Absensi_model');
            $absensiModel->delete($id);
            echo json_encode('Berhasil delete absensi');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}

