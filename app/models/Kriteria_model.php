<?php

class Kriteria_model
{
    private $table = 'kriteria';
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

    public function countAll()
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO kriteria
                    VALUES
                  ('', :nama_kriteria, :kode_kriteria, :keterangan_kriteria)";

        $this->db->query($query);
        $this->db->bind('nama_kriteria', $data['nama_kriteria']);
        $this->db->bind('kode_kriteria', $data['kode_kriteria']);
        $this->db->bind('keterangan_kriteria', $data['keterangan_kriteria']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM kriteria WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE kriteria SET
                    nama_kriteria = :nama_kriteria,
                    kode_kriteria = :kode_kriteria,
                    keterangan_kriteria = :keterangan_kriteria
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_kriteria', $data['nama_kriteria']);
        $this->db->bind('kode_kriteria', $data['kode_kriteria']);
        $this->db->bind('keterangan_kriteria', $data['keterangan_kriteria']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getKode()
    {
        $this->db->query('SELECT MAX(SUBSTRING(kode_kriteria, 2)) AS kode_kriteria FROM ' . $this->table);
        $maxKode = $this->db->single();

        if ($maxKode) {
            $nextNumber = intval($maxKode['kode_kriteria']) + 1;
            $nextKode = 'K' . sprintf('%03d', $nextNumber);
        } else {
            // Jika tidak ada data, kode awal adalah K001
            $nextKode = 'K001';
        }

        return $nextKode;
    }
}
