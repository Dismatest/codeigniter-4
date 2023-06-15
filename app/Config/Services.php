<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\UserDataService;
use App\Services\UserSaccoMembership;
use App\Services\SendTextMessageService;
use App\Services\UserShares;
use App\Services\IsApproved;
use App\Services\SendEmailService;
use App\Services\PaymentService;

class Services extends BaseService
{
    public static function userData($getShared = true)
      {
          if ($getShared) {
             return static::getSharedInstance('userData');
          }

          return new UserDataService();
     }

    public static function membershipData($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('membershipData');
        }

        return new UserSaccoMembership();
    }


    public static function userShears($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userShares');
        }

        return new UserShares();
    }

    public static function isApproved($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('isApprovedShares', false);
        }

        return new IsApproved();
    }

    public static function sendSMS($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('sendSMS');
        }

        return new SendTextMessageService();
    }

    public static function sendEmail($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('sendEmail');
        }

        return new SendEmailService();
    }

    public static function paymentService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('paymentService');
        }

        return new PaymentService();
    }
}

