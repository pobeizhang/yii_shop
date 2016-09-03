<!-- ============================================================= HEADER : END ============================================================= -->		<section id="cart-page">
    <div class="container">
        <!-- ========================================= CONTENT ========================================= -->
        <div class="col-xs-12 col-md-9 items-holder no-margin">
        <?php $total = 0;?>
            <?php foreach($data as $k=>$v):?>
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                    <img class="lazy" alt="" src="<?= $v['cover']?>-coversmall" />
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                    <a href="#"><?= $v['title']?></a>
                    </div>
                    <div class="brand"></div>
                </div>

                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                            <form>
                                <a class="minus" href="#reduce"></a>
                                <input name="productnum" id = "<?= $v['cartid']?>" readonly="readonly" type="text" value="<?= $v['productnum']?>" />
                                <a class="plus" href="#add"></a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price" id = "price<?= $v['cartid']?>">
                    $<span><?= $v['price']?></span>
                    </div>
                    <a class="close-btn" href="<?= yii\helpers\Url::to(['cart/del', 'cartid' => $v['cartid']])?>"></a>
                </div>
            </div><!-- /.cart-item -->
            <?php $total += $v['price'] * $v['productnum']?>
            <?php endforeach;?>
        </div>
        <!-- ========================================= CONTENT : END ========================================= -->

        <!-- ========================================= SIDEBAR ========================================= -->

        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">商品购物车</h1>
                <div class="body">
                    <ul class="tabled-data no-border inverse-bold">
                        <li>
                            <label>购物车总价</label>
                            <div class="value pull-right">$<span><?= $total;?></span></div>
                        </li>
                    </ul>
                    <ul id="total-price" class="tabled-data inverse-bold no-border">
                        <li>
                            <label>订单总价</label>
                            <div class="value pull-right ordertotal">$<span><?= $total;?></span></div>
                        </li>
                    </ul>
                    <div class="buttons-holder">
                        <a class="le-button big" href="checkout.html" >去结算</a>
                        <a class="simple-link block" href="<?= yii\helpers\Url::to(['index/index']);?>" >继续购物</a>
                    </div>
                </div>
            </div><!-- /.widget -->

            <div id="cupon-widget" class="widget">
                <h1 class="border">使用优惠券</h1>
                <div class="body">
                    <form>
                        <div class="inline-input">
                            <input data-placeholder="请输入优惠券码" type="text" />
                            <button class="le-button" type="submit">使用</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.widget -->
        </div><!-- /.sidebar -->

        <!-- ========================================= SIDEBAR : END ========================================= -->
    </div>
</section>		<!-- ============================================================= FOOTER ============================================================= -->
