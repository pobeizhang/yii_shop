<?php namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Home_order;
use app\models\Home_user;
use app\models\Home_product;
use app\models\Home_cart;
use app\models\Home_order_detail;
use app\models\Home_address;

class OrderController extends Controller
{
    //用户订单中心页面
    public function actionIndex()
    {
        $this->layout = "layout2";
        return $this->render('index');
    }

    //前台收银台页面
    public function actionCheck()
    {
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $orderid = Yii::$app->request->get('orderid');
        $status = Home_order::find()->where('orderid = :oid', [':oid' => $orderid])->one()->status;
        //如何已经支付过，则不能再进入到收银台页面
        if($status != Home_order::CREATEORDER && $status != Home_order::CHECKORDER) {
            return $this->redirect(['order/index']);
        }
        $userid = Home_user::find()->where('homename = :uname', [':uname' => Yii::$app->session['home']['homename']])->one()->uid;
        $addresses = Home_address::find()->where('userid = :uid', [':uid' => $userid])->asArray()->all();
        $orderDetails = Home_order_detail::find()->where('orderid = :oid', [':oid' => $orderid])->asArray()->all();
        $data = [];
        foreach ($orderDetails as $detail) {
            $model = Home_product::find()->where('pid = :id', [':id' => $detail['productid']])->one();
            $detail['title'] = $model->title;
            $detail['cover'] = $model->cover;
            $data[] = $detail;
        }
        $express = Yii::$app->params['express'];
        $expressPrice = Yii::$app->params['expressPrice'];
        $this->layout = "layout1";
        return $this->render('check', ['express' => $express, 'expressPrice' => $expressPrice, 'addresses' => $addresses, 'products' => $data]);
    }

    //生成订单
    public function actionAdd()
    {
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try{
            if(Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $orderModel = new Home_order;
                $orderModel->scenario = 'add';
                $userModel = Home_user::find()->where('homename = :uname', [':uname' => Yii::$app->session['home']['homename']])->one();
                if(!$userModel) {
                    throw new \Exception('执行$userModel出错');
                }
                $userid = $userModel->uid;
                $orderModel->userid = $userid;
                $orderModel->status = Home_order::CREATEORDER;
                $orderModel->created_time = time();
                if(!$orderModel->save()) {
                    throw new \Exception('orderModel执行save出错');
                }
                $orderid = $orderModel->getPrimaryKey();
                foreach ($post['orderDetail'] as $product) {
                    $model = new Home_order_detail;
                    $product['productid'] = $product['\'productid\''];
                    $product['productnum'] = $product['\'productnum\''];
                    $product['price'] = $product['\'price\''];
                    $product['orderid'] = $orderid;
                    $product['created_time'] = time();
                    $data['Home_order_detail'] = $product;
                    if(!$model->addData($data)) {
                        throw new \Exception('$model->addData($data)');
                    }
                    //Home_cart::deleteAll('productid = :pid', [':pid' => $product['productid']]);
                    Home_product::updateAll(['num' => -$product['productnum']], 'pid = :id', [':id' => $product['productid']]);
                }
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollback();
            p($e);die;
            //return $this->redirect(['cart/index']);
        }
        return $this->redirect(['order/check', 'orderid' => $orderid]);
    }
}
