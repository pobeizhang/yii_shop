<?php namespace app\controllers;
use yii\web\Controller;
use app\models\Home_user;
use Yii;

class MemberController extends Controller
{
    //用户登陆页面加载
    public function actionAuth()
    {
        $this->layout = "layout2";
		$model = new Home_user;
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->userLogin($post)) {
				$this->redirect(['index/index']);
				Yii::$app->end();
			}
		}
        return $this->render('auth', ['model' => $model]);
    }
	
	//退出登录操作
	public function actionLoginout()
	{
		Yii::$app->session->remove('home');
		if(!isset(Yii::$app->session['home']['isLogin'])){
			$this->redirect(['member/auth']);
			Yii::$app->end();
		}
		$this->goback();
	}
	
	//用户通过邮箱注册新账号
	public function actionRegisterbyemail()
	{
		$model = new Home_user;
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->registerByEmail($post)) {
				Yii::$app->session->setFlash('info', '邮件已经发送至你的邮箱，请注意查收');
			}
		}
		$this->layout = 'layout2';
		return $this->render('auth', ['model' => $model]);
	}
}
