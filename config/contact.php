<?php

return [
    'default' => [
        'country' => 'PH',
        'bank_code' => 'GXCHPHM2XXX',
    ],

    'kyc' => [
        'disk' => env('CONTACT_KYC_DISK', 'local'),
    ],
];
