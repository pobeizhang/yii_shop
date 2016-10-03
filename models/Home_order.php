<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Home_order extends ActiveRecord
{
    const CREATEORDER = 0;
    const CHECKORDER = 100;
    const PAYFAILED = 201;
    const PAYSUCCESS = 202;
    const SENDED = 220;
    const RECEIVED = 260;
    public static $status = [
        self::CREATEORDER => '订单初始化',
        self::CHECKORDER => '待支付',
        self::PAYFAILED => '支付失败',
        self::PAYSUCCESS => '支付成功',
        self::SENDED => '已发货',
        self::RECEIVED => '订单完成'
    ];

   public $products;//订单展示页面中需要的所有的商品的列表信息
   public $zhstatus;//使用中文说明订单的状态
   public $username;//用户名
   public $address;//收货地址

    public static function tableName()
    {
        return "{{%home_order}}";
    }
    public function rules()
    {
        return [
            [['userid', 'status'], 'required', 'on' => 'add'],
            [['addressid', 'expressid', 'amount', 'status'], 'required', 'on' => 'update'],
            ['expressno', 'required', 'message' => '请输入快递单号', 'on' => 'send'],
            ['created_time', 'safe', 'on' => 'add']
        ];
    }

    public function attributeLabels()
    {
        return [
            'expressno' => '快递单号'
        ];
    }

    public function getDetail($orders)
    {
        foreach($orders as $order)
        {
            $order = self::getData($order);
        }
        return $orders;
    }
    public function getData($order)
    {
        $details = Home_order_detail::find()->where('orderid = :oid', [':oid' => $order->orderid])->all();
        $products = [];
        foreach($details as $detail) {
            $product = Home_product::find()->where('pid = :id', [':id' => $detail->productid])->one();
            if(empty($product)) {
                continue;
            }
            $product->num = $detail->productnum;
            $products[] = $product;
        }
        $order->products = $products;
        $user = Home_user::find()->where('uid = :id', [':id' => $order->userid])->one();
        if(!empty($user)) {
            $order->username = $user->homename;
        }
        $order->address = Home_address::find()->where('addressid = :aid', [':aid' => $order->addressid])->one();
        if(empty($order->address)) {
            $order->address = '';
        } else {
            $order->address = $order->address->address;
        }
        $order->zhstatus = self::$status[$order->status];
        return $order;
    }
}
