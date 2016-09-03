<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Home_category;


class CommonController extends Controller
{
    public function init()
    {
        //获取所有分类
        $menu = Home_category::getMenu();
        $this->view->params['menu'] = $menu;

    }
}
