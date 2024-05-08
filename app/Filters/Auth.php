<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    // Lakukan sesuatu di sini
    if (!session()->has('isLoggedIn') || session()->get('isLoggedIn') !== true) {
        return redirect()->to(base_url('auth/login'));
    }
}


    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
{
    // Lakukan sesuatu di sini
}

}