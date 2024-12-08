<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    protected $jwtLib;

    public function __construct()
    {
        $this->jwtLib = new \App\Libraries\JwtLibrary();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        $jwt = $session->get('jwt') ?? $request->getCookie('jwt');

        if (!$jwt || !$this->jwtLib->is_jwt_valid($jwt)) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan sesuatu setelah request
    }
}
