        <!-- end sidebar -->
        <link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
        <!-- main container -->
        <div class="content">
            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>订单列表</h3></div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span2 sortable">
                                        <span class="line"></span>订单编号</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>下单人</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>收货地址</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>快递方式</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>订单总价</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>商品列表</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>订单状态</th>
                                    <th class="span2 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach($orders as $order): ?>
                                <tr class="first">
                                <td><?= $order->orderid;?></td>
                                <td><?= $order->username;?></td>
                                <td><?= $order->address;?></td>
                                    <td>
                                        <?php
                                            if(array_key_exists($order->expressid, \Yii::$app->params['express'])) {
                                                echo Yii::$app->params['express'][$order->expressid];
                                            }
                                        ?>
                                    </td>
                                    <td><?= $order->amount;?></td>
                                    <td>
                                    <?php foreach($order->products as $product):?>
                                    <?= $product->num;?> x
                                    <a href="<?= yii\helpers\Url::to(['/product/detail', 'pid' => $product->pid]);?>"><?= $product->title;?></a><br />
                                    <?php endforeach;?>
                                    </td>
                                    <?php
                                        if(in_array($order->status, [0])) {
                                            $info = 'error';
                                        }
                                        if(in_array($order->status, [100, 202])) {
                                            $info = 'info';
                                        }
                                        if(in_array($order->status, [201])) {
                                            $info = 'warning';
                                        }
                                        if(in_array($order->status, [220, 260])) {
                                            $info = 'success';
                                        }
                                    ?>
                                    <td>
                                    <span class="label label-<?= $info;?>"><?= $order->zhstatus;?></span></td>
                                    <td class="align-right">
                                    <?php if($order->status == 202): ?>
                                        <a href = "<?= yii\helpers\Url::to(['order/send', 'orderid' => $order->orderid]);?>">发货</a>
                                    <?php endif; ?>
                                    <a href="<?= yii\helpers\Url::to(['order/orderdetail', 'orderid' => $order->orderid]);?>">查看</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pull-right">
                        <?= yii\widgets\LinkPager::widget([
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
