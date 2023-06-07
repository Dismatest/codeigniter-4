<?php

namespace Modules\SupperAdmin\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');
        $segment = $uri->getSegment(1);
        if (strpos($segment, 'supperAdmin') !== false) {
            if (!session()->has('currentLoggedInUser')) {
                return redirect()->to(base_url('supperAdmin/login'));
            }
        }

    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}