<?php

namespace App\Models;

use \CodeIgniter\Model;

class LoginActivityModel extends Model{
    public function saveLoginActivityInfo($data){
        $builder = $this->db->table('login_activities');
        $builder->insert($data);
        if($this->db->affectedRows() == 1){
            return $this->insertID; //returning the id of the last inserted data
        }else{
            return false;
        }
    }
    public function updateLogoutActivity($loggedIn_id){
        $builder = $this->db->table('login_activities');
        $builder->where('uniid', $loggedIn_id);
        $builder->update(['logout_time'=>date('Y-m-d h:i:s')]);
        if($this->db->affectedRows() > 0){
            return true;
        }
    }
    public function getAllLoginActivities(){
        $builder = $this->db->table('login_activities');
        $builder->select('login_activities.*, users.fname, users.lname');
        $builder->join('users', 'users.uniid = login_activities.uniid');
        $builder->orderBy('login_activities.login_time', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    //all the supperAdmin shares model methods
    public function deleteActivity($id){
        $builder = $this->db->table('login_activities');
        $builder->where('id', $id);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }
    }

    public function findAllUsers(){
        $builder = $this->db->table('users');
        return $builder->countAllResults();
    }

    public function findAllSaccoCount(){
        $builder = $this->db->table('sacco');
        return $builder->countAllResults();
    }

    public function findAllTransactions(){
        $builder = $this->db->table('transactions');
        $builder->selectSum('amount');
        $query = $builder->get();
        return $query->getRow()->amount;

    }

    //all the supperAdmin shares model methods
    public function findAllAprovedShares(){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.fname, users.lname, sacco.name, shares_on_sale.*');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('is_verified', '1');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();

    }
    public function findAllNotAprovedShares(){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.fname, users.lname, shares_on_sale.*, sacco.name');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('is_verified', '0');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function approveShare($uuid){
        $builder = $this->db->table('shares_on_sale');
        $builder->where('uuid', $uuid);
        $builder->update(['is_verified' => 1]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }
    public function findAllAllShares(){
        $builder = $this->db->table('shares');
        $builder->select('users.fname, users.lname, shares.uuid, shares.sacco, shares.membership_number, shares.shares_amount, shares.cost, shares.total, shares.is_verified, shares.created_at');
        $builder->join('users', 'users.user_id = shares.user_id');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function deleteShare($uuid){
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }
    }

    public function updateShare($uuid, $data){
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->update($data);
        if($this->db->affectedRows() > 0){
            return true;
        }
    }
    public function getShare($uuid){
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    //all the sacco supperAdmin methods

    public function registerSacco($data){
        $builder = $this->db->table('sacco');
        $builder->insert($data);
        if($this->db->affectedRows() == 1){
            return true; //returning the id of the last inserted data
        }else{
            return false;
        }
    }
    public function findAllSacco(){
        $builder = $this->db->table('sacco');
        $builder->select('*');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function deleteSacco($uuid){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }
    }
    public function findSacco($uuid){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function updateSacco($uuid, $data){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->update($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function findAllRecords(){
        $builder = $this->db->table('set_commission');
        $builder->select('*');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function insertCommission($data){
        $builder = $this->db->table('set_commission');
        $builder->insert($data);
        if($this->db->affectedRows() == 1){
            return true;
        }else{
            return false;
        }
    }
    public function updateCommission($id, $data){
        $builder = $this->db->table('set_commission');
        $builder->where('commission_id', $id);
        $builder->update($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function findAllAuditTrail(){
        $builder = $this->db->table('errors');
        $builder->select('errors.*');
        return $builder->get()->getResultArray();

    }

    public function deleteAuditTrail($id){
        $builder = $this->db->table('errors');
        $builder->where('error_id', $id);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }
    }

    public function viewTransactions($user_id){

        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.phone as buyer_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, transactions.status, shares_on_sale.cost_per_share, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id');
        $query = $builder->get();
        return $query->getResultArray();

    }
}