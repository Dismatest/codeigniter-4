<?php

namespace App\Models;

use \CodeIgniter\Model;

class RegisterModel extends Model{
    public function registerUser($data){

        //connection is already available in the Model class

        $builder = $this->db->table('users');
        $builder->insert($data);

        if($this->db->affectedRows() ===1 ){
            return true;
        }else{
            return false;
        }

    }
}