<?php
namespace app\models;
use yii\db\ActiveRecord;

class Home_address extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%home_address}}";
    }

    public function rules()
    {
        return [
            [['userid', 'firstname', 'lastname', 'address', 'email', 'telephone'], 'required'],
            [['created_time', 'postcode'], 'safe']
        ];
    }
}
