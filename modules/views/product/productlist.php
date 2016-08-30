<!-- end sidebar -->
        <link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
        <!-- main container -->
        <div class="content">
            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>商品列表</h3>
                        <div class="span10 pull-right">
                            <a href="<?= yii\helpers\Url::to(['product/addproduct']);?>" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新商品</a></div>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span6 sortable">
                                        <span class="line"></span>商品名称</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>商品库存</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>商品单价</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>是否热卖</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>是否促销</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>促销价</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>是否上架</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>是否推荐</th>
                                    <th class="span3 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach($products as $k => $v):?>
                                <tr class="first">
                                    <td>
                                        <img src="<?= $v->cover;?>" class="img-circle avatar hidden-phone" />
                                        <a href="#" class="name"><?= $v->title;?></a></td>
                                    <td><?= $v->num;?></td>
                                    <td><?= $v->price;?></td>
                                    <td><?php if($v->ishot == 1) {echo '热卖';} else {echo '不热卖';};?></td>
                                    <td><?php if($v->issale == 1) {echo '促销';} else {echo '不促销';};?></td>
                                    <td><?= $v->saleprice;?></td>
                                    <td><?php if($v->ison == 1) {echo '上架';} else {echo '下架';};?></td>
                                    <td><?php if($v->istui == 1) {echo '推荐';} else {echo '不推荐';};?></td>
                                    <td class="align-right">
                                        <a href="<?= yii\helpers\Url::to(['product/editproduct', 'pid' => $v->pid]);?>">编辑</a>
                                        <a href="<?= yii\helpers\Url::to(['product/on', 'pid' => $v->pid]);?>">上架</a>
                                        <a href="<?= yii\helpers\Url::to(['product/off', 'pid' => $v->pid]);?>">下架</a>
                                        <a href="<?= yii\helpers\Url::to(['product/deleteproduct', 'pid' => $v->pid]);?>">删除</a></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pull-right">
                        <?php echo yii\widgets\LinkPager::widget([
                            'pagination' => $pager,
                            'prevPageLabel' => '&#8249;',
                            'nextPageLabel' => '&#8250;'
                        ]);?>
                    </div>
                    <!-- end users table --></div>
            </div>
        </div>
        <!-- end main container -->
        <!-- scripts -->
