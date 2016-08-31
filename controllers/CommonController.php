<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Home_category;


class CommonController extends Controller
{
    public function init()
    {
        $menu = Home_category::getMenu();
        $this->view->params['menu'] = $menu;
    }
}
