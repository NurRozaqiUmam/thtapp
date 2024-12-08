<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Selamat Datang Di SIMS Web App!'
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar', $data);
        echo view('home/index');
        echo view('templates/footer');
    }
}
