<?php

namespace App\Models;
use \CodeIgniter\Model;

class DisplayDashboardModel extends Model
{
    public function getCurrentUserInformation($id)
    {

        $builder = $this->db->table('users');
        $builder = $builder->select('user_id, uniid, fname, lname, phone, email, profile');
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
        $builder->orderBy('shares_on_sale.created_at', 'ASC');
        $result = $builder->get()->getRow();
        if ($result != null) {
            return $result;
        } else {
            return array();
        }

}

public function is_Member(){
    $uuid = session()->get('currentLoggedInUser');
    $data['userData'] = $this->getCurrentUserInformation($uuid);
    $builder = $this->db->table('sacco_membership');
    $builder->select('users.fname, users.lname, sacco.name');
    $builder->join('users', 'users.user_id = sacco_membership.user_id');
    $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
    $builder->where('users.user_id', $data['userData']->user_id);
    $result = $builder->get();
    if (count($result->getResultArray()) == 1) {
        return $result->getResultArray();
    } else {
        return array();
    }

}

public function membershipStatus(){
        $user_id = session()->get('user_id');
        $builder = $this->db->table('sacco_membership');
        $builder->select('sacco_membership.is_approved, sacco_membership.approved_at, sacco.name');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
        $builder->where('sacco_membership.user_id', $user_id);
        $result = $builder->get()->getRow();
        if ($result != null) {
            return $result;
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
        $builder->select("user_id, uniid, fname, lname email");
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
            return true;
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
            return true; //returning the id of the last inserted data
        } else {
            return false;
        }

    }

    public function updatePaymentData($callbackData)
    {
        $builder = $this->db->table('callbacks');
        $builder->insert($callbackData);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPaymentModel($merchantRequestID){
        $builder = $this->db->table('callbacks');
        $builder->select('mpesaReceiptNumber, phoneNumber, amount, transactionDate');
        $builder->where('merchantRequestID', $merchantRequestID);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        } else {
            return array();
        }
    }

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
    public function getTransactions($user_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, transactions.amount,  
        transactions.status, shares_on_sale.user_id, shares_on_sale.shares_on_sale, 
        shares_on_sale.total, sacco.name');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('sacco','sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.user_id', $user_id);
        $builder->where('transactions.status', '1');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function verifyMemberNumber($member_number, $user_id){
        $builder = $this->db->table('sacco_shares');
        $builder->select('sacco_shares.*, sacco.name');
        $builder->join('sacco', 'sacco.sacco_id = sacco_shares.sacco_id');
        $builder->where('sacco_shares.membership_number', $member_number);
        $builder->where('sacco_shares.user_id', $user_id);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function getAllSaccos(){
        $builder = $this->db->table('sacco');
        $builder->select('sacco.sacco_id, sacco.name');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function saved($data){
        $builder = $this->db->table('saved');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true; //returning the id of the last inserted data
        } else {
            return false;
        }
    }

    public function getSaccoCostPerShare($sacco_id){
        $builder = $this->db->table('set_price_per_share');
        $builder->select('price_per_share');
        $builder->where('sacco_id', $sacco_id);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRow()->price_per_share;
        } else {
            return false;
        }
    }

    public function saveNotification($data){
        $builder = $this->db->table('notification');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return $this->insertID; //returning the id of the last inserted data
        } else {
            return false;
        }
    }

    public function getUserSharesStatus($user_id){

        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.is_verified, sacco.name, share_messages.reason');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('share_messages', 'share_messages.share_id = shares_on_sale.uuid', 'left');
        $builder->where('shares_on_sale.user_id', $user_id);
        $builder->orderBy('shares_on_sale.created_at', 'DESC');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function delete_bid_shares($bid_id, $user_id){
        $builder = $this->db->table('bid_share');
        $builder->where('buyer_id', $user_id);
        $builder->where('bid_id', $bid_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSaccoShares(){
        $builder= $this->db->table('sacco');
        $builder->select('sacco.uuid, sacco.name, sacco.logo');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getAllSaccoShares($id){

        $builder = $this->db->table('sacco');
        $builder->select('sacco.name, sacco.logo, shares_on_sale.*');
        $builder->join('shares_on_sale', 'shares_on_sale.sacco_id = sacco.sacco_id', 'left');
        $builder->where('sacco.uuid', $id);
        $builder->where('shares_on_sale.is_verified', '1');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getSaccoName($id){
        $builder = $this->db->table('sacco');
        $builder->select('name, location, website, logo');
        $builder->where('uuid', $id);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getActiveShares(){
        $builder = $this->db->table('sacco');
        $builder->select('sacco.name, shares_on_sale.shares_on_sale');
        $builder->join('shares_on_sale', 'shares_on_sale.sacco_id = sacco.sacco_id', 'left');
        $builder->where('shares_on_sale.is_verified', '1');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getSacco($term){
        $builder = $this->db->table('sacco');
        $builder->select('sacco.name, sacco.sacco_id');
        $builder->like('sacco.name', $term);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getRecommendedShares(){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale .*, sacco.name, sacco.logo');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.is_verified', '1');
        $builder->orderBy('shares_on_sale.created_at', 'DESC');
        $builder->limit(4);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function checkIfSaved($ajax_share_id, $user_id){
        $builder = $this->db->table('saved');
        $builder->select('saved.share_id');
        $builder->where('saved.share_id', $ajax_share_id);
        $builder->where('saved.user_id', $user_id);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteShare($share_id){
        $builder = $this->db->table('saved');
        $builder->where('share_id', $share_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSavedShares(){
        $builder = $this->db->table('saved');
        $builder->select('saved.saved_id, shares_on_sale.shares_on_sale, shares_on_sale.total, sacco.name, sacco.logo');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = saved.share_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('saved.user_id', session()->get('currentLoggedInUser'));
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function deleteSavedShare($share_id, $user_id){
        $builder = $this->db->table('saved');
        $builder->where('saved_id', $share_id);
        $builder->where('user_id', $user_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveSearch($data){
        $builder = $this->db->table('search');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSearch($user_id){
        $builder = $this->db->table('search');
        $builder->select('search.search_id, search.sacco_name, search.total');
        $builder->where('search.user_id', $user_id);
        $builder->limit(4);
        $builder->orderBy('search.created_at', 'ASC');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function checkSearch( $user_id, $searchOne, $searchTwo){
        $builder = $this->db->table('search');
        $builder->select('search.*');
        $builder->where('search.sacco_name', $searchOne);
        $builder->where('search.user_id', $user_id);
        $builder->where('search.total', $searchTwo);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insertSMSLogs($data){
        $builder = $this->db->table('sms_logs');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}