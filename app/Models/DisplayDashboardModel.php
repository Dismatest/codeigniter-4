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
            return false;
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
        $builder->select('uniid, fname, updated_at');
        $builder->where('uniid', $uniid);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
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
}