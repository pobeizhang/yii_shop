<?php namespace app\modules\controllers;
use yii\web\Controller;
use Yii;
use app\modules\models\Admin_user;
use yii\data\Pagination;

class ManageController extends Controller
{
	//邮箱找回管理员密码操作
	public function actionMailchangepass()
	{
		$time = Yii::$app->request->get('timestamp');
		$adminuser = Yii::$app->request->get('adminuser');
		$token = Yii::$app->request->get('token');
		$model = new Admin_user;
		$myToken = $model->createToken($adminuser, $time);
		
		//校验token
		if($token != $myToken){
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		
		//校验邮件链接失效时间
		if((time() - $time) > 300){
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($model->changePass($post)){
				Yii::$app->session->setFlash('info', '管理员密码修改成功');
			}
		}
		$model->adminuser = $adminuser;
		
		$this->layout = false;
		return $this->render('mailchangepass', ['model' => $model]);
	}
	
	//管理员列表
	public function actionManagerlists()
	{
		$this->layout = 'layout1';
		$model = Admin_user::find();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['manager'];
		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
		$managers = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('managerlists', ['managers' => $managers, 'pager' =>$pager]);
	}
	
	//添加新管理员
	public function actionAddmanager()
	{
		$this->layout = 'layout1';
		$model = new Admin_user;
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->addManager($post)) {
				Yii::$app->session->setFlash('info', '管理员添加成功');
			}else {
				Yii::$app->session->setFlash('info', '管理员添加失败');
			}
		}
		$model->adminpwd = '';
		$model->repwd = '';
		return $this->render('addmanager', ['model' => $model]);
	}
	
	//删除后台管理员
	public function actionDelmanager()
	{
		$adminid = Yii::$app->request->get('adminid');
		if(empty($adminid)) {
			$this->redirect(['manage/managerlists']);
		}
		$model = new Admin_user;
		if($model->deleteAll('id = :adminid', [':adminid' => $adminid])) {
			Yii::$app->session->setFlash('info', '管理员删除成功');
			$this->redirect(['manage/managerlists']);
		}
	}
	
	//修改管理员邮箱
	public function actionChangeemail()
	{
		$this->layout = 'layout1';
		$model = Admin_user::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->changeemail($post)) {
				Yii::$app->session->setFlash('info', '管理员邮箱修改成功');
			}
		}
		$model->adminpwd = '';
		return $this->render('changeemail', ['model' => $model]);
	}
	
	//修改管理员密码
	public function actionChangepass()
	{
		$this->layout = 'layout1';
		$model = Admin_user::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->changePass($post)) {
				Yii::$app->session->setFlash('info', '管理员密码修改成功');
			}
		}
		$model->adminpwd = '';
		$model->repwd = '';
 		return $this->render('changepass', ['model' => $model]);
	}
}
