<?php
namespace Modules\SupperAdmin\Controllers;

use App\Controllers\BaseController;

class SupperAdmin extends BaseController{
    public function index() {
        return view('Modules\SupperAdmin\Views\index');
    }
    public function login() {
        return view('Modules\SupperAdmin\Views\login');
    }
}