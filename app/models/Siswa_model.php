<?php

class Siswa_model extends Controller
{
    private $table = 'users';
    private $db;
    private $stringDefault = 'SELECT users.*, profile.nama_profile, profile.alamat_profile, profile.jeniskelamin_profile, profile.nomorhp_profile, profile.kode_profile, roles.nama_roles FROM users
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id';

    private $countDefault = 'SELECT COUNT(*) as total FROM users
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id';

    private $stringMaxKodeProfile = 'SELECT users.*, profile.nama_profile, profile.alamat_profile, profile.jeniskelamin_profile, profile.nomorhp_profile, MAX(SUBSTRING(profile.kode_profile, 2)) AS kode_profile, roles.nama_roles FROM users
JOIN profile on profile.users_id = users.id
JOIN role_user on users.id = role_user.users_id
JOIN roles on roles.id = role_user.roles_id';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll($users_id = null, $users_id_many = null, $is_use_alternatif = false)
    {
        $query = $this->stringDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        $params = ['nama_roles' => 'siswa'];

        if ($users_id !== null) {
            $query .= ' AND users.id = :users_id';
            $params['users_id'] = $users_id;
        }

        if ($users_id_many != null) {
            $users_id_many = json_decode($users_id_many);
        }
        if (!empty($users_id_many)) {
            $placeholders = [];
            foreach ($users_id_many as $index => $id) {
                $key = ":user_id_many_$index";
                $placeholders[] = $key;
                $params[$key] = $id;
            }
            $query .= ' AND users.id IN (' . implode(',', $placeholders) . ')';
        }
        if($is_use_alternatif){
            $query .= ' AND users.is_alternatif = 1';
        }
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->resultSet();
    }


    public function countAll($users_id = null)
    {
        $query = $this->countDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        if ($users_id != null) {
            $query .= ' AND users.id = :users_id';
        }
        $this->db->query($query);
        $this->db->bind('nama_roles', 'siswa');
        if ($users_id != null) {
            $this->db->bind('users_id', $users_id);
        }
        return $this->db->single();
    }

    public function getById($id)
    {
        $this->db->query($this->stringDefault . ' 
        WHERE LOWER(roles.nama_roles) = :nama_roles
        AND users.id = :id');
        $this->db->bind('nama_roles', 'siswa');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO users (username_users, password_users, email_users)
        VALUES (:username_users, :password_users, :email_users)";

        $this->db->query($query);
        $this->db->bind('username_users', $data['username_users']);
        $this->db->bind('password_users', md5($data['password_users']));
        $this->db->bind('email_users', $data['email_users']);
        $this->db->execute();
        $users_id = $this->db->lastId();


        // insert profile
        $query = "INSERT INTO profile
        VALUES
      ('', :nama_profile, :alamat_profile, :jeniskelamin_profile, :nomorhp_profile, :users_id, :kode_profile)";

        $this->db->query($query);
        $this->db->bind('nama_profile', $data['nama_profile']);
        $this->db->bind('alamat_profile', $data['alamat_profile']);
        $this->db->bind('jeniskelamin_profile', $data['jeniskelamin_profile']);
        $this->db->bind('nomorhp_profile', $data['nomorhp_profile']);
        $this->db->bind('users_id', $users_id);
        $this->db->bind('kode_profile', $data['kode_profile']);
        $this->db->execute();

        // search role user
        $searchRoles = $this->model('Peran_model');
        $searchByRole = $searchRoles->getByRoles('siswa');
        $rolesId = $searchByRole['id'];

        // insert role users
        $query = "INSERT INTO role_user
        VALUES
      ('', :users_id, :roles_id)";

        $this->db->query($query);
        $this->db->bind('users_id', $users_id);
        $this->db->bind('roles_id', $rolesId);
        $this->db->execute();

        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE users SET 
        username_users = :username_users, 
        password_users = :password_users, 
        
        email_users = :email_users 
        WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('username_users', $data['username_users']);
        if ($data['is_new_password']) {
            $this->db->bind('password_users', md5($data['password_users']));
        } else {
            $this->db->bind('password_users', ($data['password_users']));
        }

        $this->db->bind('email_users', $data['email_users']);
        $this->db->bind('id', $id);
        $this->db->execute();
        $users_id = $id;

        // update profile
        $query = "UPDATE profile SET
        nama_profile = :nama_profile, 
        alamat_profile = :alamat_profile, 
        jeniskelamin_profile = :jeniskelamin_profile, 
        nomorhp_profile = :nomorhp_profile, 
        users_id = :users_id
        WHERE users_id = :users_id";

        $this->db->query($query);
        $this->db->bind('nama_profile', $data['nama_profile']);
        $this->db->bind('alamat_profile', $data['alamat_profile']);
        $this->db->bind('jeniskelamin_profile', $data['jeniskelamin_profile']);
        $this->db->bind('nomorhp_profile', $data['nomorhp_profile']);
        $this->db->bind('users_id', $users_id);
        $this->db->execute();

        return true;
    }

    public function getKode()
    {
        $this->db->query($this->stringMaxKodeProfile . '  WHERE LOWER(roles.nama_roles) = :nama_roles');
        $this->db->bind('nama_roles', 'siswa');
        $maxKode = $this->db->single();

        if ($maxKode) {
            $nextNumber = intval($maxKode['kode_profile']) + 1;
            $nextKode = 'A' . sprintf('%03d', $nextNumber);
        } else {
            // Jika tidak ada data, kode awal adalah K001
            $nextKode = 'A001';
        }

        return $nextKode;
    }

    public function searchSelect2($search, $skip)
    {
        $sql = $this->stringDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        if ($search != null) {
            $sql .= ' WHERE nama_profile = LIKE :search 
            OR WHERE kode_profile = LIKE :search';
        }
        $sql .= ' LIMIT 10 OFFSET ' . $skip;

        $this->db->query($sql);
        $this->db->bind('nama_roles', 'siswa');
        if ($search != null) {
            $this->db->bind('search', '%' . $search . '%');
        }
        return $this->db->resultSet();
    }
    public function counstSearchSelect2($search)
    {
        $sql = $this->countDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        if ($search != null) {
            $sql .= ' WHERE nama_profile = LIKE :search 
            OR WHERE kode_profile = LIKE :search';
        }
        $this->db->query($sql);
        $this->db->bind('nama_roles', 'siswa');
        if ($search != null) {
            $this->db->bind('search', '%' . $search . '%');
        }
        $result = $this->db->single();
        return doubleval($result['total']);
    }

    public function saveDataAlternatif($dataAlternatif, $dataAlternatifNotChecked)
    {
        $isAktif = [];
        $isNotAktif = [];
        foreach ($dataAlternatifNotChecked as $key => $value) {
            if(in_array($value, $dataAlternatif)){
                $isAktif[] = $value;
            } else {
                $isNotAktif[] = $value;
            }
        }

        if(count($isAktif) > 0){
            foreach ($isAktif as $key => $value) {
                $query = "UPDATE users SET 
                is_alternatif = :is_alternatif
                WHERE id = :id";
                $this->db->query($query);
                $this->db->bind('is_alternatif', 1);
                $this->db->bind('id', $value);
                $this->db->execute();
            }
        }

        if(count($isNotAktif) > 0){
            foreach ($isNotAktif as $key => $value) {
                $query = "UPDATE users SET 
                is_alternatif = :is_alternatif
                WHERE id = :id";
                $this->db->query($query);
                $this->db->bind('is_alternatif', 0);
                $this->db->bind('id', $value);
                $this->db->execute();
            }
        }

        return true;
    }
}
