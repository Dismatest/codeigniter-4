<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ServerError extends BaseController
{
    public function manyRequests(){
        return view('server-errors/many-requests');
    }
}
