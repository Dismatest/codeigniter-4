<?php

namespace App\Models;
use \CodeIgniter\Model;

class DisplayDashboardModel extends Model
{
    public function getCurrentUserInformation($id)
    {

        $builder = $this->db->table('users');
        $query = $builder->where('uniid', $id);
        $result = $query->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRow(); //returns a single row as object
        } else {
            return false;
        }

    }

    public function getUserShares()
    {
        $uuid = session()->get('currentLoggedInUser');
        $data['userData'] = $this->getCurrentUserInformation($uuid);
        $builder = $this->db->table('sacco_shares');
        $builder->select('users.fname, users.lname, users.phone, users.email, sacco.sacco_id, sacco.name, sacco_shares.membership_number, sacco_shares.shares_amount, sacco_shares.cost_per_share');
        $builder->join('users', 'users.user_id = sacco_shares.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_shares.sacco_id');
        $builder->where('users.user_id', $data['userData']->user_id);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        } else {
            return array();
        }
    }
    public function is_Verified(){
        $uuid = session()->get('currentLoggedInUser');
        $data['userData'] = $this->getCurrentUserInformation($uuid);
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.is_verified');
        $builder->where('shares_on_sale.user_id', $data['userData']->user_id);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        } else {
            return array();
        }

}

public function is_Member(){
    $uuid = session()->get('currentLoggedInUser');
    $data['userData'] = $this->getCurrentUserInformation($uuid);
    $builder = $this->db->table('sacco_membership');
    $builder->select('users.fname, users.lname, sacco.name, sacco_membership.is_approved');
    $builder->join('users', 'users.user_id = sacco_membership.user_id');
    $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
    $builder->where('users.user_id', $data['userData']->user_id);
    $builder->where('sacco_membership.is_approved', '1');
    $result = $builder->get();
    if (count($result->getResultArray()) == 1) {
        return $result->getResultArray();
    } else {
        return array();
    }

}
    public function updatePassword($password, $id)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $id);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail($email)
    {
        $builder = $this->db->table('users');
        $builder->select("uniid, fname, lname, password");
        $builder->where('email', $email);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) { //getReultArray() returns more than one row
            return $result->getRowArray(); //returns a single object as array
        } else {
            return false;
        }

    }

    public function updateResetTime($id)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $id);
        $builder->update(['updated_at' => date('Y-m-d h:i:s')]);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function verifyUniid($uniid)
    {
        $builder = $this->db->table('users');
        $builder->select('uniid, fname, password, updated_at');
        $builder->where('uniid', $uniid);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return array();
        }
    }

    public function passwordUpdate($id, $password)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $id);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAvatar($avatarName, $uniid)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $uniid);
        $builder->update(['profile' => $avatarName]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($fname, $lname, $phone, $uniid)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $uniid);
        $builder->update(['fname' => $fname, 'lname' => $lname, 'phone' => $phone]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function saveShareData($data)
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return $this->insertID; //returning the id of the last inserted data
        } else {
            return false;
        }
    }

//payments transactions methods

    public function savePaymentsData($data)
    {
        $builder = $this->db->table('transactions');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return $this->insertID; //returning the id of the last inserted data
        } else {
            return false;
        }

    }
//    member commission
    public function findAllRecords(){
        $builder = $this->db->table('set_commission');
        $builder->select('*');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    //displaying the user agreement pdf file

    public function getPdfView($id){
        $builder = $this->db->table('agreement');
        $builder->select('file');
        $builder->where('sacco_id', $id);
        $builder->limit(1);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getRow()->file;
        } else {
            return null;
        }
    }
}