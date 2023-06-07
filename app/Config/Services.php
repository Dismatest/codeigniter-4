<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\UserDataService;
use App\Services\UserSaccoMembership;
use App\Services\SendTextMessageService;
use App\Services\UserShares;
use App\Services\IsApproved;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */

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
}

