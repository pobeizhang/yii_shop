<?php namespace app\controllers;
use app\controllers\CommonController;
use Yii;
use app\models\Home_cart;
use app\models\Home_product;
use app\models\Home_user;


class CartController extends CommonController
{
    //购物车页面
    public function actionIndex()
    {
        $this->layout = "layout1";
        //判断是否登陆
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        //获取用户ID
        $userid = Home_user::find()->where('homename = :uname', [':uname' => Yii::$app->session['home']['homename']])->one()->uid;
        //根据用户ID获取该用户购物车数据
        $carts = Home_cart::find()->where('userid = :uid', [':uid' => $userid])->asArray()->all();
        $data = [];
        foreach($carts as $k => $cart) {
            $product = Home_product::find()->where('pid = :pid', [':pid' => $cart['productid']])->one();
            $data[$k]['cover'] = $product->cover;
            $data[$k]['title'] = $product->title;
            $data[$k]['productnum'] = $cart['productnum'];
            $data[$k]['price'] = $cart['price'];
            $data[$k]['productid'] = $cart['productid'];
            $data[$k]['cartid'] = $cart['cartid'];
        }
        return $this->render('index', ['data' => $data]);
    }

    //添加到购物车
    public function actionAdd()
    {
        //判断用户是否登陆
        if(Yii::$app->session['home']['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        //获取用户ID
        $userid = Home_user::find()->where('homename = :uname', [':uname' => Yii::$app->session['home']['homename']])->one()->uid;
        //如果是post提交，则是通过商品详情页添加的购物车
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $productnum = Yii::$app->request->post()['productnum'];
            $data['Home_cart'] = $post;
            $data['Home_cart']['userid'] = $userid;
        }
        //如果是get提交，则是通过商品展示页面添加的购物车
        if(Yii::$app->request->isGet) {
            $productid = Yii::$app->request->get('productid');
            $model = Home_product::find()->where('pid = :pid', [':pid' => $productid])->one();
            $price = $model->issale ? $model->saleprice : $model->price;
            $productnum = 1;
            $data['Home_cart'] = [
                'productid' => $productid,
                'productnum' => $productnum,
                'price' => $price,
                'userid' => $userid
            ];
        }
        if(!$model = Home_cart::find()->where('productid = :pid and userid = :uid', [':pid' => $data['Home_cart']['productid'], ':uid' => $userid])->one()) {
            $model = new Home_cart;
        } else {
            $data['Home_cart']['productnum'] = $model->productnum + $productnum;
        }
        $data['Home_cart']['created_time'] = time();
        $model->load($data);
        //save方法会自动识别$model，如果$model是实例化出来的，就往数据库中插入数据，如果$model是查询出来的，就执行更新操作
        $model->save();
        return $this->redirect(['cart/index']);
    }

}
