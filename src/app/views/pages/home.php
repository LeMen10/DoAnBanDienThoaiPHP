<?php
    require './app/includes/formatMoney.php';
?>
<div class="home-wrap mb-60">
    <div class="slider-with-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="slider-area">
                        <div class="slider-active">
                            <div class="single-slide align-center-left animation-style-01 ">
                                <img src="public/img/slider/1.jpg" class="bg-1" alt="">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                    <h2>Chamcham Galaxy S9 | S9+</h2>
                                    <h3>Starting at <span>$1209.00</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="li-banner">
                        <a href="#">
                            <img src="public/img/banner/1_1.jpg" alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                        <a href="#">
                            <img src="public/img/banner/1_2.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="/src/index.php?ctrl=shop"><span>All Product</span></a></li>
                            <!-- <li><a data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li> -->
                            <!-- <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <?php  
                            if (count($products) > 0) {
                                for ($i = 0; $i < count($products); $i++) {
                                    echo " <div class='col-lg-3 col-md-4 col-sm-6 mt-40'> ";
                                    echo " <div class='single-product-wrap' onClick='showDetail(".$products[$i]["PhoneId"].")'> ";
                                    echo " <div class='product-image'> ";
                                    echo " <a> ";
                                    echo " <img src='public/img/phone_image/".$products[$i]["PhoneImage"]."' alt='".$products[$i]["PhoneImage"]."'> ";
                                    echo " </a> ";
                                    echo " </div> ";
                                    echo " <div class='product_desc'> ";
                                    echo " <div class='product_desc_info'> ";
                                    echo " <h4><span class='product_name' href='single-product.html'>".$products[$i]["PhoneName"]."</span></h4>";
                                    echo " <div class='price-box'> ";
                                    echo " <span class='new-price'>".format_money($products[$i]["PhonePrice"])." VNĐ</span> ";
                                    echo " </div> ";
                                    echo " </div> ";
                                    echo " </div> ";
                                    echo " </div> ";
                                    echo " </div> ";
                                }
                            } else {
                                echo "<p class='w-100 h3 font-weight-normal text-center mt-40'>Hiện tại shop chưa có sản phẩm !</p>";
                            }
                        ?>
                    </div>
                    <div class="d-flex justify-content-center"><a href="index.php?ctrl=shop" class='btn btn-primary h4 font-weight-normal text-center mt-40'>Xem thêm</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="li-static-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="single-banner">
                        <a href="#">
                            <img src="public/img/banner/1_3.jpg" alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="single-banner">
                        <a href="#">
                            <img src="public/img/banner/1_4.jpg" alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="single-banner">
                        <a href="#">
                            <img src="public/img/banner/1_5.jpg" alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- pt-60 pb-45 -->
    <section class="product-area li-laptop-product pt-25 pb-25">
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Laptop</span>
                        </h2>
                        <ul class="li-sub-category-list">
                            <li class="active"><a href="shop-left-sidebar.html">Prime Video</a></li>
                            <li><a href="shop-left-sidebar.html">Computers</a></li>
                            <li><a href="shop-left-sidebar.html">Electronics</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="public/img/product/10.jpg" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Graphic Corner</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a>
                                        </h4>
                                        <div class="price-box">
                                            <span class="new-price">$46.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

    <div class="li-static-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="li-static-home-image" src="public/img/bg-banner/1.jpg" alt="">
                    <div class="li-static-home-content">
                        <p>Sale Offer<span>-20% Off</span>This Week</p>
                        <h2>Featured Product</h2>
                        <h2>Meito Accessories 2018</h2>
                        <p class="schedule">
                            Starting at
                            <span> $1209.00</span>
                        </p>
                        <div class="default-btn">
                            <a href="" class="links">Shopping Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

