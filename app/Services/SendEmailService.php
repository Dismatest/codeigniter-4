<?php

namespace App\Services;
use CodeIgniter\Config\BaseService;

class SendEmailService extends BaseService
{

    protected $email;
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }
    public function send_email($name, $email, $subject, $message)
    {
        $this->email->setFrom('billclintonogot88@gmail.com', 'Sacco hisa Admin');
        $this->email->setTo("$email");

        $this->email->setSubject($subject);

        $email_template = view('Modules\SupperAdmin\Views\sacco\email-template', [
            'name' => $name,
            'message' => $message
        ]);

        // Set email message
        $this->email->setMessage($email_template);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

}
