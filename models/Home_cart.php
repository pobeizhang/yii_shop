<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Home_cart extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%home_cart}}";
    }

    public function rules()
    {
        return [
            [['productid', 'productnum', 'price', 'userid'], 'required'],
            ['created_time', 'safe']
        ];
    }
}
