<?php

class MatriksAhp_model extends Controller
{
    private $table = 'matriks_kriteria';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAhpKriteria()
    {
        $query = "SELECT ahp_kriteria FROM " . $this->table . " LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();
        
        return $result ? $result['ahp_kriteria'] : null;
    }

    public function updateMatriksKriteria($data)
    {
        $query = "SELECT id FROM " . $this->table . "  LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();

        if ($result) {
            // If an entry is found, update it
            $id = $result['id'];
            $updateQuery = "UPDATE " . $this->table . " SET ahp_kriteria = :ahp_kriteria WHERE id = :id";
            $this->db->query($updateQuery);
            $this->db->bind(':ahp_kriteria', $data);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            // If no non-null entry is found, insert a new entry
            $insertQuery = "INSERT INTO " . $this->table . " (ahp_kriteria) VALUES (:ahp_kriteria)";
            $this->db->query($insertQuery);
            $this->db->bind(':ahp_kriteria', $data);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
}
