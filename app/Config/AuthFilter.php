<?php

namespace Config;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = 'simsweb_security';
        $jwt = $request->getCookie('jwt');

        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, $key, ['HS256']);
                return $request;
            } catch (\Exception $e) {
                return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}