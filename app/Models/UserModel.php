<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'first_name', 'last_name', 'dob', 'password', 'pass1', 'age_proof', 'phone'];

    public function getUser($slug = false){
        if ($slug === false){
            return $this->findAll();
        }

        return $this->asArray()
                ->where(['username' => $slug])
                ->first();
    }

    public function validate_user($username , $pass){
        return $this->db->table('users')
                ->where('username',$username)
                ->where('password',$pass)
                ->get()->getRow();
    }

}