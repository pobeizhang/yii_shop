
<!-- ============================================================= HEADER : END ============================================================= -->		<section id="category-grid">
    <div class="container">

        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!-- ========================================= PRODUCT FILTER ========================================= -->
<div class="widget">
    <h1>商品筛选</h1>
    <div class="body bordered">

        <div class="category-filter">
            <h2>品牌</h2>
            <hr>
            <ul>
                <li><input checked="checked" class="le-checkbox" type="checkbox"  /> <label>Samsung</label> <span class="pull-right">(2)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Dell</label> <span class="pull-right">(8)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Toshiba</label> <span class="pull-right">(1)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Apple</label> <span class="pull-right">(5)</span></li>
            </ul>
        </div><!-- /.category-filter -->

        <div class="price-filter">
            <h2>价格</h2>
            <hr>
            <div class="price-range-holder">

                <input type="text" class="price-slider" value="" >

                <span class="min-max">
                    Price: ￥89 - ￥2899
                </span>
                <span class="filter-button">
                    <a href="#">筛选</a>
                </span>
            </div>
        </div><!-- /.price-filter -->

    </div><!-- /.body -->
</div><!-- /.widget -->
<!-- ========================================= PRODUCT FILTER : END ========================================= -->
            <div class="widget">
	<h1 class="border">特价商品</h1>
	<ul class="product-list">
        <?php foreach($sales as $sale):?>
        <li>
            <div class="row">
                <div class="col-xs-4 col-sm-4 no-margin">
                <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $sale['pid']]);?>" class="thumb-holder">
                    <img alt="" src="<?= $sale['cover']?>"/>
                    </a>
                </div>
                <div class="col-xs-8 col-sm-8 no-margin">
                <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $sale['pid']]);?>"><?= $sale['title']?></a>
                    <div class="price">
                    <div class="price-prev">￥<?= $sale['price']?></div>
                    <div class="price-current">￥<?= $sale['saleprice']?></div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach;?> 
    </ul>
</div><!-- /.widget -->
<!-- ========================================= FEATURED PRODUCTS ========================================= -->
<div class="widget">
    <h1 class="border">推荐商品</h1>
    <ul class="product-list">
        <?php foreach($tuis as $tui):?>
        <li class="sidebar-product-list-item">
            <div class="row">
                <div class="col-xs-4 col-sm-4 no-margin">
                <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $tui['pid']]);?>" class="thumb-holder">
                    <img alt="" src="<?= $tui['cover']?>"/>
                    </a>
                </div>
                <div class="col-xs-8 col-sm-8 no-margin">
                <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $tui['pid']]);?>"><?= $tui['title']?></a>
                    <div class="price">
                    <div class="price-prev">￥<?= $tui['price']?></div>
                    <div class="price-current">￥<?= $tui['saleprice']?></div>
                    </div>
                </div>
            </div>
        </li><!-- /.sidebar-product-list-item -->
        <?php endforeach;?>
    </ul><!-- /.product-list -->
</div><!-- /.widget -->
<!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <section id="recommended-products" class="carousel-holder hover small">

    <div class="title-nav">
        <h2 class="inverse">热卖商品</h2>
        <div class="nav-holder">
            <a href="#prev" data-target="#owl-recommended-products" class="slider-prev btn-prev fa fa-angle-left"></a>
            <a href="#next" data-target="#owl-recommended-products" class="slider-next btn-next fa fa-angle-right"></a>
        </div>
    </div><!-- /.title-nav -->

    <div id="owl-recommended-products" class="owl-carousel product-grid-holder">
        <?php foreach($hots as $hot):?>
        <div class="no-margin carousel-item product-item-holder hover size-medium">
            <div class="product-item">
                <div class="ribbon red"><span>hot</span></div>
                <div class="image">
                   <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $hot['pid']]);?>"> <img alt="" src="<?= $hot['cover']?>-covermiddle"/></a>
                </div>
                <div class="body">
                    <div class="title">
                    <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $hot['pid']]);?>"><?= $hot['title']?></a>
                    </div>
                    <div class="brand">sharp</div>
                </div>
                <div class="prices">
                <div class="price-current text-right">￥<?= $hot['price']?></div>
                </div>
                <div class="hover-area">
                    <div class="add-cart-button">
                    <a href="<?= yii\helpers\Url::to(['cart/add', 'productid' => $hot['pid']]);?>" class="le-button">加入购物车</a>
                    </div>
                </div>
            </div>
        </div><!-- /.carousel-item -->
        <?php endforeach;?>
    </div><!-- /#recommended-products-carousel .owl-carousel -->
</section><!-- /.carousel-holder -->
            <section id="gaming">
    <div class="grid-list-products">
        <h2 class="section-title">所有商品</h2>

        <div class="control-bar">
            <div id="popularity-sort" class="le-select" >
                <select data-placeholder="sort by popularity">
                    <option value="1">1-100 个用户</option>
                    <option value="2">101-200 个用户</option>
                    <option value="3">200+ 个用户</option>
                </select>
            </div>

            <div id="item-count" class="le-select">
                <select>
                    <option value="1">24个/页</option>
                    <option value="2">48个/页</option>
                    <option value="3">32个/页</option>
                </select>
            </div>

            <div class="grid-list-buttons">
                <ul>
                    <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> 图文</a></li>
                    <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> 列表</a></li>
                </ul>
            </div>
        </div><!-- /.control-bar -->

        <div class="tab-content">
            <div id="grid-view" class="products-grid fade tab-pane in active">

                <div class="product-grid-holder">
                    <div class="row no-margin">
                        <?php foreach($all as $pro):?>
                        <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                            <div class="product-item">
                                <?php if($pro['issale'] == 1):?>
                                <div class="ribbon red"><span>sale</span></div>
                                <?php endif;?>
                                <div class="image">
                                   <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $pro['pid']]);?>"> <img alt="" src="<?= $pro['cover']?>"/></a>
                                </div>
                                <div class="body">
                                <div class="label-discount green">-<?= round($pro['saleprice'] / $pro['price'] * 100, 0);?>% sale</div>
                                    <div class="title">
                                    <a href="<?= yii\helpers\Url::to(['product/detail', 'pid' => $pro['pid']]);?>"><?= $pro['title']?></a>
                                    </div>
                                    <div class="brand">sony</div>
                                </div>
                                <div class="prices">
                                    <?php if($pro['issale'] == 1):?>
                                    <div class="price-prev">￥<?= $pro['price']?></div>
                                    <div class="price-current pull-right">￥<?= $pro['saleprice']?></div>
                                    <?php else:?>
                                    <div class="price-prev">￥<?= $pro['price']?></div>
                                    <?php endif;?>
                                </div>
                                <div class="hover-area">
                                    <div class="add-cart-button">
                                    <a href="<?= yii\helpers\Url::to(['cart/add', 'productid' => $pro['pid']]);?>" class="le-button">加入购物车</a>
                                    </div>

                                </div>
                            </div><!-- /.product-item -->
                        </div><!-- /.product-item-holder -->
                        <?php endforeach;?> 
                    </div><!-- /.row -->
                </div><!-- /.product-grid-holder -->

                <div class="pagination-holder">
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 text-left">
                            <?php 
                                echo yii\widgets\LinkPager::widget([
                                    'pagination' => $pager,
                                    'prevPageLabel' => '&#8249',
                                    'nextPageLabel' => '&#8250'
                                ]);
                            ?> 
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="result-counter">
                                Showing <span>1-9</span> of <span>11</span> results
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.pagination-holder -->
            </div><!-- /.products-grid #grid-view -->

            <div id="list-view" class="products-grid fade tab-pane ">
                <div class="products-list">
                    <?php foreach($all as $pro_list):?>
                    <div class="product-item product-item-holder">
                        <?php if($pro_list['issale'] == 1):?>
                        <div class="ribbon red"><span>sale</span></div>
                        <?php endif;?>
                        <div class="ribbon blue"><span>new!</span></div>
                        <div class="row">
                            <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                <div class="image">
                                <img alt="" src="<?= $pro_list['cover']?>-covermiddle" />
                                </div>
                            </div><!-- /.image-holder -->
                            <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                <div class="body">
                                <div class="label-discount green">-<?php echo round($pro_list['saleprice'] / $pro_list['price'] * 100, 0);?>% sale</div>
                                    <div class="title">
                                    <a href="single-product.html"><?= $pro_list['title']?></a>
                                    </div>
                                    <div class="brand">sony</div>
                                    <div class="excerpt">
                                    <p><?= $pro_list['descr']?></p>
                                    </div>
                                </div>
                            </div><!-- /.body-holder -->
                            <div class="no-margin col-xs-12 col-sm-3 price-area">
                                <div class="right-clmn">
                                    <?php if($pro_list['issale'] == 1):?>
                                    <div class="price-current">￥<?= $pro_list['price']?></div>
                                    <div class="price-prev">￥<?= $pro_list['saleprice']?></div>
                                    <?php else:?>
                                    <div class="price-current">￥<?= $pro_list['price']?></div>
                                    <?php endif;?>
                                    <div class="availability"><label>存货:</label><span class="available">  现货</span></div>
                                        <a class="le-button" href="<?= yii\helpers\Url::to(['cart/add', 'productid' => $pro_list['pid']]);?>">加入购物车</a>
                                </div>
                            </div><!-- /.price-area -->
                        </div><!-- /.row -->
                    </div><!-- /.product-item -->
                    <?php endforeach;?>
                </div><!-- /.products-list -->

                <div class="pagination-holder">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 text-left">
                            <?php
                                echo yii\widgets\LinkPager::widget([
                                    'pagination' => $pager,
                                    'prevPageLabel' => '&#8249',
                                    'nextPageLabel' => '&#8250'
                                ]);
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="result-counter">
                                Showing <span>1-9</span> of <span>11</span> results
                            </div><!-- /.result-counter -->
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.pagination-holder -->

            </div><!-- /.products-grid #list-view -->

        </div><!-- /.tab-content -->
    </div><!-- /.grid-list-products -->

</section><!-- /#gaming -->
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->
    </div><!-- /.container -->
</section><!-- /#category-grid -->		<!-- ============================================================= FOOTER ============================================================= -->
