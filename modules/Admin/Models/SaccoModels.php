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
        $builder->whereIn('shares_on_sale.is_verified', [0, 1, 2]);
        $builder->orderBy('shares_on_sale.created_at', 'DSC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function viewSoldShares(){
        $sacco_id = session()->get('sacco_id');
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.uniid, users.fname,users.lname,users.email,users.phone, sacco.name, shares_on_sale.*');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $builder->where('shares_on_sale.is_verified', 3);
        $builder->orderBy('shares_on_sale.created_at', 'DSC');
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
        $builder = $this->db->table('sacco_membership');
        $builder->select('users.fname,users.lname,users.phone,sacco.name, sacco_membership.membership_id, sacco_membership.id_number, sacco_membership.created_at');
        $builder->join('users', 'users.user_id = sacco_membership.user_id');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id');
        $builder->where('sacco_membership.sacco_id', $id);
        $builder->where('sacco_membership.status', 0);
        $builder->orderBy('sacco_membership.created_at', 'ASC');
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
        $builder = $this->db->table('callbacks');
        $builder->select(
            'callbacks.amount, callbacks.mpesaReceiptNumber, callbacks.transactionDate, callbacks.phoneNumber as seller_phone,
                    transactions.bid_id, bid_share.bid_amount, bid_share.buyer_membership_number,
                    u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, u2.lname as seller_lname, sacco.name,
                    shares_on_sale.membership_number as seller_membership_number, shares_on_sale.shares_on_sale, shares_on_sale.total
         ');
        $builder->join('transactions', 'transactions.merchantRequestID = callbacks.merchantRequestID', 'left');
        $builder->join('bid_share', 'bid_share.bid_id = transactions.bid_id', 'left');
        $builder->join('users as u1', 'u1.uniid = bid_share.buyer_id', 'left');
        $builder->join('users as u2', 'u2.user_id = bid_share.seller_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'left');
        $builder->where('bid_share.sacco_id', $sacco_id);
        $builder->orderBy('callbacks.transactionDate', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAttemptedTransactions($sacco_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.phone as seller_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, transactions.status, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $builder->where('transactions.amount', '0');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function deleteTransaction($id){
        $builder = $this->db->table('transactions');
        $builder->where('transaction_id', $id);
        $builder->delete();
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function viewCompletedTransactions($sacco_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.phone as seller_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, transactions.status, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $builder->where('transactions.status', '1');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getReport($sacco_id, $report_id){
        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.user_id as buyer_user_id, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.user_id as seller_user_id, u2.phone as seller_phone,transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
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
        $builder->select('shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.user_id, shares_on_sale.sacco_id, users.fname, users.lname');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->where('shares_on_sale.is_verified', 0);
        $builder->where('shares_on_sale.sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getEachShareNotification($share_id){
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.user_id, shares_on_sale.sacco_id, shares_on_sale.created_at, users.fname, users.lname, sacco.name');
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

    public function insertCsvData($data){
        try {
            $builder = $this->db->table('users');
            $builder->insertBatch($data);
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());
            log_message('error', $e->getTraceAsString());

            return false;
        }
    }

    public function findRecord($email, $phone){
        try {
            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->where('email', $email);
            $builder->where('phone', $phone);
            return $builder->countAllResults();

        } catch (\Exception $e) {

            log_message('error', $e->getMessage());
            log_message('error', $e->getTraceAsString());

            return false;
        }
    }

    public function getAllAppUsers($term){
        $builder = $this->db->table('users');
        $builder->select('users.user_id, users.fname, users.lname');
        $builder->like('users.fname', $term);
        $builder->orLike('users.lname', $term);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getComission(){
        $builder = $this->db->table('set_commission');
        $builder->select('set_commission.commission');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function updateSaccoLogo($data, $sacco_id){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $sacco_id);
        $builder->update(['logo' => $data]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateSaccoProfile($contactPhone, $contactEmail, $saccoHeadquarter, $website, $sacco_id){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $sacco_id);
        $builder->update(['contact_phone' => $contactPhone, 'contact_email' => $contactEmail, 'location' => $saccoHeadquarter, 'website' => $website]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getUpdatedProfile($sacco_id){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $sacco_id);
        $builder->select('sacco.contact_phone, sacco.contact_email, sacco.location, sacco.website, sacco.logo');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getSaccoImage($sacco_id){
        $builder = $this->db->table('sacco');
        $builder->select('sacco.logo');
        $builder->where('uuid', $sacco_id);
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getBidsReport($sacco_id){
        $builder = $this->db->table('bid_share');
        $builder->select('shares_on_sale.uuid, COUNT(bid_share.share_on_sale_id) as bidders_count, users.fname, users.lname, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.created_at, sacco.name');
        $builder->join('users', 'users.user_id = bid_share.seller_id', 'left');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left');
        $builder->groupBy('shares_on_sale.uuid, users.fname, users.lname, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.created_at, sacco.name, bid_share.created_at');
        $builder->where('bid_share.sacco_id', $sacco_id);
        $builder->orderBy('bid_share.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function checkAdminEmail($email){
        $builder = $this->db->table('sacco');
        $builder->select('uuid, name, email');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateResetTime($uuid){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->update(['updated_at' => date('Y-m-d H:i:s')]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function verifyUuid($uuid){
        $builder = $this->db->table('sacco');
        $builder->select('uuid, name, email, updated_at');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateAdminPassword($uuid, $password){
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->update(['password' => $password]);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }


}