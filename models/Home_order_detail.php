<?php
namespace app\models;
use yii\db\ActiveRecord;

class Home_order_detail extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%home_order_detail}}";
    }

    public function rules()
    {
        return [
            [['productid', 'productnum', 'price', 'orderid', 'created_time'], 'required']
        ];
    }


    public function addData($data)
    {
        if($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }
}
