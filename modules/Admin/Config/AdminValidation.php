<?php


namespace Modules\Admin\Config;

use Config\Validation;

class AdminValidation extends Validation{
    public $updateAccount = [

        'contactPersonPhone' => [
            'rules' => 'numeric|exact_length[10]',
            'errors' => [
                'numeric' => 'Phone number must be numeric',
                'exact_length' => 'Phone number must be 10 digits only'
            ]
        ],
        'ContactPersonEmail' => [
            'rules' => 'valid_email',
            'errors' => [
                'valid_email' => 'Email is not valid',
            ]
        ],
        'website' => [
            'rules' => 'valid_url_strict[https]',
            'errors' => [
                'valid_url_strict' => 'Website is not valid',
            ]
        ],
        'saccoLogo' => [
            'rules' => 'uploaded[saccoLogo]|max_size[saccoLogo,1024]|ext_in[saccoLogo,png,jpg,jpeg]',
            'errors' => [
                'uploaded' => 'Please select a logo',
                'max_size' => 'The logo size is too big',
                'ext_in' => 'The logo format is not supported',
            ]
        ],
    ];
}