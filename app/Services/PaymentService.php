<?php

namespace App\Services;
use CodeIgniter\Config\BaseService;
use App\Models\DisplayDashboardModel;
use CodeIgniter\API\ResponseTrait;
use Ramsey\Uuid\Uuid;

class PaymentService extends BaseService
{

    use ResponseTrait;
    protected $displayDashboard;
    public function __construct()
    {
        $this->displayDashboard = new DisplayDashboardModel();
    }
    public function payment($myPhone, $price, $bid_id){
        $url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
        $curl_post_data = [
            'BusinessShortCode' => getenv('MPESA_SHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHms'),
            'TransactionType' => "CustomerPayBillOnline",
            'Amount' => (float)$price, // $price
            'PartyA' => $myPhone,
            'PartyB' => getenv('MPESA_PARTYB'),
            'PhoneNumber' => $myPhone,
            'CallBackURL' => "https://saccohisa.mzawadi.com/payment/payment_callback",
            'AccountReference' => getenv('ACCOUNT_REF'),
            'TransactionDesc' => getenv('TRANSACTION_DESC'),
        ];

        $data_string = json_encode($curl_post_data);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->newAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $data = json_encode($curl_response);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            return [
                'status' => 500,
                'message' => 'We could not process your payment, try again later',
            ];
        } else {
            $response = json_decode($curl_response, true);
            if ($response['ResponseCode'] == 0) {

                $data = [
                    'transaction_uuid' => Uuid::uuid4()->toString(),
                    'bid_id' => $bid_id,
                    'merchantRequestID' => $response['MerchantRequestID'],
                    'checkoutRequestID' => $response['CheckoutRequestID'],
                ];

                $saveResponse = $this->displayDashboard->savePaymentsData($data);
                if ($saveResponse) {
                    return[
                        'status' => 200,
                        'merchantRequestID' => $response['MerchantRequestID'],
                        'message' => 'Payment Pending, please check your phone to complete the payment',
                    ];

                } else {
                    return [
                        'status' => 500,
                        'message' => 'We could not process your payment, please, try again later',
                    ];
                }
                curl_close($curl);
            }

        }
    }

   public function lipaNaMpesaPassword()
    {
        //timestamp
        $timestamp = date('YmdHms');
        //passkey
        $passKey = getenv('PASSKEY');

        $businessShortCOde = getenv('MPESA_SHORTCODE');
        //generate password
        return base64_encode($businessShortCOde . $passKey . $timestamp);

    }

    function newAccessToken()
    {
        $consumer_key = getenv('CONSUMER_KEY');
        $consumer_secret = getenv('CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials, "Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);
        curl_close($curl);

        if ($access_token) {
            return $access_token->access_token;
        } else {
            return false;
        }
    }

}
