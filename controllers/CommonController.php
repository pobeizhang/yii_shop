<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Home_category;
use app\models\Home_cart;
use app\models\Home_product;
use app\models\Home_user;

class CommonController extends Controller
{
    public function init()
    {
        //获取所有分类
        $menu = Home_category::getMenu();
        $this->view->params['menu'] = $menu;

        //搜索框右侧购物车数据
        $data = [];
        $data['products'] = [];
        $total = 0;
        $productnum = 0;
        if(Yii::$app->session['home']['isLogin'] == 1) {
            $userModel = Home_user::find()->where('homename = :uname', [':uname' => Yii::$app->session['home']['homename']])->one();
            if(!empty($userModel) && !empty($userModel->uid)) {
                $carts = Home_cart::find()->where('userid = :uid', [':uid' => $userModel->uid])->all();
                foreach($carts as $k=>$cart)
                {
                    $product = Home_product::find()->where('pid = :id', [':id' => $cart->productid])->one();
                    $data['products'][$k]['title'] = $product->title;
                    $data['products'][$k]['cover'] = $product->cover;
                    $data['products'][$k]['productnum'] = $cart->productnum;
                    $data['products'][$k]['price'] = $cart->price;
                    $data['products'][$k]['productid'] = $cart->productid;
                    $data['products'][$k]['cartid'] = $cart->cartid;
                    $total += $data['products'][$k]['price'] * $data['products'][$k]['productnum'];
                    $productnum += $cart->productnum;
                }
            }
            $this->view->params['carts'] = $data;
            $this->view->params['total'] = $total;
            $this->view->params['productnum'] = $productnum;
        } else {
            $this->view->params['total'] = 0;
            $this->view->params['productnum'] = 0;
            $this->view->params['carts'] = [];
            $this->view->params['carts']['products'] = [];
        }
    }
}
