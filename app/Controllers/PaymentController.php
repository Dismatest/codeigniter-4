<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\Controller;
use Safaricom\Mpesa\Mpesa;

class PaymentController extends Controller
{
    private $consumerKey = 'YOUR_CONSUMER_KEY';
    private $consumerSecret = 'YOUR_CONSUMER_SECRET';
    private $env = 'sandbox'; // Change to 'live' for live environment

    public function index()
    {
        $mpesa = new Mpesa($this->consumerKey, $this->consumerSecret, $this->env);
    }



    public function initiatePayment()
    {
        $mpesa = new Mpesa($this->consumerKey, $this->consumerSecret, $this->env);

        $BusinessShortCode = 'YOUR_BUSINESS_SHORTCODE';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = '100';
        $PartyA = '2547XXXXXXXX';
        $PartyB = $BusinessShortCode;
        $PhoneNumber = '2547XXXXXXXX';
        $CallBackURL = 'YOUR_CALLBACK_URL';
        $AccountReference = 'YOUR_ACCOUNT_REFERENCE';
        $TransactionDesc = 'YOUR_TRANSACTION_DESCRIPTION';

        $result = $mpesa->c2b($BusinessShortCode, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc);

        if ($result['ResponseCode'] == '0') {
            $transactionID = $result['CheckoutRequestID'];
            echo $transactionID;
        }
    }
}

