<?php 
namespace app\modules\controllers;

use yii\web\Controller;
use Yii;
use yii\data\Pagination;

use app\models\Home_order;
use app\models\Home_order_detail;
use app\models\Home_product;
use app\models\Home_address;
use app\models\Home_user;



class OrderController extends Controller
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
}
