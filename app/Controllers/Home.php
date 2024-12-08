<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data = [
            'title' => 'SIMS Web App'
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar', $data);
        echo view('home/index');
        echo view('templates/footer');
    }
}
