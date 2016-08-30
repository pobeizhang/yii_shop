<?php
    namespace app\modules\controllers;

    use yii\web\Controller;
    use app\models\Home_category;
    use Yii;
    use app\modules\extentions\Data;
    use yii\helpers\ArrayHelper;

class CategoryController extends Controller
{

    //商品分类列表
    public function actionCategorylists()
    {
        $this->layout = 'layout1';
	$model = new Home_category;
	$cates = $model->getCateListTree();
        return $this->render('categorylists', ['cates' => $cates]);
    }

    //添加商品分类
    public function actionAddcategory()
    {
        $this->layout = 'layout1';
        $model = new Home_category;
        $list = $model->getList();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->addCategory($post)) {
                Yii::$app->session->setFlash('info', '分类添加成功');
            }
        }
        return $this->render('addcategory', ['model' => $model, 'list' => $list]);
    }

    //删除商品
    public function actionDelcategory()
    {
	try{
        	$cid = (int)Yii::$app->request->get('cid');
		//echo $cid;
		if(empty($cid)) {
			throw new \Exception('请选择要删除的商品分类');
		}
		//事物开始
		$trans = Yii::$app->db->beginTransaction();
		$data = new Data;
		$cates =ArrayHelper::toArray(Home_category::find()->all());
		//var_dump($cates);
		//先删除要删除的分类的子分类(如果点击删除的分类有子分类的话)
		foreach($cates as $k=>$v) {
			if($data->isChild($cates, (int)$v['cid'], $cid, 'cid', 'pid')) {
				$res = Home_category::deleteAll('cid = :cid', [':cid' => (int)$v['cid']]);
				if(!$res) {
					throw new \Exception('分类子类删除失败');
				}
			}
		}
		//再删除当前要删除的分类
		$res2 = Home_category::deleteAll('cid = :cid', [':cid' => $cid]);
		if(!$res2) {
			throw new \Exception('分类删除失败');
		}
		//提交事务
		$trans->commit();
	}catch(\Exception $e) {
		if(Yii::$app->db->getTransaction()) {
			$trans->rollback();
		}
	}
	return $this->redirect(['category/categorylist']);
    }
    public function actionEditcategory()
    {
	$this->layout = 'layout1';
	$cid = (int)Yii::$app->request->get('cid');
	$model = Home_category::find()->where('cid = :id', [':id' => $cid])->one();
	$list = $model->getList();
	if(Yii::$app->request->isPost) {
		$post = Yii::$app->request->post();
		if($model->load($post) && $model->save()) {
			Yii::$app->session->setFlash('info', '分类修改成功');
		}
	}
	return $this->render('addcategory', ['model' => $model, 'list' => $list]);
    }
}
