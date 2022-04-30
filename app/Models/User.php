<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['first_name', 'last_name', 'username', 'password', 'email','phone', 'address_line1', 'address_line2', 'country', 'state', 'city', 'zip', 'status', 'last_login'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUsers()
    {
        $users = $this->orderBy('id', 'DESC')->findAll();
        return $users;
    }

    public function getUserById($id)
    {
        $user = $this->where('id', $id)->first();
        return $user;
    }

    public function deleteUserById($id)
    {
        $user = $this->where('id', $id)->delete($id);
        return $user;
    }

    //funtion to get email of user to send forgot password link
    public function getUserByEmail($email)
    {
        $user = $this->where('email', $email)->first();
        return $user;
    }

}
