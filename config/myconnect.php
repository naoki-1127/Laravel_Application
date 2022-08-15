<?php

return [

    'qiita' => [
        'base_uri' => env('QIITA_BASEURI', ''),
        'accesstoken' => env('QIITA_ACCESSTOKEN', ''),
    ],
    'box' => [
        'base_uri' => env('BOX_BASEURI', ''),
        'accesstoken' => env('BOX_ACCESSTOKEN', ''),
        'clientid' => env('BOX_CLIENTID', ''),
        'client_secret' => env('BOX_CLIENTSECRET',''),
        'redirect_uri' => env('BOX_REDIRECTURI','')
    ]
];
