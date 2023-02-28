<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class IpBlocker implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        //status code 429 is for too many requests
        $throttler = Services::throttler();
        if($throttler->check(md5($request->getIPAddress()), 50, MINUTE) === false){
//            return Services::response()->setStatusCode(429)->setBody('You have exceeded the number of requests allowed');
            return redirect()->to(base_url().'/server-errors/many-requests');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
