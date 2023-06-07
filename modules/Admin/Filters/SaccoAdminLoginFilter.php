<?php

namespace Modules\Admin\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SaccoAdminLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');
        $segment = $uri->getSegment(1);
        if (strpos($segment, 'admin') !== false) {
            if (!session()->has('currentLoggedInSacco')) {
                return redirect()->to(base_url('admin/login'));
            }
        }

    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}