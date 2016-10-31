<?php namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Home_user extends ActiveRecord
{
	public $rehomepwd;
	public $rememberMe = true;
	public static function tableName()
	{
		return "{{%home_user}}";
	}
	
	//定义label
	public function attributeLabels()
	{
		return [
			'homename' => '会员用户名',
			'homeemail' => '会员邮箱',
			'homepwd' => '会员密码',
			'rehomepwd' => '确认密码'
		];
	}
	
	//定义自动验证规则
	public function rules()
	{
		return [
			['homename', 'required', 'message' => '会员名称不能为空', 'on' => ['addUser', 'userLogin', 'qqreg']],
            ['openid', 'required', 'message' => 'openid不能为空', 'on' => 'qqreg'],
            ['openid', 'unique', 'message' => 'openid已经被注册', 'on' => ['qqreg']],
			['homeemail', 'required', 'message' => '会员邮箱不能为空', 'on' => ['addUser', 'registerByEmail']],
			['rememberMe', 'boolean', 'on' => 'userLogin'],
			['homeemail', 'email', 'message' => '邮箱格式不正确', 'on' => ['addUser']],
			['homename', 'unique', 'message' => '此用户名已被占用', 'on' => ['addUser', 'qqreg']],
			['homeemail', 'unique', 'message' => '此邮箱已被注册', 'on' => ['addUser', 'registerByEmail']],
			['homepwd', 'required', 'message' => '会员密码不能为空', 'on' => ['addUser', 'userLogin', 'qqreg']],
			['homepwd', 'validateHomepwd', 'on' => ['userLogin']],
			['rehomepwd', 'required', 'message' => '确认密码不能为空', 'on' => ['addUser', 'qqreg']],
			['rehomepwd' ,'compare', 'compareAttribute' => 'homepwd', 'message' => '两次密码不一致', 'on' => ['addUser', 'qqreg']]
		];
	}
	
	//验证登录信息
	public function validateHomepwd()
	{
		if(!$this->hasErrors()) {
			$res = self::find()->where('homename = :name and homepwd = :pwd', [':name' => $this->homename, ':pwd' => md5($this->homepwd)])->one();
			if(is_null($res)) {
				$this->addError('homepwd', '用户名或者密码错误');
			}
		}
	}
	
	//添加会员
	public function addUser($data, $scenario = 'addUser')
	{
		$this->scenario = $scenario;
		if($this->load($data) && $this->validate()) {
			$this->homename = $data['Home_user']['homename'];
			$this->homepwd = md5($data['Home_user']['homepwd']);
			$this->created_time = time();
			if($this->save(false)) {
				return true;
			}
			return false;
		}
		return false;
	}
	
	//关联home_profile表的操作
	public function getHome_profile()
	{
		return $this->hasOne(Home_profile::ClassName(), ['uid' =>'uid']);
	}
	
	//登录页面中通过邮箱注册会员
	public function registerByEmail($data)
	{
		//uniqid() 函数基于以微秒计的当前时间，生成一个唯一的 ID。
		$data['Home_user']['homename'] = 'yii_shop' . uniqid();
		$data['Home_user']['homepwd'] = uniqid();
		$this->scenario = 'registerByEmail';
		if($this->load($data) && $this->validate()) {
			$mailer = Yii::$app->mailer->compose('registerByEmail', ['homename' => $data['Home_user']['homename'], 'homepwd' => $data['Home_user']['homepwd']]);
      		$mailer->setFrom('dulei1618@163.com');
			$mailer->setTo($data['Home_user']['homeemail']);
			$mailer->setSubject('用户的注册账号和密码');
			if($mailer->send() && $this->addUser($data, 'registerByEmail')){
				return true;
			}
		}
		return false;
	}

	//前台会员登录
	public function userLogin($data)
	{
		$this->scenario = 'userLogin';
		if($this->load($data) && $this->validate()) {
			$lifetime = $this->rememberMe ? 7*24*3600 : 0;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['home'] = [
				'homename' => $this->homename,
                'mark' => 'account',
				'isLogin' => 1
			];
			return (bool)$session['home']['isLogin'];
		}
	}
}
