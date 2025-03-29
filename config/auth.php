<?php

return [


    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),
    ],



    'guards' => [
        'api' => ['driver' => 'passport'],
    ],


    'providers' => [
        //
    ],



    'passwords' => [
        //
    ],

];