<?php

return [
    'location_countries' => [
        'singular' => 'Ülke',
        'fields'   => [
            'name'    => 'Ülke',
        ],
    ],
    'location_provinces' => [
        'singular' => 'Şehir',
        'fields'   => [
            'name'    => 'Şehir',
            'country' => 'Ülke',
            'code'    => 'Plaka Kodu',
        ],
    ],
    'location_districts' => [
        'singular' => 'İlçe',
        'fields'   => [
            'name'     => 'İlçe',
            'province' => 'Şehir',
        ],
    ],
];