<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersPasswordReset extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_password_resets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email','token','user_id'];

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

    public function getUserByEmail($email,$id)
    {
        $where = array('email' => $email, 'user_id' => $id);
        $user = $this->where($where)->first();
        return $user;
    }

    public function getUserByToken($token)
    {
        $user = $this->where('token',$token)->first();
        return $user;
    }

    public function updateUserByUserid($userId, $userPasswordResetData)
    {
        $user = $this->where('user_id',$userId)->set($userPasswordResetData)->update();
        return $user;
    }
}
