    <div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>订单详情</h3>
                </div>
                <div class="row-fluid">
                    <p>订单编号：<?php echo $orderDetail->orderid ?></p>
                    <p>下单用户：<?php echo $orderDetail->username ?></p>
                    <p>收货地址：<?php echo $orderDetail->address ?></p>
                    <p>订单总价：<?php echo $orderDetail->amount ?></p>
                    <p>快递方式：<?php echo array_key_exists($orderDetail->expressid, \Yii::$app->params['express'])?\Yii::$app->params['express'][$orderDetail->expressid]:'' ?></p>
                    <p>快递编号：<?php echo $orderDetail->expressno ?></p>
                    <p>订单状态：<?php echo $orderDetail->zhstatus ?></p>
                    <p>商品列表：</p>
                    <p>
                        <?php foreach($orderDetail->products as $product): ?>
                        <div style="display:inline">
                            <img src="<?php echo $product->cover ?>-coversmall">
                            <?php echo $product->num ?> x <?php echo $product->title ?>
                        </div>
                        <?php endforeach; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

