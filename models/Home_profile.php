<?php namespace app\models;
use yii\db\ActiveRecord;

class Home_profile extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%home_profile}}";
	}
}
