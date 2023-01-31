<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function login(){
        if($this->request->getMethod() == 'post'){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
        }
        return view('login');
    }
    public function register(){
        return view('register');
    }
}
