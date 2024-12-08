<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Login;
use Codeigniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Login extends Controller
{
    use ResponseTrait;
    protected $M_Login;

    public function index()
    {

        $data = [
            'title' => 'Login'
        ];

        echo view('templates/header', $data);
        echo view('login/index', $data);
    }

    public function login()
    {
        // Ambil input dari form
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cek apakah salah satu field kosong
        if (empty($email)) {
            return redirect()->to('/login')->with('error', 'Email harus diisi!');
        }

        if (empty($password)) {
            return redirect()->to('/login')->with('error', 'Password harus diisi!');
        }

        $model = new M_Login();
        $user = $model->where('email', $email)->first();

        // Jika email tidak ditemukan di database
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Email tidak terdaftar!');
        }

        // Validasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Password salah!');
        }

        // Jika login berhasil, buat session dan redirect ke halaman home
        $session = session();
        $session->set('isLoggedIn', true);
        $session->set('userId', $user['id']);
        $session->set('userEmail', $user['email']);

        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Hapus semua data session
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout!');
    }
}

// public function before(RequestInterface $request, $arguments = null)
// {
//     $key = getenv('JWT_SECRET');
//     $header = $request->getServer('HTTP_AUTHORIZATION');

//     if (!$header) {
//         log_message('debug', 'Authorization Header: Header not found');
//         return service('response')
//             ->setStatusCode(401)
//             ->setJSON([
//                 'status' => false,
//                 'message' => 'Access Denied'
//             ]);
//     }

//     try {
//         // Extract the token from the header
//         $token = explode(' ', $header)[1];

//         // Log the header
//         log_message('debug', 'Authorization Header: ' . $header);

//         // Decode the token
//         $decoded = JWT::decode($token, new Key($key, 'HS256'));

//         // Log decoded token
//         log_message('debug', 'Decoded JWT Token: ' . json_encode($decoded));

//         // Check token expiry
//         $exp = $decoded->exp;
//         if ($exp < time()) {
//             return service('response')
//                 ->setStatusCode(401)
//                 ->setJSON([
//                     'status' => false,
//                     'message' => 'Token Expired'
//                 ]);
//         }

//     } catch (\Exception $e) {
//         log_message('error', 'JWT Decode Error: ' . $e->getMessage());
//         return service('response')
//             ->setStatusCode(401)
//             ->setJSON([
//                 'status' => false,
//                 'message' => 'Token Invalid: ' . $e->getMessage()
//             ]);
//     }
// }