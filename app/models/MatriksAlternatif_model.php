<?php

class MatriksAlternatif_model extends Controller
{
    private $table = 'matriks_alternatif';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAhpAlternatif()
    {
        $query = "SELECT ahp_alternatif FROM " . $this->table;
        $this->db->query($query);
        $result = $this->db->resultSet();
        
        return $result ? $result : null;
    }

    public function updateMatriksAlternatif($kriteria_id, $data)
    {
        $query = "SELECT id FROM " . $this->table . " WHERE kriteria_id = :kriteria_id LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':kriteria_id', $kriteria_id);
        $result = $this->db->single();
    
        if ($result) {
            $id = $result['id'];
            $updateQuery = "UPDATE " . $this->table . " SET ahp_alternatif = :ahp_alternatif WHERE id = :id";
            $this->db->query($updateQuery);
            $this->db->bind(':ahp_alternatif', $data);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            $insertQuery = "INSERT INTO " . $this->table . " (kriteria_id, ahp_alternatif) VALUES (:kriteria_id, :ahp_alternatif)";
            $this->db->query($insertQuery);
            $this->db->bind(':kriteria_id', $kriteria_id);
            $this->db->bind(':ahp_alternatif', $data);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
    
}
