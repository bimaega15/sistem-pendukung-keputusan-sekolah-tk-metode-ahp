<?php

class PenilaianSiswa extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();
    }


    public function dataTables()
    {
        $dataGet = $_GET;
        $nilaiModel = $this->model('Nilai_model');
        $mataPelajaranId = $_GET['matapelajaran_id'];
        if ($mataPelajaranId == 0) {
            $mataPelajaranId = null;
        }
        $dataAll = $nilaiModel->getAll($dataGet['siswa_id'], $mataPelajaranId);

        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/PenilaianSiswa/edit/' . $value['id'] . '?siswa_id=' . $dataGet['siswa_id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/PenilaianSiswa/delete/' . $value['id'] . '?siswa_id=' . $dataGet['siswa_id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'nama_matapelajaran' => $value['nama_matapelajaran'],
                'value_nilai' => $value['value_nilai'],
                'keterangan_nilai' => $value['keterangan_nilai'],
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
            ['url' => BASEURL . '/Nilai', 'label' => 'Nilai Siswa'],
            ['url' => BASEURL . '/PenilaianSiswa?siswa_id=' . $dataGet['siswa_id'], 'label' => 'Penilaian Siswa'],
        ];

        $utils = new Utils();
        $myProfile = $utils->myProfile();

        $data['breadcrumbs'] = $breadcrumbItems;
        $data['siswa'] = $this->model('Siswa_model')->getById($dataGet['siswa_id']);
        $data['nama_roles'] = $myProfile['nama_roles'];
        $data['mata_pelajaran'] = $this->model('MataPelajaran_model')->getAll();

        ob_start();
        include_once $this->view('app/penilaianSiswa/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Penilaian Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script class="siswa_id" data-value="' . $dataGet['siswa_id'] . '"></script>
        <script class="nama_roles" data-value="' . $myProfile['nama_roles'] . '"></script>
        <script src="' . BASEURL . '/public/js/app/penilaianSiswa/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }


    public function create()
    {
        $dataGet = $_GET;

        $mataPelajaran = $this->model('MataPelajaran_model')->getAll();
        $action = BASEURL . '/PenilaianSiswa/store?siswa_id=' . $dataGet['siswa_id'];
        $data['action'] = $action;
        $data['mataPelajaran'] = $mataPelajaran;

        ob_start();
        include_once $this->view('app/penilaianSiswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $dataGet = $_GET;
        $action = BASEURL . '/PenilaianSiswa/update/' . $id . '?siswa_id=' . $dataGet['siswa_id'];
        $nilaiModel = $this->model('Nilai_model');

        $mataPelajaran = $this->model('MataPelajaran_model')->getAll();
        $data['mataPelajaran'] = $mataPelajaran;
        $data['action'] = $action;
        $data['row'] = $nilaiModel->getById($id);
        ob_start();
        include_once $this->view('app/penilaianSiswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $dataGet = $_GET;
            $mergeData = array_merge($data, ['users_id' => $dataGet['siswa_id']]);
            $nilaiModel = $this->model('Nilai_model');
            $nilaiModel->create($mergeData);
            echo json_encode('Berhasil menambahkan nilai');
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
            $nilaiModel = $this->model('Nilai_model');
            $nilaiModel->update($mergeData, $id);
            echo json_encode('Berhasil mengubah nilai');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $nilaiModel = $this->model('Nilai_model');
            $nilaiModel->delete($id);
            echo json_encode('Berhasil delete nilai');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }
}
