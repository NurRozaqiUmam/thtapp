<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produk;

class Produk extends Controller
{

    public function index()
    {
        $model = new M_Produk();

        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Tentukan jumlah data per halaman
        $perPage = 10; // Contoh 10 data per halaman

        // Ambil halaman saat ini
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Ambil data produk dengan pagination
        $produk = $model->paginate($perPage, 'produk', $currentPage);

        $data = [
            'title' => 'Daftar Produk',
            'produk' => $produk,
            'pager' => $model->pager,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'totalItems' => $model->countAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('produk/index', $data);
        // echo view('templates/footer');
    }
}