<?php namespace app\modules\controllers;
use app\modules\controllers\CommonController;
use Yii;
use app\models\Home_user;
use app\models\Home_profile;
use yii\data\Pagination;

//前台会员模块
class UserController extends CommonController
{
	
	//添加会员
	public function actionAdduser()
	{
		$this->layout = 'layout1';
		$model = new Home_user;
		if(Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if($model->addUser($post)) {
				Yii::$app->session->setFlash('info', '会员添加成功');
			} else {
				Yii::$app->session->setFlash('info', '会员添加失败');
			}
		}
		$model->homepwd = '';
		$model->rehomepwd = '';
		return $this->render('adduser', ['model' => $model]);
	}
	
	//会员列表
	public function actionUserlists()
	{
		$this->layout = 'layout1';
		$model = Home_user::find()->joinWith('home_profile');
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['user'];
		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
		$users = $model->offset($pager->offset)->limit($pager->limit)->all();
		
		return $this->render('userlists', ['users' => $users, 'pager' => $pager]);
	}
	
	//删除会员
	public function actionDeluser()
	{
		try {
			$uid = (int)Yii::$app->request->get('uid');
			
			if(empty($uid)) {
				throw new \Exception('接收不到要删除的会员选项id');
			}
			//事物的开始
			$trans = Yii::$app->db->beginTransaction();
			//先删除会员详细信息表,先判断详细信息表中是否有会员的详细的信息，如果没有填写则不进行任何操作
			if($obj = Home_profile::find()->where('uid = :uid', [':uid' => $uid])->one()) {
				$res = Home_profile::deleteAll('uid = :uid', [':uid' => $uid]);
				if(!$res) {
					throw new \Exception('会员详细信息表删除失败');
				}
			}
			
			//在删除会员主表
			if(!Home_user::deleteAll('uid = :uid', [':uid' => $uid])) {
				throw new \Exception('会员主表删除失败');
			}
			//如果两张表都删除成功，在进行事物的提交
			$trans->commit();
		} catch(\Exception $e) {
			//检测是否有抛出异常
			if(Yii::$app->db->getTransaction()) {
				$trans->rollback();
			}
		}
		$this->redirect(['user/userlists']);
	}
}
