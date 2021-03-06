<!DOCTYPE html>
<html lang="zh-cn" xmlns:wb="http://open.weibo.com/wb">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="杜磊的个人用于测试实验的商城">
		<meta name="author" content="杜磊">
	    <meta name="keywords" content="du_shop,杜磊,杜磊的个人商城,shop,shopping">
	    <meta name="robots" content="all">
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=764346969" type="text/javascript" charset="utf-8"></script>
	    <title>du_shop</title>
        <meta property="wb:webmaster" content="50f6a0dbb1f9f077" />
	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/home/css/bootstrap.min.css">

	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/home/css/main.css">
	    <link rel="stylesheet" href="assets/home/css/red.css">
	    <link rel="stylesheet" href="assets/home/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/home/css/owl.transitions.css">
		<link rel="stylesheet" href="assets/home/css/animate.min.css">


		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/home/css/font-awesome.min.css">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/home/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/home/js/html5shiv.js"></script>
			<script src="assets/home/js/respond.min.js"></script>
		<![endif]-->

	</head>
<body>

	<div class="wrapper">
		<!-- ============================================================= TOP NAVIGATION ============================================================= -->
<nav class="top-bar animate-dropdown">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
                <li><a href="index.html">首页</a></li>
                <li><a href="category-grid.html">所有分类</a></li>
                <li><a href="<?= yii\helpers\Url::to(['cart/index']);?>">我的购物车</a></li>
                <li><a href="<?= yii\helpers\Url::to(['order/index']);?>">我的订单</a></li>
            </ul>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
            	<?php if(\Yii::$app->session['home']['isLogin'] == 1):?>
                    <?php if(\Yii::$app->session['home']['mark'] == 'qqlogin'): ?>
                    你好，欢迎回来<?php echo \Yii::$app->session['home']['qqloginname'];?>
                    <?php else:?>
                    你好，欢迎回来<?php echo \Yii::$app->session['home']['homename']; ?>
                    <?php endif;?>
            	<?php else:?>
                <li><a href="<?php echo yii\helpers\Url::to(['member/auth']);?>">注册</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['member/auth']);?>">登录</a></li>
                <?php endif;?>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
<!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
<header>
	<div class="container no-padding">

		<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
			<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="index.html">
		<img alt="logo" src="assets/home/images/logo.png" width="233" height="54"/>
	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

		<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
			<div class="contact-row">
    <!--<div class="phone inline">
        <i class="fa fa-phone"></i> (+086) 123 456 7890
    </div>
    <div class="contact inline">
        <i class="fa fa-envelope"></i> contact@<span class="le-color">jason.com</span>
    </div>-->
</div><!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form>
        <div class="control-group">
            <input class="search-field" placeholder="搜索商品" />

            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="category-grid.html">所有分类</a>

                    <ul class="dropdown-menu" role="menu" >
                        <?php foreach($this->params['menu'] as $top):?>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?= $top['title']?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            </ul>

            <a style="padding:15px 15px 13px 12px" class="search-button" href="#" ></a>

        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

		<div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
			<div class="top-cart-row-container">

    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
    <div class="top-cart-holder dropdown animate-dropdown">

        <div class="basket">

            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                    <span class="count"><?= $this->params['productnum']?></span>
                    <img src="assets/home/images/icon-cart.png" alt="" />
                </div>

                <div class="total-price-basket">
                    <span class="lbl">您的购物车:</span>
                    <span class="total-price">
                        <span class="sign">￥</span><span class="value"><?= $this->params['total']?></span>
                    </span>
                </div>
            </a>

            <ul class="dropdown-menu">
                <?php foreach($this->params['carts']['products'] as $cart):?>
                <li>
                    <div class="basket-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin text-center">
                                <div class="thumb">
                                    <img alt="" src="<?= $cart['cover']?>-coversmall" />
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <div class="title"><?= $cart['title'];?></div>
                                <div class="price">￥<?= $cart['price']?></div>
                            </div>
                        </div>
                        <a class="close-btn" href="<?= yii\helpers\Url::to(['cart/del', 'cartid' => $cart['cartid']]);?>"></a>
                    </div>
                </li>
                <?php endforeach;?>
                <li class="checkout">
                    <div class="basket-item">
                        <div class="row">
                            <!--<div class="col-xs-12 col-sm-6">
                                <a href="cart.html" class="le-button inverse">查看购物车</a>
                            </div>-->
                            <div class="col-xs-12 col-sm-6" style = "float:right;">
                                <a href="<?= yii\helpers\Url::to(['cart/index']);?>" class="le-button">查看购物车</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div><!-- /.basket -->
    </div><!-- /.top-cart-holder -->
</div><!-- /.top-cart-row-container -->
<!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

	</div><!-- /.container -->

	<!-- ========================================= NAVIGATION ========================================= -->
<nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
    <div class="container">
        <div class="yamm navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.navbar-header -->
            <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                <ul class="nav navbar-nav">
                    <?php foreach($this->params['menu'] as $v):?>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?= $v['title']?></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-12 col-xs-12 col-sm-12">
                                            <ul>
                                                <?php foreach($v['child'] as $vv):?>
                                                <li><a href="#"><?= $vv['title']?></a></li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div><!-- /.col --> 
                                    </div><!-- /.row -->
                                </div><!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    <?php endforeach;?>
                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.navbar -->
    </div><!-- /.container -->
</nav><!-- /.megamenu-vertical -->
<!-- ========================================= NAVIGATION : END ========================================= -->
</header>




<?php echo $content; ?>



<footer id="footer" class="color-bg">

    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
<div class="widget">
    <h2>推荐商品</h2>
    <div class="body">
        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">Netbook Acer Travel B113-E-10072</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-01.jpg" />
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-02.jpg" />
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-03.jpg" />
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- /.body -->
</div> <!-- /.widget -->
<!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
<div class="widget">
    <h2>促销商品</h2>
    <div class="body">
        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">HP Scanner 2910P</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-04.jpg" />
                        </a>
                    </div>
                </div>

            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">Galaxy Tab 3 GT-P5210 16GB, Wi-Fi, 10.1in - White</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-05.jpg" />
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-06.jpg" />
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- /.body -->
</div> <!-- /.widget -->
<!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
<div class="widget">
    <h2>最热商品</h2>
    <div class="body">
        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">Galaxy Tab GT-P5210, 10" 16GB Wi-Fi</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-07.jpg" />
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-08.jpg" />
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 no-margin">
                        <a href="single-product.html">Surface RT 64GB, Wi-Fi, 10.6in - Dark Titanium</a>
                        <div class="price">
                            <div class="price-prev">￥2000</div>
                            <div class="price-current">￥1873</div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <a href="#" class="thumb-holder">
                            <img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-small-09.jpg" />
                        </a>
                    </div>

                </div>
            </li>
        </ul>
    </div><!-- /.body -->
</div><!-- /.widget -->
<!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

        </div><!-- /.widgets-row-->
    </div><!-- /.container -->

    <div class="sub-form-row">
        <!--<div class="container">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                <form role="form">
                    <input placeholder="Subscribe to our newsletter">
                    <button class="le-button">Subscribe</button>
                </form>
            </div>
        </div>--><!-- /.container -->
    </div><!-- /.sub-form-row -->

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
    <div class="footer-logo">
		<img alt="logo" src="assets/home/images/logo.png" width="233" height="54"/>
    </div><!-- /.footer-logo -->

    <p class="regular-bold"> 请通过电话，电子邮件随时联系我</p>

    <p>
        北京市朝阳区十八里店南桥
    </p>

    <!--<div class="social-icons">
        <h3>Get in touch</h3>
        <ul>
            <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-pinterest"></a></li>
            <li><a href="#" class="fa fa-linkedin"></a></li>
            <li><a href="#" class="fa fa-stumbleupon"></a></li>
            <li><a href="#" class="fa fa-dribbble"></a></li>
            <li><a href="#" class="fa fa-vk"></a></li>
        </ul>
    </div>--><!-- /.social-icons -->

</div>
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
<div class="link-widget">
    <div class="widget">
        <h3>快速检索</h3>
        <ul>
            <li><a href="category-grid.html">laptops &amp; computers</a></li>
            <li><a href="category-grid.html">Cameras &amp; Photography</a></li>
            <li><a href="category-grid.html">Smart Phones &amp; Tablets</a></li>
            <li><a href="category-grid.html">Video Games &amp; Consoles</a></li>
            <li><a href="category-grid.html">TV &amp; Audio</a></li>
            <li><a href="category-grid.html">Gadgets</a></li>
            <li><a href="category-grid.html">Car Electronic &amp; GPS</a></li>
            <li><a href="category-grid.html">Accesories</a></li>
        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>热门商品</h3>
        <ul>
            <li><a href="category-grid.html">Find a Store</a></li>
            <li><a href="category-grid.html">About Us</a></li>
            <li><a href="category-grid.html">Contact Us</a></li>
            <li><a href="category-grid.html">Weekly Deals</a></li>
            <li><a href="category-grid.html">Gift Cards</a></li>
            <li><a href="category-grid.html">Recycling Program</a></li>
            <li><a href="category-grid.html">Community</a></li>
            <li><a href="category-grid.html">Careers</a></li>

        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>最近浏览</h3>
        <ul>
            <li><a href="category-grid.html">My Account</a></li>
            <li><a href="category-grid.html">Order Tracking</a></li>
            <li><a href="category-grid.html">Wish List</a></li>
            <li><a href="category-grid.html">Customer Service</a></li>
            <li><a href="category-grid.html">Returns / Exchange</a></li>
            <li><a href="category-grid.html">FAQs</a></li>
            <li><a href="category-grid.html">Product Support</a></li>
            <li><a href="category-grid.html">Extended Service Plans</a></li>
        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->
<!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    &copy; <a href="index.html">shop.dlzhangyy.com</a> - all rights reserved
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="assets/home/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="assets/home/images/payments/payment-master.png"></li>
                        <li><img alt="" src="assets/home/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="assets/home/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="assets/home/js/jquery-1.10.2.min.js"></script>
	<script src="assets/home/js/jquery-migrate-1.2.1.js"></script>
	<script src="assets/home/js/bootstrap.min.js"></script>
	<script src="assets/home/js/gmap3.min.js"></script>
	<script src="assets/home/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/home/js/owl.carousel.min.js"></script>
	<script src="assets/home/js/css_browser_selector.min.js"></script>
	<script src="assets/home/js/echo.min.js"></script>
	<script src="assets/home/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/home/js/bootstrap-slider.min.js"></script>
    <script src="assets/home/js/jquery.raty.min.js"></script>
    <script src="assets/home/js/jquery.prettyPhoto.min.js"></script>
    <script src="assets/home/js/jquery.customSelect.min.js"></script>
    <script src="assets/home/js/wow.min.js"></script>
	<script src="assets/home/js/scripts.js"></script>
	<script type="text/javascript">
		$('#createlink').click(function(){
			$('.billing-address').slideDown();
        });
        $("li.disabled").hide();
        $(".expressshow").hide();
        $(".express").hover(function(){
            var a = $(this);
            if($(this).attr("data") != "ok") {
                console.log($(this).attr('data'));
                $.get('<?= yii\helpers\Url::to(['order/getexpress']);?>', {'expressno': $(this).attr('data')}, function(res){
                    var str = "";
                    if(res.message == 'ok') {
                        for(var i = 0; i < res.data.length; i++) {
                            str += "<p>" + res.data[i].context + " " + res.data[i].time + " </p>";
                        }
                        a.find(".expressshow").html(str);
                        a.attr('data', 'ok');
                    }
                }, 'json');
            }
            $(this).find('.expressshow').show();
        }, function(){
            $(this).find('.expressshow').hide();
        });
	</script>
</body>
</html>
