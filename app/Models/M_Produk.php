<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Produk extends Model
{
     // Menentukan nama tabel yang akan digunakan
     protected $table = 'produk'; // Pastikan nama tabel sesuai dengan tabel di database
     protected $primaryKey = 'id'; // Tentukan primary key jika diperlukan
     protected $allowedFields = ['nama_produk', 'kategori_produk', 'harga_beli', 'harga_jual', 'stok_produk', 'image']; // Kolom yang dapat dimanipulasi
 
     // Fungsi untuk mengambil semua data produk
     public function getAllData()
     {
         // Menggunakan method bawaan findAll() untuk mengambil semua data
         return $this->findAll(); 
     }

     // fungsi tambah produk
    public function tambahProduk($data)
    {
        return $this->db->table('produk')->insert($data);
    }

    // fungsi delete produk
    public function deleteProduk($id)
    {
        return $this->find($id); // Menggunakan method find() dari Model
    }


    // fungsi edit produk
    public function editProduk($data, $id)
    {
        return $this->db->table('produk')->update($data, ['id' => $id]);
    }
 }