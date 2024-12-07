<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Profil extends Model
{
     // Menentukan nama tabel yang akan digunakan
        protected $table = 'users'; // Pastikan nama tabel sesuai dengan tabel di database
        protected $primaryKey = 'id'; // Tentukan primary key jika diperlukan
        protected $allowedFields = ['foto_profil', 'username', 'nama_kandidat', 'posisi_kandidat']; // Kolom yang dapat dimanipulasi
 
        public function getUser($id = null)
        {
            if ($id == null) {
                return $this->findAll();
            } else {
                return $this->where('id', $id)->first();
            }
        }

        // update nya hanya foto profil saja
        public function updateUser($id, $data)
        {
            return $this->update($id, $data);
        }
 }