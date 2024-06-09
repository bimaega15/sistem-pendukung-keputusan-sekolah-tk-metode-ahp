<?php

class Peran_model
{
    private $table = 'roles';
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

    public function getByRoles($nama_roles)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE LOWER(roles.nama_roles) = :nama_roles');
        $this->db->bind('nama_roles', $nama_roles);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO roles
                    VALUES
                  ('', :nama_roles)";

        $this->db->query($query);
        $this->db->bind('nama_roles', $data['nama_roles']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM roles WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update($data, $id)
    {
        $query = "UPDATE roles SET
                    nama_roles = :nama_roles
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_roles', $data['nama_roles']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
