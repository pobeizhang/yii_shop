<?php
    namespace app\modules\controllers;
    use yii\web\Controller;
    use Yii;
    use app\models\Home_product;
    use app\models\Home_category;
    use crazyfd\qiniu\Qiniu;
    use yii\data\Pagination;

class ProductController extends Controller
{
    //商品列表
    public function actionProductlist()
    {
        $model = Home_product::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $products = $model->offset($pager->offset)->limit($pager->limit)->all();
        $this->layout = 'layout1';
        return $this->render('productlist', ['products' => $products, 'pager' => $pager]);
    }
    //添加商品
    public function actionAddproduct()
    {
        $this->layout = 'layout1';
        $model = new Home_product;
        $category = new Home_category;
        $list = $category->getList();
        unset($list[0]);
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $pics = $this->upload();
            if(!$pics) {
                $model->addError('cover', '封面不能为空');
            } else {
                $post['Home_product']['cover'] = $pics['cover_link'];
                $post['Home_product']['pics'] = $pics['pics_link'];
            }
            if($pics && $model->add($post)) {
                Yii::$app->session->setFlash('info', '商品添加成功');
            } else {
                Yii::$app->session->setFlash('info', '商品添加失败');
            }
        }
        return $this->render('addproduct', ['model' => $model, 'list' => $list]);
    }

    private function upload()
    {
        if($_FILES['Home_product']['error']['cover'] > 0) {
            return false;
        }
        //调用七牛
        $qiniu = new Qiniu(Home_product::AK, Home_product::SK, Home_product::DOMAIN, Home_product::BUCKET);
        $key = uniqid();//七牛上面使用key来对应的存储图片
        $qiniu->uploadFile($_FILES['Home_product']['tmp_name']['cover'], $key);
        $cover_link = $qiniu->getLink($key);
        $pics_link = [];
        foreach($_FILES['Home_product']['tmp_name']['pics'] as $k => $v) {
            if($_FILES['Home_product']['error']['pics'][$k] > 0) {
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($v, $key);
            $pics_link[$key] = $qiniu->getLink($key);
        }
        return ['cover_link' => $cover_link, 'pics_link' => json_encode($pics_link)];
    }

    //修改商品
    public function actionEditproduct()
    {
        $this->layout = 'layout1';
        $pid = Yii::$app->request->get('pid');
        $model = Home_product::find()->where('pid = :id', [':id' => $pid])->one();
        $category = new Home_category;
        $list = $category->getList();
        unset($list[0]);

        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Home_product::AK, Home_product::SK, Home_product::DOMAIN, Home_product::BUCKET);
            $post['Home_product']['cover'] = $model->cover;
            if($_FILES['Home_product']['error']['cover'] == 0) {
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Home_product']['tmp_name']['cover'], $key);
                $post['Home_product']['cover'] = $qiniu->getLink($key);
                $qiniu->delete(basename($model->cover));
            }

            $pics = [];
            foreach($_FILES['Home_product']['tmp_name']['pics'] as $k=>$v) {
                if($_FILES['Home_product']['error']['pics'][$k] > 0) {
                    continue;
                }
                $key = uniqid();
                $qiniu->uploadFile($v, $key);
                $pics[$key] = $qiniu->getLink($key);
            }

            $post['Home_product']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '商品修改成功');
            }
        }
        return $this->render('addproduct', ['model' => $model, 'list' => $list]);
    }
    //修改商品时--删除商品图片
    public function actionRemovepics()
    {
        $key = Yii::$app->request->get('key');
        $pid = Yii::$app->request->get('pid');
        $model = Home_product::find()->where('pid = :id', [':id' => $pid])->one();
        $qiniu = new Qiniu(Home_product::AK, Home_product::SK, Home_product::DOMAIN, Home_product::BUCKET);
        //删除七牛上面的商品图片
        $qiniu->delete($key);
        //更新数据库中存放的商品图片地址
        $pics = (array)json_decode($model->pics, true);
        unset($pics[$key]);
        Home_product::updateAll(['pics' => json_encode($pics)], 'pid = :id', [':id' => $pid]);
        return $this->redirect(['product/editproduct', 'pid' => $pid]);
    }

    //删除商品
    public function actionDeleteproduct()
    {
        $pid = Yii::$app->request->get('pid');
        $model = Home_product::find()->where('pid = :id', [':id' => $pid])->one();
        $qiniu = new Qiniu(Home_product::AK, Home_product::SK, Home_product::DOMAIN, Home_product::BUCKET);
        $key = basename($model->cover);
        //删除商品封面图片
        $qiniu->delete($key);
        //删除商品图片
        $pics = json_decode($model->pics, true);
        foreach($pics as $k=>$v) {
            $qiniu->delete($k);
        }
        //删除数据库中的对应的商品信息
        Home_product::deleteAll('pid = :id', [':id' => $pid]);
        return $this->redirect(['product/productlist']);
    }

    //商品上架处理
    public function actionOn()
    {
        $pid = Yii::$app->request->get('pid');
        Home_product::updateAll(['ison' => 1], 'pid = :id', [':id' => $pid]);
        return $this->redirect(['product/productlist']);
    }

    //商品下架处理
    public function actionOff()
    {
        $pid = Yii::$app->request->get('pid');
        Home_product::updateAll(['ison' => 0], 'pid = :id', [':id' => $pid]);
        return $this->redirect(['product/productlist']);
    }
}
