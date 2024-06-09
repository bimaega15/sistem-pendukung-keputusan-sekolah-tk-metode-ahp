<?php

class MataPelajaran extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();
    }


    public function dataTables()
    {
        $MataPelajaranModel = $this->model('MataPelajaran_model');
        $dataAll = $MataPelajaranModel->getAll();
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/MataPelajaran/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
            $buttonDelete = '
        <a href="' . BASEURL . '/MataPelajaran/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
            <i class="fa-solid fa-trash"></i>
        </a>';
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';
            $data[] = [
                'nama_matapelajaran' => $value['nama_matapelajaran'],
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
        $template = new Template();
        // breadcrumbs
        $breadcrumbItems = [
            ['url' => BASEURL . '/Dashboard', 'label' => 'Home'],
            ['url' => BASEURL . '/MataPelajaran', 'label' => 'Mata Pelajaran'],
        ];
        $MataPelajaranModel = $this->model('MataPelajaran_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $MataPelajaranModel->getAll();
        ob_start();
        include_once $this->view('app/mataPelajaran/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Mata Pelajaran');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/mataPelajaran/index.js"></script>
        ');

        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $action = BASEURL . '/MataPelajaran/store/';
        $data['action'] = $action;

        ob_start();
        include_once $this->view('app/MataPelajaran/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/MataPelajaran/update/' . $id;
        $mataPelajaranModel = $this->model('MataPelajaran_model');

        $data['action'] = $action;
        $data['row'] = $mataPelajaranModel->getById($id);
        ob_start();
        include_once $this->view('app/MataPelajaran/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $MataPelajaranModel = $this->model('MataPelajaran_model');
            $MataPelajaranModel->create($data);
            echo json_encode('Berhasil menambahkan mata pelajaran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $MataPelajaranModel = $this->model('MataPelajaran_model');
            $MataPelajaranModel->update($data, $id);
            echo json_encode('Berhasil mengubah mata pelajaran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $MataPelajaranModel = $this->model('MataPelajaran_model');
            $MataPelajaranModel->delete($id);
            echo json_encode('Berhasil delete mata pelajaran');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function select2()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = $_GET['page'];
        $limit = 10;
        $skip = ($page * $limit)  - $limit;

        $results = $this->model('MataPelajaran_model')->searchSelect2($search, $skip);
        $output = [];
        $output[] = [
            'id' => '0',
            'text' => 'Pilih Semua',
        ];
        foreach ($results as $key => $item) {
            $output[] = [
                'id' => $item['id'],
                'text' => $item['nama_matapelajaran'],
            ];
        }

        // count filtered
        $countFiltered = $this->model('MataPelajaran_model')->counstSearchSelect2($search);

        echo json_encode([
            'results' => $output,
            'count_filtered' => $countFiltered,
        ]);
    }
}
