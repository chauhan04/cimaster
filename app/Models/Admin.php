<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins';
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


    public function getAdmins()
    {
        $admins = $this->orderBy('id', 'DESC')->findAll();
        return $admins;
    }

    public function getAdminById($id)
    {
        $admin = $this->where('id', $id)->first();
        return $admin;
    }

    public function deleteAdminById($id)
    {
        $admin = $this->where('id', $id)->delete($id);
        return $admin;
    }

    //funtion to get email of admin to send forgot password link
    public function getAdminByEmail($email)
    {
        $admin = $this->where('email', $email)->first();
        return $admin;
    }

}
