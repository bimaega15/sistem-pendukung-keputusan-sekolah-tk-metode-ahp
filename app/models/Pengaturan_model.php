<?php

class Pengaturan_model
{
    private $table = 'pengaturan';
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

    public function getById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO pengaturan
                    VALUES
                  ('', 
                  :nama_pengaturan, 
                  :pembuat_pengaturan, 
                  :gambar_pengaturan, 
                  :nokontak_pengaturan, 
                  :alamat_pengaturan)";

        $this->db->query($query);
        $this->db->bind('nama_pengaturan', $data['nama_pengaturan']);
        $this->db->bind('pembuat_pengaturan', $data['pembuat_pengaturan']);
        $this->db->bind('gambar_pengaturan', $data['gambar_pengaturan']);
        $this->db->bind('nokontak_pengaturan', $data['nokontak_pengaturan']);
        $this->db->bind('alamat_pengaturan', $data['alamat_pengaturan']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM pengaturan WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE pengaturan SET
                    nama_pengaturan = :nama_pengaturan,
                    pembuat_pengaturan = :pembuat_pengaturan,
                    gambar_pengaturan = :gambar_pengaturan,
                    nokontak_pengaturan = :nokontak_pengaturan,
                    alamat_pengaturan = :alamat_pengaturan
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_pengaturan', $data['nama_pengaturan']);
        $this->db->bind('pembuat_pengaturan', $data['pembuat_pengaturan']);
        $this->db->bind('gambar_pengaturan', $data['gambar_pengaturan']);
        $this->db->bind('nokontak_pengaturan', $data['nokontak_pengaturan']);
        $this->db->bind('alamat_pengaturan', $data['alamat_pengaturan']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
