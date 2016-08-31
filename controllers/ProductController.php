<?php namespace app\controllers;
use app\controllers\CommonController;
use yii\data\Pagination;
use Yii;
use app\models\Home_product;

class ProductController extends CommonController
{
    //商品分类页面加载
    public function actionIndex()
    {
        $this->layout = "layout2";
        $cid = Yii::$app->request->get('cid');
        $where = 'cid = :cid and ison = 1';
        $param = [':cid' => $cid];
        $model = Home_product::find()->where($where, $param);
        $all = $model->asArray()->all();
        //分页
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['frontProduct'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $all = $model->offset($pager->offset)->limit($pager->limit)->asArray()->all();

        $tuis = $model->where($where . ' and istui=1', $param)->orderby('created_time desc')->limit(5)->all();
        $hots = $model->where($where . ' and ishot=1', $param)->orderby('created_time desc')->limit(5)->all();
        $sales = $model->where($where . ' and issale=1', $param)->orderby('created_time desc')->limit(5)->all();

        return $this->render('index', ['tuis' => $tuis, 'hots' => $hots, 'sales' =>$sales, 'count' => $count, 'pager' => $pager, 'all' =>$all]);
    }

    //商品详情页面加载
    public function actionDetail()
    {
        $this->layout = "layout2";
        $pid = Yii::$app->request->get('pid');
        $product = Home_product::find()->where('pid = :id', [':id' => $pid])->asArray()->one();
        return $this->render('detail', ['product' => $product]);
    }
}
