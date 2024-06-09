<?php

class HasilAkhir_model extends Controller
{
    private $table = 'hasil_akhir';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getHasilAkhir()
    {
        $query = "SELECT hasil_akhir FROM " . $this->table . " LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();
        
        return $result ? $result['hasil_akhir'] : null;
    }

    public function updateHasilAkhir($data)
    {
        $query = "SELECT id FROM " . $this->table . "  LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();

        if ($result) {
            // If an entry is found, update it
            $id = $result['id'];
            $updateQuery = "UPDATE " . $this->table . " SET hasil_akhir = :hasil_akhir WHERE id = :id";
            $this->db->query($updateQuery);
            $this->db->bind(':hasil_akhir', $data);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            // If no non-null entry is found, insert a new entry
            $insertQuery = "INSERT INTO " . $this->table . " (hasil_akhir) VALUES (:hasil_akhir)";
            $this->db->query($insertQuery);
            $this->db->bind(':hasil_akhir', $data);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
}
