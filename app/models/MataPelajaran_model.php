<?php

class MataPelajaran_model
{
    private $table = 'matapelajaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function searchSelect2($search, $skip)
    {
        $sql = 'SELECT * FROM ' . $this->table;
        if ($search != null) {
            $sql .= ' WHERE nama_matapelajaran = LIKE :search';
        }
        $sql .= ' LIMIT 10 OFFSET ' . $skip;
        $this->db->query('SELECT * FROM ' . $this->table);
        if ($search != null) {
            $this->db->bind('search', '%' . $search . '%');
        }
        return $this->db->resultSet();
    }
    public function counstSearchSelect2($search)
    {
        $sql = 'SELECT COUNT(*) as total_nama_matapelajaran FROM ' . $this->table;
        if ($search != null) {
            $sql .= ' WHERE nama_matapelajaran LIKE :search';
        }
        $this->db->query($sql);
        if ($search != null) {
            $this->db->bind('search', '%' . $search . '%');
        }
        $result = $this->db->single();
        return doubleval($result['total_nama_matapelajaran']);
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO matapelajaran
                    VALUES
                  ('', :nama_matapelajaran)";

        $this->db->query($query);
        $this->db->bind('nama_matapelajaran', $data['nama_matapelajaran']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM matapelajaran WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE matapelajaran SET
                    nama_matapelajaran = :nama_matapelajaran
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_matapelajaran', $data['nama_matapelajaran']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
