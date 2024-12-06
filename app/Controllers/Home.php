<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
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
