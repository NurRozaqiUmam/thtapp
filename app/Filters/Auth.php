<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
{
    $key = getenv('JWT_SECRET');
    $header = $request->getServer('HTTP_AUTHORIZATION');

    // Log header Authorization untuk debug
    log_message('debug', 'Authorization Header: ' . ($header ?? 'Header not found'));

    if (!$header) {
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'status' => false,
                'message' => 'Access Denied'
            ]);
    }

    try {
        // Extract the token from the header
        $token = explode(' ', $header)[1];

        // Log token untuk debug
        log_message('debug', 'Extracted Token: ' . $token);

        // Decode the token
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        // Check token expiry
        $exp = $decoded->exp;
        if ($exp < time()) {
            log_message('debug', 'Token Expired at: ' . date('Y-m-d H:i:s', $exp));
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Token Expired'
                ]);
        }

    } catch (\Exception $e) {
        log_message('error', 'JWT Decode Error: ' . $e->getMessage());
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'status' => false,
                'message' => 'Token Invalid: ' . $e->getMessage()
            ]);
    }
}

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
