<?php

class Nilai_model extends Controller
{
    private $table = 'nilai';
    private $db;
    private $stringDefault = 'SELECT nilai.*, profile.nama_profile, profile.alamat_profile, profile.jeniskelamin_profile, profile.nomorhp_profile, profile.kode_profile, roles.nama_roles, matapelajaran.nama_matapelajaran FROM nilai
    JOIN users on nilai.users_id = users.id
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id
    JOIN matapelajaran on matapelajaran.id = nilai.matapelajaran_id
    ';

    private $countDefault = 'SELECT COUNT(*) as total FROM nilai
    JOIN users on nilai.users_id = users.id
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id
    JOIN matapelajaran on matapelajaran.id = nilai.matapelajaran_id
    ';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll($siswa_id, $matapelajaran_id)
    {
        $queryText = $this->stringDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        if ($siswa_id != null) {
            $queryText .= ' AND users.id = :siswa_id';
        }
        if ($matapelajaran_id != null) {
            $queryText .= ' AND nilai.matapelajaran_id = :matapelajaran_id';
        }
        $this->db->query($queryText);
        $this->db->bind('nama_roles', 'siswa');
        if ($siswa_id != null) {
            $this->db->bind('siswa_id', $siswa_id);
        }
        if ($matapelajaran_id != null) {
            $this->db->bind('matapelajaran_id', $matapelajaran_id);
        }
        return $this->db->resultSet();
    }

    public function countAll($users_id = null)
    {
        $query = $this->countDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles';
        if ($users_id != null) {
            $query .= ' AND nilai.users_id = :users_id';
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
        AND nilai.id = :id');
        $this->db->bind('nama_roles', 'siswa');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO nilai (value_nilai, keterangan_nilai, users_id, matapelajaran_id)
        VALUES (:value_nilai, :keterangan_nilai, :users_id, :matapelajaran_id)";

        $this->db->query($query);
        $this->db->bind('value_nilai', $data['value_nilai']);
        $this->db->bind('keterangan_nilai', $data['keterangan_nilai']);
        $this->db->bind('users_id', $data['users_id']);
        $this->db->bind('matapelajaran_id', $data['matapelajaran_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM nilai WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE nilai SET 
        value_nilai = :value_nilai, 
        keterangan_nilai = :keterangan_nilai, 
        users_id = :users_id, 
        matapelajaran_id = :matapelajaran_id
        WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('value_nilai', $data['value_nilai']);
        $this->db->bind('keterangan_nilai', $data['keterangan_nilai']);
        $this->db->bind('users_id', $data['users_id']);
        $this->db->bind('matapelajaran_id', $data['matapelajaran_id']);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
