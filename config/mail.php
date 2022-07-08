<?php

return [
    'SMTP' => [
        'CharSet'    => 'UTF-8',
        'Host'       => $_ENV['MAIL_HOST'],
        'SMTPAuth'   => true,
        'AuthType'   => $_ENV['MAIL_AUTH_TYPE'],
        'Username'   => $_ENV['MAIL_USERNAME'],
        'Password'   => $_ENV['MAIL_PASSWORD'],
        'Port'       => $_ENV['MAIL_PORT'],
        'redirectUri' => $_ENV['MAIL_REDIRECT_URL'],
        'clientId'    => $_ENV['MAIL_CLIENT_ID'],
        'clientSecret' => $_ENV['MAIL_CLIENT_SECRET'],
        "refreshToken" => $_ENV['MAIL_REFRESH_TOKEN'],
        'setFrom'    => [
            'mail'  =>  $_ENV['MAIL_SETFROM_ADDRESS'],
            'name'  =>  'Legend'
        ]
    ]
];
