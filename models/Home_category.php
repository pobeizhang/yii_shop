<?php
    namespace app\models;
    use yii\db\ActiveRecord;
    use Yii;
    use app\modules\extentions\Data;
    use yii\helpers\ArrayHelper;

class Home_category extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%home_category}}";
    }

    public function attributeLabels()
    {
        return [
            'pid' => '所属分类',
            'title' => '分类标题'
        ];
    }

    //验证规则
    public function rules()
    {
        return [
            ['pid' , 'required', 'message' => '请选择所属分类'],
            ['title', 'required', 'message' => '分类名称不能为空'],
            ['created_time', 'safe']
        ];
    }

    //分类的树状处理
    public function getList()
    {
        $list=[];
        $list[0] = '顶级分类';
        $cates = ArrayHelper::toArray(self::find()->all());
        $data = new Data;
        $tree = $data->tree($cates, 'title', 'cid');
        foreach($tree as $k=>$v) {
            $list[$v['cid']] = $v['_title'];
        }
        return $list;

    }

     //分类列表的分类树状结构处理
     public function getCateListTree()
     {
	$cates = ArrayHelper::toArray(self::find()->all());
    $data = new Data;
	$tree = $data->tree($cates, 'title', 'cid');
	return $tree;
     }

    //添加分类
    public function addCategory($data)
    {
        $data['Home_category']['created_time'] = time();
        if($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

    //获取首页商品导航分类
    public static function getMenu()
    {
        //先获取顶级分类
        $tops = self::find()->where('pid = :pid', [':pid' => 0])->limit(9)->orderby('created_time asc')->asArray()->all();
        //在获取二级分类
        $data = [];
        foreach((array)$tops as $k => $top) {
            $top['child'] = self::find()->where('pid = :pid', [':pid' => $top['cid']])->limit(10)->asArray()->all();
            $data[] = $top;
        }
        return $data;
    }
}
