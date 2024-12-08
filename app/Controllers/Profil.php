<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Profil;

class Profil extends Controller
{
    public function index()
    {
        $model = new M_Profil();

        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

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