<?php

class Users_model extends Controller
{
    private $table = 'users';
    private $db;
    private $stringDefault = 'SELECT users.*, profile.nama_profile, profile.alamat_profile, profile.jeniskelamin_profile, profile.nomorhp_profile, roles.nama_roles FROM users
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($data)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' 
        WHERE username_users = :username_users OR
        email_users = :email_users');
        $this->db->bind('username_users', $data['email_username_users']);
        $this->db->bind('email_users', $data['email_username_users']);
        return $this->db->single();
    }

    public function setRememberToken($users_id, $remember_users, $token_expiration)
    {
        // Simpan remember_users dalam database
        $this->db->query("UPDATE users SET 
        remember_users = :remember_users,
        token_expiration = :token_expiration 
        WHERE id = :id");
        $this->db->bind(':remember_users', $remember_users);
        $this->db->bind(':token_expiration', $token_expiration);
        $this->db->bind(':id', $users_id);
        $this->db->execute();
    }

    public function getUserByToken($remember_users)
    {
        $this->db->query("SELECT * FROM users WHERE remember_users = :remember_users");
        $this->db->bind(':remember_users', $remember_users);
        return $this->db->single();
    }

    public function myProfile($users_id)
    {
        $this->db->query($this->stringDefault . ' WHERE users.id = :users_id');
        $this->db->bind(':users_id', $users_id);
        return $this->db->single();
    }

    public function update($data, $id)
    {
        $query = "UPDATE users SET 
        username_users = :username_users, 
        password_users = :password_users, 
        
        email_users = :email_users 
        WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('username_users', $data['username_users']);
        if ($data['is_new_password']) {
            $this->db->bind('password_users', md5($data['password_users']));
        } else {
            $this->db->bind('password_users', ($data['password_users']));
        }

        $this->db->bind('email_users', $data['email_users']);
        $this->db->bind('id', $id);
        $this->db->execute();
        $users_id = $id;

        // update profile
        $query = "UPDATE profile SET
        nama_profile = :nama_profile, 
        alamat_profile = :alamat_profile, 
        jeniskelamin_profile = :jeniskelamin_profile, 
        nomorhp_profile = :nomorhp_profile, 
        users_id = :users_id
        WHERE users_id = :users_id";

        $this->db->query($query);
        $this->db->bind('nama_profile', $data['nama_profile']);
        $this->db->bind('alamat_profile', $data['alamat_profile']);
        $this->db->bind('jeniskelamin_profile', $data['jeniskelamin_profile']);
        $this->db->bind('nomorhp_profile', $data['nomorhp_profile']);
        $this->db->bind('users_id', $users_id);
        $this->db->execute();

        return true;
    }
}
