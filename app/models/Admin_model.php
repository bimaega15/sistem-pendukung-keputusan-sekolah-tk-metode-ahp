<?php

class Admin_model extends Controller
{
    private $table = 'users';
    private $db;
    private $stringDefault = 'SELECT users.*, profile.nama_profile, profile.alamat_profile, profile.jeniskelamin_profile, profile.nomorhp_profile, roles.nama_roles FROM users
    JOIN profile on profile.users_id = users.id
    JOIN role_user on users.id = role_user.users_id
    JOIN roles on roles.id = role_user.roles_id';

    private $countDefault = 'SELECT COUNT(*) as total FROM users
JOIN profile on profile.users_id = users.id
JOIN role_user on users.id = role_user.users_id
JOIN roles on roles.id = role_user.roles_id';


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query($this->stringDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles');
        $this->db->bind('nama_roles', 'admin');
        return $this->db->resultSet();
    }

    public function countAll()
    {
        $this->db->query($this->countDefault . ' WHERE LOWER(roles.nama_roles) = :nama_roles');
        $this->db->bind('nama_roles', 'admin');
        return $this->db->single();
    }

    public function getById($id)
    {
        $this->db->query($this->stringDefault . ' 
        WHERE LOWER(roles.nama_roles) = :nama_roles
        AND users.id = :id');
        $this->db->bind('nama_roles', 'admin');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO users (username_users, password_users, email_users)
        VALUES (:username_users, :password_users, :email_users)";

        $this->db->query($query);
        $this->db->bind('username_users', $data['username_users']);
        $this->db->bind('password_users', md5($data['password_users']));
        $this->db->bind('email_users', $data['email_users']);
        $this->db->execute();
        $users_id = $this->db->lastId();

        // insert profile
        $query = "INSERT INTO profile (nama_profile, alamat_profile, jeniskelamin_profile, nomorhp_profile, users_id)
        VALUES (:nama_profile, :alamat_profile, :jeniskelamin_profile, :nomorhp_profile, :users_id)";

        $this->db->query($query);
        $this->db->bind('nama_profile', $data['nama_profile']);
        $this->db->bind('alamat_profile', $data['alamat_profile']);
        $this->db->bind('jeniskelamin_profile', $data['jeniskelamin_profile']);
        $this->db->bind('nomorhp_profile', $data['nomorhp_profile']);
        $this->db->bind('users_id', $users_id);
        $this->db->execute();

        // search role user
        $searchRoles = $this->model('Peran_model');
        $searchByRole = $searchRoles->getByRoles('admin');
        $rolesId = $searchByRole['id'];

        // insert role users
        $query = "INSERT INTO role_user
        VALUES
      ('', :users_id, :roles_id)";

        $this->db->query($query);
        $this->db->bind('users_id', $users_id);
        $this->db->bind('roles_id', $rolesId);
        $this->db->execute();

        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
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
