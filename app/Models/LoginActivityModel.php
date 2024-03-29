<?php

namespace App\Models;

use \CodeIgniter\Model;

class LoginActivityModel extends Model
{
    public function saveLoginActivityInfo($data)
    {
        $builder = $this->db->table('login_activities');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return $this->insertID; //returning the id of the last inserted data
        } else {
            return false;
        }
    }

    public function updateLogoutActivity($loggedIn_id)
    {
        $builder = $this->db->table('login_activities');
        $builder->where('uniid', $loggedIn_id);
        $builder->update(['logout_time' => date('Y-m-d h:i:s')]);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function getAllLoginActivities()
    {
        $builder = $this->db->table('login_activities');
        $builder->select('login_activities.*, users.fname, users.lname');
        $builder->join('users', 'users.uniid = login_activities.uniid');
        $builder->orderBy('login_activities.login_time', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    //all the supperAdmin shares model methods
    public function deleteActivity($id)
    {
        $builder = $this->db->table('login_activities');
        $builder->where('id', $id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function findAllUsers()
    {
        $builder = $this->db->table('users');
        return $builder->countAllResults();
    }

    public function findAllSaccoCount()
    {
        $builder = $this->db->table('sacco');
        return $builder->countAllResults();
    }

    public function findAllTransactions()
    {
        $builder = $this->db->table('callbacks');
        $builder->selectSum('amount');
        $query = $builder->get();
        return $query->getRow()->amount;

    }

    //all the supperAdmin shares model methods
    public function sharesReport()
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->select('shares_on_sale.uuid, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, shares_on_sale.total, users.fname, users.lname, sacco.name, bid_share.bid_amount, callbacks.amount');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left');
        $builder->join('bid_share', 'bid_share.share_on_sale_id = shares_on_sale.uuid', 'left');
        $builder->join('transactions', 'transactions.bid_id = bid_share.bid_id', 'left');
        $builder->join('callbacks', 'callbacks.merchantRequestID = transactions.merchantRequestID', 'left');
        $builder->where('shares_on_sale.is_verified', '1');
        $builder->orderBy('shares_on_sale.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function viewSoldShares()
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.uniid, users.fname,users.lname,users.email,users.phone, sacco.name, shares_on_sale.*');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('shares_on_sale.is_verified', 3);
        $builder->orderBy('shares_on_sale.created_at', 'DSC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function markSold($uuid)
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->where('uuid', $uuid);
        $builder->update(['is_verified' => 3]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllNotAprovedShares()
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.fname, users.lname, shares_on_sale.*, sacco.name');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id');
        $builder->where('is_verified', '0');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function findAllBids()
    {
        $builder = $this->db->table('bid_share');
        $builder->select('shares_on_sale.uuid, COUNT(bid_share.share_on_sale_id) as bidders_count, users.fname, users.lname, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.created_at, sacco.name');
        $builder->join('users', 'users.user_id = bid_share.seller_id', 'left');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left');
        $builder->groupBy('shares_on_sale.uuid, users.fname, users.lname, shares_on_sale.shares_on_sale, shares_on_sale.total, shares_on_sale.membership_number, shares_on_sale.created_at, sacco.name, bid_share.created_at');
        $builder->orderBy('bid_share.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function approveShare($uuid)
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->where('uuid', $uuid);
        $builder->update(['is_verified' => 1]);
        if ($this->db->affectedRows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllAllShares()
    {
        $builder = $this->db->table('shares_on_sale');
        $builder->select('users.fname, users.lname, shares_on_sale.*, sacco.name');
        $builder->join('users', 'users.user_id = shares_on_sale.user_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function deleteShare($uuid)
    {
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function updateShare($uuid, $data)
    {
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $builder->update($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function getShare($uuid)
    {
        $builder = $this->db->table('shares');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    //all the sacco supperAdmin methods

    public function registerSacco($data)
    {
        $builder = $this->db->table('sacco');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true; //returning the id of the last inserted data
        } else {
            return false;
        }
    }

    public function findAllSacco()
    {
        $builder = $this->db->table('sacco');
        $builder->select('*');
        $builder->orderBy('created_at', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function deleteSacco($uuid)
    {
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function findSacco($uuid)
    {
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateSacco($uuid, $data)
    {
        $builder = $this->db->table('sacco');
        $builder->where('uuid', $uuid);
        $builder->update($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllRecords()
    {
        $builder = $this->db->table('set_commission');
        $builder->select('*');
        $builder->orderBy('created_at', 'DSC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function findAllRecordsSellerCommission()
    {
        $builder = $this->db->table('seller_commission');
        $builder->select('*');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function insertCommission($data)
    {
        $builder = $this->db->table('set_commission');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function insertSellerCommission($data)
    {
        $builder = $this->db->table('seller_commission');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getCommissionById($commission_id)
    {
        $builder = $this->db->table('set_commission');
        $builder->select('*');
        $builder->where('commission_id', $commission_id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getSellerCommissionById($commission_id)
    {
        $builder = $this->db->table('seller_commission');
        $builder->select('*');
        $builder->where('commission_id', $commission_id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateCommission($id, $data)
    {
        $builder = $this->db->table('set_commission');
        $builder->where('commission_id', $id);
        $builder->update(['commission' => $data]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSellersCommission($id, $data)
    {
        $builder = $this->db->table('seller_commission');
        $builder->where('commission_id', $id);
        $builder->update(['seller_commission' => $data]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSellerCommission($id, $data)
    {
        $builder = $this->db->table('seller_commission');
        $builder->where('commission_id', $id);
        $builder->update(['seller_commission' => $data]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCommission($commission_id)
    {
        $builder = $this->db->table('set_commission');
        $builder->where('commission_id', $commission_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

    public function deleteSellerCommission($commission_id)
    {
        $builder = $this->db->table('seller_commission');
        $builder->where('commission_id', $commission_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }


    public function findAllAuditTrail()
    {
        $builder = $this->db->table('email_logs');
        $builder->select('email_logs.fname, email_logs.email, email_logs.message_title, email_logs.role, email_logs.status, email_logs.created_at');
        $builder->orderBy('created_at', 'DESC');
        return $builder->get()->getResultArray();

    }

    public function findAllSMSAuditTrail()
    {
        $builder = $this->db->table('sms_logs');
        $builder->select('sms_logs.fname, sms_logs.phone, sms_logs.message_title, sms_logs.role, sms_logs.status, sms_logs.created_at');
        $builder->orderBy('created_at', 'DESC');
        return $builder->get()->getResultArray();

    }

    public function deleteAuditTrail($id)
    {
        $builder = $this->db->table('errors');
        $builder->where('error_id', $id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }

//    public function viewTransactions($user_id){
//
//        $builder = $this->db->table('transactions');
//        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname,
//        u2.lname as seller_lname, u2.phone as buyer_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate,
//        transactions.phoneNumber, transactions.status, shares_on_sale.membership_number, shares_on_sale.shares_on_sale,
//        shares_on_sale.total');
//        $builder->join('users as u1', 'u1.uniid = transactions.user_id', 'left');
//        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id', 'left');
//        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id', 'left');
//        $builder->where('transactions.status', 1);
//        $query = $builder->get();
//        return $query->getResultArray();
//
//    }


    public function viewTransactions($admin_id)
    {
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
        $builder->orderBy('callbacks.transactionDate', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTransactionSummery(){
        $builder = $this->db->table('callbacks');
        $builder->select('SUM(callbacks.amount) as total_amount, sacco.sacco_id, sacco.name');
        $builder->join('transactions', 'transactions.merchantRequestID = callbacks.merchantRequestID', 'left');
        $builder->join('bid_share', 'bid_share.bid_id = transactions.bid_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left');
        $builder->groupBy('sacco.sacco_id, sacco.name');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function transactionHistoryView($sacco_id)
    {
        $builder = $this->db->table('callbacks');
        $builder->select('callbacks.amount, callbacks.transactionDate, sacco.name');
        $builder->join('transactions', 'transactions.merchantRequestID = callbacks.merchantRequestID', 'left');
        $builder->join('bid_share', 'bid_share.bid_id = transactions.bid_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left');
        $builder->where('sacco.sacco_id', $sacco_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function pendingTransactions($user_id)
    {

        $builder = $this->db->table('transactions');
        $builder->select('u1.fname as buyer_fname, u1.lname as buyer_lname, u1.phone as buyer_phone, u2.fname as seller_fname, 
        u2.lname as seller_lname, u2.phone as buyer_phone, transactions.transaction_id, transactions.amount, transactions.mpesaReceiptNumber, transactions.transactionDate, 
        transactions.phoneNumber, transactions.status, shares_on_sale.membership_number, shares_on_sale.shares_on_sale, 
        shares_on_sale.total');
        $builder->join('users as u1', 'u1.uniid = transactions.user_id', 'left');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = transactions.share_id', 'left');
        $builder->join('users as u2', 'u2.user_id = shares_on_sale.user_id', 'left');
        $builder->where('transactions.status', 0);
        $query = $builder->get();
        return $query->getResultArray();

    }

    public function getAllSacco()
    {
        $builder = $this->db->table('sacco');
        $builder->select('sacco.sacco_id, sacco.name');
        $builder->where('commission', 0);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function insertSaccoCommission($sacco_id, $commission)
    {
        $builder = $this->db->table('set_sacco_commission');
        $builder->insert(['sacco_id' => $sacco_id, 'sacco_commission' => $commission]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSaccoCommission($sacco_id)
    {
        $builder = $this->db->table('sacco');
        $builder->where('sacco_id', $sacco_id);
        $builder->update(['commission' => 1]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSaccoCommissionOnDeletion($sacco_id)
    {
        $builder = $this->db->table('sacco');
        $builder->where('sacco_id', $sacco_id);
        $builder->update(['commission' => 0]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSaccoCommission()
    {
        $builder = $this->db->table('set_sacco_commission');
        $builder->select('set_sacco_commission.sacco_commission_id, set_sacco_commission.sacco_id, set_sacco_commission.sacco_commission, sacco.name');
        $builder->join('sacco', 'sacco.sacco_id = set_sacco_commission.sacco_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getSaccoCommissionById($sacco_commission_id)
    {
        $builder = $this->db->table('set_sacco_commission');
        $builder->select('set_sacco_commission.sacco_commission_id, set_sacco_commission.sacco_id, set_sacco_commission.sacco_commission, sacco.name');
        $builder->join('sacco', 'sacco.sacco_id = set_sacco_commission.sacco_id', 'left');
        $builder->where('set_sacco_commission.sacco_commission_id', $sacco_commission_id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateSaccoCommissionById($sacco_id, $data)
    {
        $builder = $this->db->table('set_sacco_commission');
        $builder->where('sacco_id', $sacco_id);
        $builder->update(['sacco_commission' => $data]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSaccoCommissionById($sacco_commission_id)
    {
        $builder = $this->db->table('set_sacco_commission');
        $builder->where('sacco_commission_id', $sacco_commission_id);
        $builder->delete();
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registerNewAdmin($data)
    {
        $builder = $this->db->table('supperAdmins');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminPassword($adminID)
    {
        $builder = $this->db->table('supperAdmins');
        $builder->select('password');
        $builder->where('admin_id', $adminID);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updatePassword($adminID, $password)
    {
        $builder = $this->db->table('supperAdmins');
        $builder->where('admin_id', $adminID);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAdminEmail($email)
    {
        $builder = $this->db->table('supperadmins');
        $builder->select('admin_id, uuid, fname, lname, email');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function insertEmailLogs($data)
    {
        $builder = $this->db->table('email_logs');
        $builder->insert($data);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateResetTime($uuid)
    {
        $builder = $this->db->table('supperadmins');
        $builder->where('uuid', $uuid);
        $builder->update(['updated_at' => date('Y-m-d H:i:s')]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function verifyUuid($uuid)
    {
        $builder = $this->db->table('supperadmins');
        $builder->select('uuid, fname, email, updated_at');
        $builder->where('uuid', $uuid);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateAdminPassword($uuid, $password)
    {
        $builder = $this->db->table('supperadmins');
        $builder->where('uuid', $uuid);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getBidsByShareUuid($uuid)
    {
        $builder = $this->db->table('bid_share');
        $builder->select('shares_on_sale.uuid, users.fname, users.lname, shares_on_sale.shares_on_sale, shares_on_sale.total, sacco.name, bid_share.uuid as bid_uuid, bid_share.buyer_membership_number, bid_share.bid_amount, bid_share.action, bid_share.updated_at');
        $builder->join('users', 'users.uniid = bid_share.buyer_id', 'left');
        $builder->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left');
        $builder->where('bid_share.share_on_sale_id', $uuid);
        $builder->orderBy('bid_share.updated_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function checkApprove($uuid)
    {
        $builder = $this->db->table('bid_share');
        $builder->select('bid_share.action');
        $builder->where('bid_share.share_on_sale_id', $uuid);
        $builder->whereIn('bid_share.action', ['1', '2']);
        $query = $builder->countAllResults();
        if ($query > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function approveShareAdmin($shareUuid){
        $builder = $this->db->table('bid_share');
        $builder->where('uuid', $shareUuid);
        $builder->update(['action' => '1']);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function rejectShareAdmin($shareUuid){
        $builder = $this->db->table('bid_share');
        $builder->where('uuid', $shareUuid);
        $builder->update(['action' => '2']);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSaccoMembers(){
        $builder = $this->db->table('sacco_membership');
        $builder->select('sacco_membership.membership_id, sacco_membership.id_number, sacco_membership.status, sacco_membership.created_at, users.fname, users.lname, users.email, users.phone, sacco.name');
        $builder->join('users', 'users.user_id = sacco_membership.user_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id', 'left');
        $builder->orderBy('sacco_membership.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getMemberData($membership_id){
        $builder = $this->db->table('sacco_membership');
        $builder->select('sacco_membership.id_number, sacco_membership.status, sacco_membership.created_at, users.fname, users.lname, users.email, users.phone, sacco.name');
        $builder->join('users', 'users.user_id = sacco_membership.user_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id', 'left');
        $builder->where('sacco_membership.membership_id', $membership_id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function approveNewMember($membership_id){
        $builder = $this->db->table('sacco_membership');
        $builder->where('membership_id', $membership_id);
        $builder->update(['status' => '1', 'updated_at' => date('Y-m-d H:i:s')]);
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getMembersReport($saccoId){
        $builder = $this->db->table('sacco_membership');
        $builder->select('sacco_membership.membership_id, sacco_membership.id_number, sacco_membership.status, sacco_membership.updated_at, users.fname, users.lname, users.email, users.phone');
        $builder->join('users', 'users.user_id = sacco_membership.user_id', 'left');
        $builder->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id', 'left');
        $builder->where('sacco_membership.sacco_id', $saccoId);
        $builder->where('sacco_membership.status', '1');
        $builder->orderBy('sacco_membership.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

}