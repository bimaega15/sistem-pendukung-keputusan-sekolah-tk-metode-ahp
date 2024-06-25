<?php

class User_roles_model
{
    private $table = 'role_user';
    private $db;
    

    public function __construct()
    {
        $this->db = new Database;
    }
    public function get_user_role($users_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE users_id=:users_id');
        $this->db->bind('users_id', $users_id);
        return $this->db->single();
    }

}
