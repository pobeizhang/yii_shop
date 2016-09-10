<?php
namespace app\controllers;
use app\controllers\CommmonController;
use Yii;
use app\models\Home_user;
use app\models\Home_address;

Class AddressController extends CommonController
{
    public function actionAdd()
    {
        //判断是否登陆
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['memeber/auth']);
        }
        $userid = Home_user::find()->where('homename = :name', [':name' => Yii::$app->session['home']['homename']])->one()->uid;
        //判断是否是post提交数据
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $post['userid'] = $userid;
            $post['address'] = $post['address1'] . $post['address2'];
            $post['created_time'] = time();
            $data['Home_address'] = $post;
            $model = new Home_address;
            $model->load($data);
            $model->save();
        }
        //返回跳转过来的页面
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
    //删除对应的地址
    public function actionDel()
    {
        //判断是否登陆
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $userid = Home_user::find()->where('homename = :name', [':name' => Yii::$app->session['home']['homename']])->one()->uid;
        $addressid = Yii::$app->request->get('addressid');
        if(!Home_address::find()->where('userid = :uid and addressid = :aid', [':uid' => $userid, ':aid' => $addressid])->one()) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
        Home_address::deleteAll('addressid = :aid', [':aid' => $addressid]);
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
