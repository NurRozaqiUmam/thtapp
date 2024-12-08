<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Login extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'token']; // Add 'token' to allowed fields

    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }

    // public function validatePassword($inputPassword, $hashedPassword)
    // {
    //     return crypt($inputPassword, $hashedPassword) === $hashedPassword;
    // }


    // public function saveToken($id, $token)
    // {
    //     $this->set(['token' => $token])->where('id', $id)->update();
    // }
}