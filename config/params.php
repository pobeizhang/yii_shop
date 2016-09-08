<?php

return [
    'adminEmail' => 'admin@example.com',
    //设置每页显示的页数
    'pageSize'   =>[
    	//后台管理员列表每页显示的条数
    	'manager' => '8',
    	//前台会员列表每页显示的条数
    	'user' => '8',
        //商品列表每页显示的条数
        'product' => 8,
        //前台商品每页展示条数
        'frontProduct' => 9
    ],
    'defaultValue' => [
    	'avatar' => 'assets/admin/img/contact-img.png'
    ],
    'express' => [
        1 => '中通快递',
        2 => '顺丰快递'
    ],
    'expressPrice' => [
        1 => 15,
        2 => 20
    ]
];
