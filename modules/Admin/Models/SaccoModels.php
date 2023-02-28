<?php


namespace Modules\Admin\Models;

use \CodeIgniter\Model;

class SaccoModels extends Model
{

    public function loginSacco($email)
    {
        $builder = $this->db->table('sacco');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getCurrentSaccoInformation($uuid)
    {
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updatePassword($uuid,$password)
    {
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }
    //all the sacco admin methods
    public function manageShares(){
        $saccoName = session()->get('name');
        $builder = $this->db->table('shares');
        $builder->select('users.uniid, users.fname,users.lname,users.email,users.phone,shares.*');
        $builder->join('users', 'users.user_id = shares.user_id');
        $builder->where('shares.sacco', $saccoName);
        $builder->orderBy('shares.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();

    }
}