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

    public function deleteShares($uuid){
        $builder = $this->db->table('shares_on_sale');
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
    public function manageUsers($id){
        $builder = $this->db->table('sacco_shares');
        $builder->select('users.fname,users.lname,users.phone,sacco_shares.*,sacco.name');
        $builder->join('users', 'users.user_id = sacco_shares.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_shares.sacco_id');
        $builder->where('sacco_shares.sacco_id', $id);
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
        $builder->update(['is_approved' => 1, 'approved_at' => date('Y-m-d H:i:s')]);
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

    public function getTransactions($sacco_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.phone as seller_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, transactions.status, shares_on_sale.cost_per_share, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getReport($sacco_id, $report_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.user_id as buyer_user_id, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.user_id as seller_user_id, u2.phone as seller_phone,transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, shares_on_sale.cost_per_share, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $builder->where('transactions.transaction_id', $report_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getSaccoShares($user_id, $sacco_id){
        $builder = $this->db->table('sacco_shares');
        $builder->select('sacco_shares.shares_amount');
        $builder->where('user_id', $user_id);
        $builder->where('sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateSellerSacoShare($seller_id, $shares_balance){
        $builder = $this->db->table('sacco_shares');
        $builder->where('user_id', $seller_id);
        $builder->update(['shares_amount' => $shares_balance]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateBuyerSaccoShare($buyer_user_id, $shares_on_sale){
        $builder = $this->db->table('sacco_shares');
        $builder->where('user_id', $buyer_user_id);
        $builder->update(['shares_amount' => $shares_on_sale]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateTransactionStatus($transaction_id){
        $builder = $this->db->table('transactions');
        $builder->where('transaction_id', $transaction_id);
        $builder->update(['status' => 1]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

//    recording the errors
    public function insertError($data)
    {
        $builder = $this->db->table('errors');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveUser($data){
        $builder = $this->db->table('users');
        $builder->insert($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getAllRecords($sacco_id){
        $builder = $this->db->table('set_price_per_share');
        $builder->select('*');
        $builder->where('sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updatePricePerShare($sacco_id, $data){
        $builder = $this->db->table('set_price_per_share');
        $builder->where('sacco_id', $sacco_id);
        $builder->update($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insertPricePerShare($data){
        $builder = $this->db->table('set_price_per_share');
        $builder->insert($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getShareNotification($sacco_id){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.cost_per_share, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.user_id, shares_on_sale.sacco_id, users.fname, users.lname');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.is_verified', 0);
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getEachShareNotification($share_id){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.cost_per_share, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.user_id, shares_on_sale.sacco_id, shares_on_sale.created_at, users.fname, users.lname, sacco.name');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.uuid', $share_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function saveRejectedShare($data){
        $builder = $this->db->table('share_messages');
        $builder->insert($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function approveShare($share_id, $user_id){
        $builder = $this->db->table('shares_on_sale');
        $builder->where('uuid', $share_id);
        $builder->where('user_id', $user_id);
        $builder->update(['is_verified' => 1]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRejectShares($share_id, $user_id){
        $builder = $this->db->table('shares_on_sale');
        $builder->where('uuid', $share_id);
        $builder->where('user_id', $user_id);
        $builder->update(['is_verified' => 2]);
        if($this->db->affectedRows() === 1){
            return true;
        }else{
            return true;
        }
    }

}