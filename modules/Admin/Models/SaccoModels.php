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
    //all the sacco shares admin methods
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
    public function verifyShares($uuid){
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->update(['is_verified' => 1]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteShares($uuid){
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    //all admin sacco members methods
    public function addUserShares($data){
        $builder = $this->db->table('sacco_shares');
        $builder->insert($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function manageUsers(){
        $builder = $this->db->table('sacco_shares');
        $builder->select('users.fname,users.lname,users.phone,sacco_shares.*,sacco.name');
        $builder->join('users', 'users.user_id = sacco_shares.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_shares.sacco_id');
        $builder->orderBy('sacco_shares.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function updateUserShares($id, $data){
        $builder = $this->db->table('sacco_shares');
        $builder->where('sacco_shares_id', $id);
        $builder->update($data);
        if($this->db->affectedRows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function deleteUserShares($id){
        $builder = $this->db->table('sacco_shares');
        $builder->where('sacco_shares_id', $id);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function findAllNewMembers(){
        $name = session()->get('name');
        $builder = $this->db->table('sacco_membership');
        $builder->select('users.fname, users.lname, users.phone, users.email, sacco_membership.*, sacco.name');
        $builder->join('users', 'users.user_id = sacco_membership.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
        $builder->where('sacco.name', $name);
        $builder->orderBy('sacco_membership.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function approveMemberRequest($id){
        $builder = $this->db->table('sacco_membership');
        $builder->where('membership_id', $id);
        $builder->update(['is_approved' => 1]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function deleteMemberRequest($id){
        $builder = $this->db->table('sacco_membership');
        $builder->where('membership_id', $id);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }
}