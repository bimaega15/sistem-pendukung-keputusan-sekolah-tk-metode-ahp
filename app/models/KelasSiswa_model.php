<?php

class KelasSiswa_model
{
    private $table = 'kelas_siswa';
    private $db;
    private $stringDefault = '
    SELECT 
    kelas_siswa.*, 
    kelas.tingkat_kelas, 
    kelas.nama_kelas, 
    kelas_siswa.users_id, 
    profile.nama_profile, 
    profile.nomorhp_profile, 
    profile.kode_profile,
    CASE 
        WHEN profile.jeniskelamin_profile = "L" THEN "Laki-laki"
        WHEN profile.jeniskelamin_profile = "P" THEN "Perempuan"
        ELSE profile.jeniskelamin_profile 
    END AS jeniskelamin_profile
    FROM 
        kelas_siswa
    JOIN 
        kelas ON kelas.id = kelas_siswa.kelas_id
    JOIN 
        users ON users.id = kelas_siswa.users_id
    JOIN 
        profile ON profile.users_id = users.id
    WHERE 
        kelas_siswa.kelas_id = :kelas_id
    ';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll($kelas_id = null)
    {
        $this->db->query($this->stringDefault);
        if ($kelas_id != null) {
            $this->db->bind('kelas_id', $kelas_id);
        }
        return $this->db->resultSet();
    }

    public function countAll()
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single();
    }

    public function getById($id, $kelas_id)
    {
        $this->db->query($this->stringDefault . ' AND kelas_siswa.id=:id');
        $this->db->bind('id', $id);
        $this->db->bind('kelas_id', $kelas_id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO kelas_siswa (kelas_id, users_id) VALUES ";
        $valueStrings = [];

        $dataUsers = explode(',', $data['users_id']);
        $dataKelas = $data['kelas_id'];

        $queryCheck = "SELECT COUNT(*) as count FROM kelas_siswa WHERE kelas_id = :kelas_id AND users_id = :users_id";
        $this->db->query($queryCheck);
        $this->db->bind('kelas_id', $dataKelas);

        foreach ($dataUsers as $key => $usersId) {
            $this->db->bind('users_id', $usersId);
            $this->db->execute();
            $result = $this->db->single();

            if ($result['count'] == 0) {
                $valueStrings[$key] = "(:kelas_id$key, :users_id$key)";
            }
        }


        if (!empty($valueStrings)) {
            $query .= implode(",", $valueStrings);

            $this->db->query($query);

            foreach ($dataUsers as $key => $usersId) {
                if (isset($valueStrings[$key])) {
                    $this->db->bind('kelas_id' . $key, $dataKelas);
                    $this->db->bind('users_id' . $key, $usersId);
                }
            }

            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM kelas_siswa WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE kelas_siswa SET
                    kelas_id = :kelas_id,
                    users_id = :users_id
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('kelas_id', $data['kelas_id']);
        $this->db->bind('users_id', $data['users_id']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function checkSiswa($users_id, $kelas_id, $users_id_now)
    {
        $queryText = $this->stringDefault . ' 
        AND kelas_siswa.users_id = :users_id 
        AND kelas_siswa.users_id != :users_id_now';
        $this->db->query($queryText);
        if ($kelas_id != null) {
            $this->db->bind('kelas_id', $kelas_id);
        }
        $this->db->bind('users_id', $users_id);
        $this->db->bind('users_id_now', $users_id_now);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
