<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (session()->has('currentLoggedInSacco')) {
            return redirect()->to(base_url('admin/dashboard'));
        }else{
            return redirect()->to(base_url('admin/login'));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}