<?php namespace app\modules\models;
use yii\db\ActiveRecord;
use Yii;

class Admin_user extends ActiveRecord
{
	public $rememberMe = true;
	public $repwd;
	//定义管理员添加页面中的label属性
	public function attributeLabels()
	{
		return [
			'adminuser' => '管理员账号',
			'adminemail' => '管理员邮箱',
			'adminpwd' => '管理员密码',
			'repwd' => '确认密码'
		];
	}
	
	public static function tableName()
	{
		return "{{%admin_user}}";
	}
	
	//登录信息验证
	public function rules()
	{
		return [
			['adminuser', 'required', 'message' => '用户名不能为空', 'on' => ['login', 'seekpassword', 'changepass', 'addManager', 'changeemail', 'editpass']],
			['adminpwd', 'required', 'message' => '密码不能为空', 'on' => ['login', 'changepass', 'addManager', 'changeemail', 'editpass']],
			['rememberMe', 'boolean', 'on' => 'login'],
			['adminpwd', 'validatePwd', 'on' => ['login', 'changeemail']],
			['adminemail', 'required', 'message' => '邮箱不能为空', 'on' => ['seekpassword', 'addManager', 'changeemail']],
			['adminemail', 'email', 'message' => '邮箱格式不正确', 'on' => ['seekpassword', 'addManager', 'changeemail']],
			['adminemail', 'unique', 'message' => '此邮箱已被使用', 'on' => ['addManager', 'changeemail']],
			['adminuser', 'unique', 'message' => '此账号已被使用', 'on' => 'addManager'],
			['adminemail', 'validateEmail', 'on' => 'seekpassword'],
			['repwd', 'required', 'message' => '确认密码不能为空', 'on' => ['changepass', 'addManager', 'editpass']],
			['repwd', 'compare', 'compareAttribute' => 'adminpwd', 'message' => '两次密码不一致', 'on' => ['changepass', 'addManager', 'editpass']]
		];
	}

	//验证账号和密码的回调函数
	public function validatePwd()
	{
		if(!$this->hasErrors()){
			$data = self::find()->where('adminuser = :user and adminpwd = :pwd', [':user' => $this->adminuser, ':pwd' => md5($this->adminpwd)])->one();
			if(is_null($data)){
				$this->addError('adminpwd', '用户名或者密码错误');
			}
		}
	}

	//验证邮箱的回调函数---用于密码找回操作
	public function validateEmail()
	{
		if(!$this->hasErrors()){
			$data = self::find()->where('adminuser = :user and adminemail = :email', [':user' => $this->adminuser, ':email' => $this->adminemail])->one();
			if(is_null($data)){
				$this->addError('adminemail', '管理员账户或者电子邮箱不匹配');
			}
		}
	}
	
	//登录处理--登录操作
	public function login($data){
		$this->scenario = 'login';
		if($this->load($data) && $this->validate()){
			$lifetime = $this->rememberMe ? 24*3600 : 0;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['admin'] = [
				'adminuser' => $this->adminuser,
				'isLogin' => 1
			];
			$this->updateAll(['logintime' => time(), 'loginip' => ip2long(Yii::$app->request->userIP)],'adminuser = :user', [':user' => $this->adminuser]);
			return (bool)$session['admin']['isLogin'];
		}
		return false;
	}
	
	//修改密码操作---用于管理员密码找回
	public function seekpassword($data)
	{
		$this->scenario = 'seekpassword';
		if($this->load($data) && $this->validate()){
			$time = time();
			$token = $this->createToken($data['Admin_user']['adminuser'], $time);
			$mailer = Yii::$app->mailer->compose('seekpassword', ['adminuser' => $data['Admin_user']['adminuser'], 'time' => $time, 'token' => $token]);
      		$mailer->setFrom('dulei1618@163.com');
			$mailer->setTo($data['Admin_user']['adminemail']);
			$mailer->setSubject('商城后台密码找回');
			if($mailer->send()){
				return true;
			}
		}
		return false;
	}
	
	//生成token--用于生成密码找回时生成邮箱链接中的token
	public function createToken($adminuser, $time)
	{
		return md5(md5($adminuser) . base64_encode(Yii::$app->request->userIP) . md5($time));
	}
	
	//邮箱找回管理员密码操作
	public function changePass($data)
	{
		$this->scenario = 'changepass';
		if ($this->load($data) && $this->validate()) {
			return (bool)$this->updateAll(['adminpwd' => md5($this->adminpwd)], 'adminuser =:user', [':user' => $this->adminuser]);
		}
		return false;
	}
	
	//管理员添加
	public function addManager($data)
	{
		$this->scenario = 'addManager';
		if($this->load($data) && $this->validate()) {
			$this->adminpwd = md5($this->adminpwd);
			//save中第一个参数传入false表示在写入数据库的时候不在进行自动验证
			if($this->save(false)) {
				return true;
			}
			return false;
		}
		return false;
	}
	
	//修改管理员邮箱
	public function changeemail($data)
	{
		$this->scenario = 'changeemail';
		if($this->load($data) && $this->validate()) {
			return (bool)$this->updateAll(['adminemail' => $this->adminemail], 'adminuser = :user', [':user' => $this->adminuser]);
		}
		return false;
	}
	
}