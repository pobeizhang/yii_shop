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

   //public $products;
   //public $zhstatus;
   //public $username;
   //public $address;

    public static function tableName()
    {
        return "{{%home_order}}";
    }
    public function rules()
    {
        return [
            [['userid', 'status'], 'required', 'on' => 'add'],
           //[['addressid', 'expressid', 'amount', 'status'], 'required', 'on' => 'update'],
            //['expressno', 'required', 'message' => '请输入快递单号', 'on' => 'send'],
            ['created_time', 'safe', 'on' => 'add']
        ];
    }

    //public function attributeLabels()
    //{
        //return [
            //'expressno' => '快递单号'
        //];
    //}
}
