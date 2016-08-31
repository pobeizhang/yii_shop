<?php use yii\bootstrap\ActiveForm;?>
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="single-product">
    <div class="container">

         <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            <div class="single-product-gallery-item" id="slide1">
            <a data-rel="prettyphoto" href="<?= $product['cover']?>-picbig">
                <img class="img-responsive" alt="" src="<?= $product['cover']?>-picbig"/>
                </a>
            </div><!-- /.single-product-gallery-item -->
            <?php $i = 2;?>
            <?php foreach((array)json_decode($product['pics'], true) as $k => $pic):?>
            <div class="single-product-gallery-item" id="slide<?= $i;?>">
            <a data-rel="prettyphoto" href="<?= $pic?>">
            <img class="img-responsive" alt="" src="<?= $pic?>" />
                </a>
            </div><!-- /.single-product-gallery-item -->
            <?php $i++;?>
            <?php endforeach;?>
            
        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                <?php $i = 1;?>
                <?php foreach((array)json_decode($product['pics']) as $k => $pic):?>
                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="<?= $i - 1;?>" href="#slide<?= $i;?>">
                    <img width="67" alt="" src="<?= $pic?>" />
                </a>
                <?php $i++;?>
                <?php endforeach;?>
                
            </div><!-- /#owl-single-product-thumbnails -->

            <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div><!-- /.nav-holder -->

            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div><!-- /.nav-holder -->

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->
        <div class="no-margin col-xs-12 col-sm-7 body-holder">
    <div class="body">
    <div class="title"><a href="#"><?= $product['title']?></a></div>
        <div class="brand"></div>

        <div class="excerpt">
        <p><?= $product['descr']?></p>
        </div>

        <div class="prices">
            <?php if($product['issale'] == 1):?>
            <div class="price-current">$<?= $product['saleprice']?></div>
            <div class="price-prev">$<?= $product['price']?></div>
            <?php else:?>
            <div class="price-current">$<?= $product['saleprice']?></div>
            <?php endif;?>
        </div>

        <div class="qnt-holder">
            <?php $form =  ActiveForm::begin([
                'action' => yii\helpers\Url::to(['cart/add'])
            ]);?>
            <div class="le-quantity">
                    <a class="minus" href="#reduce"></a>
                    <input name="quantity" readonly="readonly" type="text" value="1" />
                    <a class="plus" href="#add"></a>
            </div>
            <a id="addto-cart" href="cart.html" class="le-button huge">加入购物车</a>
            <?php ActiveForm::end();?>
        </div><!-- /.qnt-holder -->
    </div><!-- /.body -->

</div><!-- /.body-holder -->
    </div><!-- /.container -->
</div><!-- /.single-product -->

<!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
<section id="single-product-tab">
    <div class="container">
        <div class="tab-holder">

            <ul class="nav nav-tabs simple" >
                <li class="active"><a href="#description" data-toggle="tab">商品详情</a></li>
            </ul><!-- /.nav-tabs -->

            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <p><?= $product['descr']?></p>

                </div><!-- /.tab-pane #description -->
            </div><!-- /.tab-content -->

        </div><!-- /.tab-holder -->
    </div><!-- /.container -->
</section><!-- /#single-product-tab -->
<!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
	<div class="container">
		<div class="carousel-holder hover">

			<div class="title-nav">
				<h2 class="h1">最近浏览</h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div><!-- /.title-nav -->

			<div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
				<div class="no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
						<div class="ribbon red"><span>sale</span></div>
						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-11.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">LC-70UD1U 70" class aquos 4K ultra HD</a>
							</div>
							<div class="brand">Sharp</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class="no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
						<div class="ribbon blue"><span>new!</span></div>
						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-12.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">cinemizer OLED 3D virtual reality TV Video</a>
							</div>
							<div class="brand">zeiss</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">

						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-13.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">s2340T23" full HD multi-Touch Monitor</a>
							</div>
							<div class="brand">dell</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
						<div class="ribbon blue"><span>new!</span></div>
						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-14.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">kardon BDS 7772/120 integrated 3D</a>
							</div>
							<div class="brand">harman</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
						<div class="ribbon green"><span>bestseller</span></div>
						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-15.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">netbook acer travel B113-E-10072</a>
							</div>
							<div class="brand">acer</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">

						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-16.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">iPod touch 5th generation,64GB, blue</a>
							</div>
							<div class="brand">apple</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">

						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-13.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">s2340T23" full HD multi-Touch Monitor</a>
							</div>
							<div class="brand">dell</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->

				<div class=" no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
						<div class="ribbon blue"><span>new!</span></div>
						<div class="image">
							<img alt="" src="assets/home/images/blank.gif" data-echo="assets/home/images/products/product-14.jpg" />
						</div>
						<div class="body">
							<div class="title">
								<a href="single-product.html">kardon BDS 7772/120 integrated 3D</a>
							</div>
							<div class="brand">harman</div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$1199.00</div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->
			</div><!-- /#recently-carousel -->

		</div><!-- /.carousel-holder -->
	</div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->
