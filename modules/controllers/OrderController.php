<?php 
namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use Yii;
use yii\data\Pagination;

use app\models\Home_order;
use app\models\Home_order_detail;
use app\models\Home_product;
use app\models\Home_address;
use app\models\Home_user;



class OrderController extends CommonController
{
    //订单列表
    public function actionList()
    {
        $this->layout = 'layout1';
        $model = Home_order::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['order'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pager->offset)->limit($pager->limit)->all();
        $data = Home_order::getDetail($data);
        return $this->render('list', ['pager' => $pager, 'orders' => $data]);
    }

    //订单详情
    public function actionOrderdetail()
    {
        $this->layout = 'layout1';
        $orderid = Yii::$app->request->get('orderid');
        $order = Home_order::find()->where('orderid = :oid', [':oid' => $orderid])->one();
        $orderDetail = Home_order::getData($order);
       return $this->render('detail', ['orderDetail' => $orderDetail]);
    }

    //发货
    public function actionSend()
    {
        $this->layout = 'layout1';
        $orderid = Yii::$app->request->get('orderid');
        $model = Home_order::find()->where('orderid = :oid', [':oid' => $orderid])->one();
        $model->scenario = 'send';
        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $model->status = Home_order::SENDED;
            if($model->load($post) && $model->save())
            {
               return $this->redirect(['order/list', 'orderid' => $orderid]);
            }
        }
        return $this->render('send', ['model' => $model]);
    }
}
