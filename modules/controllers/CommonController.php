<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;

class CommonController extends Controller
{
    public function init()
    {
        if(!isset(Yii::$app->session['admin']['isLogin']))
        {
            return $this->redirect(['/admin/public/login']);
        }
    }
}
