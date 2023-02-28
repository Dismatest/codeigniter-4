<?php

namespace App\Libraries;

class Hash
{
    public static function encrypt($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
    public static function decrypt($userPassword, $dbPassword){
        if(password_verify($userPassword, $dbPassword)){
            return true;
        }else{
            return false;
        }
    }
}