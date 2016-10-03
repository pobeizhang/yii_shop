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
        'frontProduct' => 9,
        //后台订单展示页面显示条数
        'order' => 10
    ],
    'defaultValue' => [
    	'avatar' => 'assets/admin/img/contact-img.png'
    ],
    'express' => [
        1 => '中通快递',
        2 => '顺丰快递',
        3 => '包邮'
    ],
    'expressPrice' => [
        1 => 15,
        2 => 20,
        3 => 0
    ]
];
