<?php
    namespace app\models;
    use yii\db\ActiveRecord;

class Home_product extends ActiveRecord
{
    const AK = 'ouJmR7G2kV9EiUD4Sh07UMrtKe-D74q_I8Gvc5x2';
    const SK = 'LKoul4nC5YgfTJ4S2MPQWhhf5fttlFX-gdCMTWjm';
    const DOMAIN = 'obzlvnjse.bkt.clouddn.com';//临时域名
    const BUCKET = 'yii-shop';//空间名称
    public $cate;

    public static function tableName()
    {
        return "{{%home_product}}";
    }

    public function attributeLabels()
    {
        return [
            'cid' => '商品分类',
            'title' => '商品名称',
            'descr' => '商品描述',
            'price' => '商品价格',
            'ishot' => '是否热卖',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'num' => '商品库存',
            'ison' => '是否上架',
            'istui' => '是否推荐',
            'cover' => '商品封面',
            'pics' => '商品图片'
        ];
    }

    //验证规则
    public function rules()
    {
        return [
            ['cid', 'required', 'message' => '请选择商品所属分类'],
            ['title', 'required', 'message' => '请填写商品标题'],
            ['descr', 'required', 'message' => '请填写商品描述'],
            ['price', 'required', 'message' => '请填写商品价格'],
            ['saleprice', 'required', 'message' => '请填写商品促销价格'],
            ['num', 'required', 'message' => '请填写商品库存'],
            [['price', 'saleprice'], 'number', 'min' => '0.01', 'message' => '商品价格必须是数字'],
            ['num', 'integer', 'min' => '0', 'message' => '商品库存必须是数字'],
            [['issale', 'ishot', 'pics', 'istui'], 'safe'],
            [['cover'], 'required']
        ];
    }

    //添加商品
    public function add($data)
    {
        if($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }
}
