<?php

class Siswa extends Controller
{
    public function __construct()
    {
        $utils = new Utils();
        $utils->notLogin();

        $allowMyProfile = ['Guru', 'Admin', 'Orang Tua'];
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        if (!in_array($myProfile['nama_roles'], $allowMyProfile)) {
            header("Location: " . BASEURL . '/Page403');
            exit;
        }
    }


    public function dataTables()
    {
        $utils = new Utils();
        $myProfile = $utils->myProfile();
        $my_roles = $utils->cek_users_id_role();

        $users_id_siswa = null;
        $namaRoles = $myProfile['nama_roles'];
        if ($namaRoles == 'Orang Tua') {
            $users_id_siswa = $myProfile['users_id_siswa'];
        }


        $siswaModel = $this->model('Siswa_model');
        $dataAll = $siswaModel->getAll($users_id_siswa);
        $dataCount = count($dataAll);
        $data = array();
        foreach ($dataAll as $key => $value) {
            $buttonEdit = '
        <a href="' . BASEURL . '/Siswa/edit/' . $value['id'] . '" class="btn btn-warning btn-edit btn-sm">
            <i class="fa-solid fa-pencil"></i>
        </a>';
        if($my_roles['nama_roles'] ==='Admin'){
            $buttonDelete = '
            <a href="' . BASEURL . '/Siswa/delete/' . $value['id'] . '" class="btn btn-danger btn-delete btn-sm">
                <i class="fa-solid fa-trash"></i>
            </a>';
        }else{
            $buttonDelete ='';
        }
            
            $buttonAction = '
            <div class="text-center">
                ' . $buttonEdit . ' ' . $buttonDelete . '
            </div>';

            $checkedItems = $value['is_alternatif'] == 1 ? 'checked' : '';

            $checkboxItems = '
            <div class="form-check">
                <input class="form-check-input checkbox-item" type="checkbox" value="' . $value['id'] . '" id="item-' . $value['id'] . '"  '. $checkedItems .'/>
                <label class="form-check-label" for="item-' . $value['id'] . '">
                </label>
            </div>

            ';
            $data[] = [
                'id' => $value['id'],
                'checkbox_item' => $checkboxItems,
                'nama_profile' => $value['nama_profile'],
                'alamat_profile' => $value['alamat_profile'],
                'jeniskelamin_profile' => $value['jeniskelamin_profile'] == 'L' ? 'Laki-laki' : "Perempuan",
                'nomorhp_profile' => $value['nomorhp_profile'],
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
            ['url' => BASEURL . '/Siswa', 'label' => 'Siswa'],
        ];
        $siswaModel = $this->model('Siswa_model');


        $data['breadcrumbs'] = $breadcrumbItems;
        $data['data'] = $siswaModel->getAll();
        ob_start();
        include_once $this->view('app/siswa/index', $data);
        $content = ob_get_clean();


        $template->assign('title', 'Halaman Siswa');
        $template->assign('content', $content);
        $template->assign('custom_js', '
        <script class="baseurl" data-value="' . BASEURL . '"></script>
        <script src="' . BASEURL . '/public/js/app/siswa/index.js"></script>
        ');



        $template->display($this->view('layouts/app'));
    }

    public function create()
    {
        $siswaModel = $this->model('Siswa_model');

        $action = BASEURL . '/Siswa/store/';
        $data['action'] = $action;
        $data['kode_profile'] = $siswaModel->getKode();

        ob_start();
        include_once $this->view('app/siswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function edit($id)
    {
        $action = BASEURL . '/Siswa/update/' . $id;
        $siswaModel = $this->model('Siswa_model');

        $data['action'] = $action;
        $data['row'] = $siswaModel->getById($id);
        $data['kode_profile'] = $siswaModel->getKode();


        ob_start();
        include_once $this->view('app/siswa/form', $data);
        $content = ob_get_clean();
        echo $content;
    }

    public function store()
    {
        try {
            $data = $_POST;
            $siswaModel = $this->model('Siswa_model');
            $siswaModel->create($data);
            echo json_encode('Berhasil menambahkan siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $siswaModel = $this->model('Siswa_model');
            $siswaModel->update($data, $id);
            echo json_encode('Berhasil mengubah siswa');
        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $siswaModel = $this->model('Siswa_model');
            $siswaModel->delete($id);
            echo json_encode('Berhasil delete siswa');
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

        $results = $this->model('Siswa_model')->searchSelect2($search, $skip);
        $output = [];
        $output[] = [
            'id' => '0',
            'text' => 'Pilih Semua',
        ];
        foreach ($results as $key => $item) {
            $output[] = [
                'id' => $item['id'],
                'text' => '<strong>Nama Siswa: ' . $item['nama_profile'] . '</strong> <br />
                <span>Kode: ' . $item['kode_profile'] . '</span>',
            ];
        }

        // count filtered
        $countFiltered = $this->model('Siswa_model')->counstSearchSelect2($search);

        echo json_encode([
            'results' => $output,
            'count_filtered' => $countFiltered,
        ]);
    }
    public function getUsersById($id)
    {
        $siswaModel = $this->model('Siswa_model');
        $data['row'] = $siswaModel->getById($id);
        echo json_encode($data);
    }

    public function saveData()
    {
        $data = $_POST['data'];
        $dataNotChecked = $_POST['dataNotChecked'];
        $siswaModel = $this->model('Siswa_model');
        $siswaModel->saveDataAlternatif($data, $dataNotChecked);

        echo json_encode([
            'message' => 'Berhasil update alternatif'
        ]);
    }
}
