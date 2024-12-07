<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Profil;

class Profil extends Controller
{
    public function index()
    {
        $model = new M_Profil();

        // Ambil data user berdasarkan id
        $user = $model->getUser(1);

        $data = [
            'title' => 'Profil',
            'user' => $user
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('profil/index', $data);
        // echo view('templates/footer');
    }
}