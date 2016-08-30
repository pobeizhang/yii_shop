<?php
	namespace app\modules\controllers;
	use yii\web\Controller;
	use app\modules\models\Admin_user;
	use Yii;
class PublicController extends Controller
{
	//登录操作
	public function actionLogin()
	{
		$this->layout = false;
		$model = new Admin_user;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($model->login($post)){
				$this->redirect(['default/index']);
				Yii::$app->end();
			}
		}
		return $this->render('login',['model' => $model]);
	}
	
	//退出登录
	public function actionLogout()
	{
		Yii::$app->session->remove('admin');
		if(!isset(Yii::$app->session['admin']['isLogin'])){
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		$this->goback();
	}
	
	//找回密码
	public function actionSeekpwd()
	{
		$this->layout = false;
		$model = new Admin_user;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
//			var_dump($post);
			if($model->seekpassword($post)){
				Yii::$app->session->setFlash('info', '邮件已经发送成功，请注意查收');
			}
		}
		return $this->render('seekpwd', ['model' => $model]);
	}
}
