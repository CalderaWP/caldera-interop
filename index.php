<?php

include_once __DIR__ . '/vendor/autoload.php';

$fields = [
    [
        'ID' => 'fld40',
        'slug' => 'text_field',
        'config' => [
            'option' => []
        ]
    ],
    [
        'ID' => 'fld41',
        'slug' => 'button',
        'config' => [
            'option' => []
        ]
    ]
];

$collection = new \calderawp\interop\Collections\EntityCollections\Fields( $fields );


$i = 0;
foreach ( $collection as $key => $item ){
    var_dump($item);
}