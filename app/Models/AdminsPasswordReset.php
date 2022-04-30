<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminsPasswordReset extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins_password_resets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email','token','admin_id'];

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


    public function getAdminByEmail($email,$id)
    {
        $where = array('email' => $email, 'admin_id' => $id);
        $admin = $this->where($where)->first();
        return $admin;
    }

    public function getAdminByToken($token)
    {
        $admin = $this->where('token',$token)->first();
        return $admin;
    }

    public function updateAdminByAdmnid($adminId, $adminPasswordResetData)
    {
        $admin = $this->where('admin_id',$adminId)->set($adminPasswordResetData)->update();
        return $admin;
    }
}
