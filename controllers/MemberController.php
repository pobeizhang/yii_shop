<?php namespace app\controllers;
use app\controllers\CommonController;
use yii\web\Controller;
use app\models\Home_user;
use Yii;

class MemberController extends CommonController
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

    //qq登录
    public function actionQqlogin()
    {
        require_once('../vendor/qqlogin/qqConnectAPI.php');
        $qc = new \QC();
        $qc->qq_login();
    }

    //qq登录回调函数
    public function actionQqcallback()
    {
        require_once("../vendor/qqlogin/qqConnectAPI.php");
        $oauth = new \Oauth();
        $access_token = $oauth->qq_callback();
        $openid = $oauth->get_openid();
        $qc = new \QC($access_token, $openid);
        $userinfo = $qc->get_user_info();
        //$session = Yii::$app->session;
        Yii::$app->session['userinfo'] = $userinfo;
        Yii::$app->session['openid'] = $openid;
        if($model = Home_user::find()->where('openid = :openid', [':openid' => $openid])->one())
        {
            Yii::$app->session['home'] = [
                "homename" => Yii::$app->session['userinfo']['nickname'],
                "isLogin" => 1
            ];
            return $this->redirect(['index/index']);
        }
        return $this->redirect(['member/qqreg']);
    }

    //绑定用户使用qq登录时的qq账号
    public function actionQqreg()
    {
        $this->layout = 'layout2';
        $model = new Home_user;
        if(Yii::$app->request->isPost)
        {
            $session = Yii::$app->session;
            $post = Yii::$app->request->post();
            $post['Home_user']['openid'] = $session['openid'];
            if($model->addUser($post, 'qqreg'))
            {
                $session['home']['homename'] = $post['Home_user']['homename'];
                $session['home']['isLogin'] = 1;
                return $this->redirect(['index/index']);
            }
            //p($model->getErrors());
        }
        return $this->render('qqreg', ['model' => $model]);
    }
}
