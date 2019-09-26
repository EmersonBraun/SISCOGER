<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "sendmail", "mailgun", "mandrill", "ses",
    |            "sparkpost", "log", "array"
    |
    */

    //'driver' => env('MAIL_DRIVER', 'smtp'), DAVA ERRO

    // "driver" => "smtp",
    // "host" => "smtp.mailtrap.io",
    // "port" => 2525,
    // "from" => array(
    //     "address" => "from@example.com",
    //     "name" => "Example"
    // ),
    // "username" => "76e40eb3010618",
    // "password" => "b5cfbf0d01fa15",
    // "sendmail" => "/usr/sbin/sendmail -bs",

    'driver' => 'sendmail',
    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    'port' => env('MAIL_PORT', 587),
    'from' => [
        'address' => 'no-reply-pmpr@smtp.sesp.pr.gov.br',
        'name' => 'COGER',
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,
    
    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];