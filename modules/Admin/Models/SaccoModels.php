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

    public function getTotalUsers($sacco_id)
    {
        $builder = $this->db->table('sacco_membership');
        $builder->where('sacco_id', $sacco_id);
        return $builder->countAllResults();
    }

    public function getTotalActiveShares($sacco_id)
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->where('sacco_id', $sacco_id);
        $builder->where('is_verified', '1');
        return $builder->countAllResults();
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
    public function allMembers(){
        $builder = $this->db->table('sacco_membership');
        $builder->select('users.uniid, users.fname,users.lname,users.email,users.phone, sacco.name, sacco_membership.id_number');
        $builder->join('users', 'users.user_id = sacco_membership.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
        $builder->orderBy('sacco_membership.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function manageShares(){
        $sacco_id = session()->get('sacco_id');
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.uniid, users.fname,users.lname,users.email,users.phone, sacco.name, shares_on_sale.*');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $builder->orderBy('shares_on_sale.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function verifyShares($uuid){
        $builder = $this->db->table('shares_on_sale');
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

    public function createShare($data){
        $builder = $this->db->table('shares_on_sale');
        $builder->insert($data);
        if($this->db->affectedRows() > 0) {
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

    public function saveAgreementFile($fileData){
        $builder = $this->db->table('agreement');
        $builder->insert($fileData);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }

    }
}