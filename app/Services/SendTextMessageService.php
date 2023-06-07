<?php

namespace App\Services;
use CodeIgniter\Config\BaseService;

class SendTextMessageService extends BaseService{
    public function text_msg($phone_no, $message)
    {
        $headers = array(
            "Content-Type: application/json"
        );

        $payload = array(
            "apikey" => getenv('MESSAGE_API_KEY'),
            "partnerID" => getenv('MESSAGE_PARTNER_ID'),
            'pass_type' => "plain",
            "shortcode" => getenv('MESSAGE_SHORT_CODE'),
            "mobile" => $phone_no,
            "message" => $message,
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://quicksms.advantasms.com/api/services/sendsms/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        try {
            $response = curl_exec($ch);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $this->adminModel->insertError($e->getMessage());
        }
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "HTTP Status: " . $http_status;

        curl_close($ch);

        return json_decode($response);
    }
}