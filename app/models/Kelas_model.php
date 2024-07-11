<?php

class Kelas_model
{
    private $table = 'kelas';
    private $db;
    private $stringDefault = 'select kelas.*, 
    profile.nama_profile, 
    COUNT(kelas_siswa.id) AS jumlah_siswa from kelas 
    join users on users.id = kelas.users_id
    join profile on profile.users_id = users.id
    left join kelas_siswa ON kelas_siswa.kelas_id = kelas.id';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll($users_id = null)
    {
        $query = $this->stringDefault;
        if ($users_id != null) {
            $query .= ' WHERE kelas.users_id = :users_id';
        }
        $query .= ' GROUP BY kelas.id, profile.nama_profile';
        $this->db->query($query);
        if ($users_id != null) {
            $this->db->bind('users_id', $users_id);
        }
        return $this->db->resultSet();
    }

    public function countAll()
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single();
    }

    public function getById($id)
    {
        $queryText = $this->stringDefault . ' WHERE kelas.id=:id';
        $this->db->query($queryText);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO kelas (nama_kelas, users_id)
                    VALUES
                  (:nama_kelas, :users_id)";

        $this->db->query($query);
        $this->db->bind('nama_kelas', $data['nama_kelas']);
        // $this->db->bind('tingkat_kelas', $data['tingkat_kelas']);
        $this->db->bind('users_id', $data['users_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM kelas WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE kelas SET
                    nama_kelas = :nama_kelas,
                    users_id = :users_id
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_kelas', $data['nama_kelas']);
        $this->db->bind('users_id', $data['users_id']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
