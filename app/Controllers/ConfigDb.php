<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PDO;

class ConfigDb extends Controller
{
    public function index()
    {
        $host = 'localhost';
        $port = '5432';
        $dbname = 'sims_webapp';
        $dbuser = 'postgres';
        $dbpass = 'g00dst4rt';

        try {
            // Membuat koneksi ke database PostgreSQL
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
            echo "Connected to the PostgreSQL database successfully!";
        } catch (\PDOException $e) {
            // Menangkap error dan menampilkan pesan
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>