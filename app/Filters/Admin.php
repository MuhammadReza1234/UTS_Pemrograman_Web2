<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Lakukan sesuatu di sini
        if(session()->get('role') != 0)
        {
            return redirect()->to(site_url('home/index'));
        }
    }
    

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Lakukan sesuatu di sini
    }
    
}