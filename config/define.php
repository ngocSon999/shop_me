<?php

return [
    'TYPE_CARD' => [
      1 => 'Viettel',
      2 => 'VinaPhone',
      3 => 'MobiPhone',
    ],
    'STATUS_CARD' => [
        0 => 'Đang chờ',
        1 => 'Thành công',
        2 => 'Thẻ không hợp lệ',
    ],
    'CARD_VALUE' => [
        10000 => '10.0000 đ',
        20000 => '20.0000 đ',
        50000 => '50.0000 đ',
        100000 => '100.0000 đ',
        200000 => '200.0000 đ',
        500000 => '500.0000 đ',
    ],
    'PUSHER_APP_KEY' => env('PUSHER_APP_KEY'),
    'PUSHER_APP_SECRET' => env('PUSHER_APP_SECRET'),
    'PUSHER_APP_CLUSTER' => env('PUSHER_APP_CLUSTER'),
    'PUSHER_SCHEME' => env('PUSHER_SCHEME'),
];
