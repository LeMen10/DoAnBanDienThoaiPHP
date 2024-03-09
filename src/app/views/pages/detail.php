<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li class="active">
                    <?php echo ucfirst($data['page']); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
<<<<<<< Updated upstream
                    <?php
                        $centerSlider = "";
                        $bottomSlider = "";
                        if (isset($Images)) {
                            foreach ($Images as $image) {
                                $centerSlider.= "<div class='lg-image'>
                                <img src='public/img/phone_image/".$image["image"]."' alt='product image'> </div>";
                                $bottomSlider .= "<div class='sm-image'><img src='public/img/phone_image/".$image["image"]."' alt='product image thumb'>
                                </div>";
                            }
                        }
                        echo $centerSlider;
                        echo " <div class='slider-controls'>
                        <button id='prevBtn'>Prev</button>
                        <button id='nextBtn'>Next</button></div>";
                        echo "<div class='product-details-thumbs slider-thumbs-1'>".$bottomSlider."
                        </div>"
                        ?>
                      </div> 
=======
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/1.jpg"
                                data-gall="myGallery">
                                <img src="public/img/phone_image/IPhone14_1_1.jpg" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/2.jpg"
                                data-gall="myGallery">
                                <img src="public/img/phone_image/IPhone14_1_1.jpg" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/3.jpg"
                                data-gall="myGallery">
                                <img src="public/img/phone_image/IPhone14_1_1.jpg" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/4.jpg"
                                data-gall="myGallery">
                                <img src="images/product/large-size/4.jpg" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/5.jpg"
                                data-gall="myGallery">
                                <img src="images/product/large-size/5.jpg" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/6.jpg"
                                data-gall="myGallery">
                                <img src="images/product/large-size/6.jpg" alt="product image">
                            </a>
                        </div>
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                        <div class="sm-image"><img src="images/product/small-size/1.jpg" alt="product image thumb">
                        </div>
                        <div class="sm-image"><img src="images/product/small-size/2.jpg" alt="product image thumb">
                        </div>
                        <div class="sm-image"><img src="images/product/small-size/3.jpg" alt="product image thumb">
                        </div>
                        <div class="sm-image"><img src="images/product/small-size/4.jpg" alt="product image thumb">
                        </div>
                        <div class="sm-image"><img src="images/product/small-size/5.jpg" alt="product image thumb">
                        </div>
                        <div class="sm-image"><img src="images/product/small-size/6.jpg" alt="product image thumb">
                        </div>
                    </div>
>>>>>>> Stashed changes
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <?php
                        if (isset($productDetail) && isset($Variants)) {
                            $colorOption = "";
                            $sizeOption = "";
                            if(isset($Variants))
                            {
                                foreach ($Variants as $option) {
                                    $sizeOption.= "<option value='".$option['sizeID']."'>".$option['size']."</option>";
                                }
                            }
                            if(isset($Colors))
                            {
                                foreach ($Colors as $option) {
                                    $colorOption.="<option value='".$option['colorID']."'>".$option['color']."</option>";
                                }
                            }
                            echo "<h2>".$productDetail["phonename"]."</h2>
                            <span class='product-details-ref' id='category-name'>Category: ".$productDetail["categoryname"]."</span>
                            <span class='product-details-ref' id='quantity-value'>Quantity: ".$Variants[0]["quantity"]."</span>
                            <div class='rating-box pt-20'>
                                <ul class='rating rating-with-review-item'>
                                    <li><i class='fa fa-star-o'></i></li>
                                    <li><i class='fa fa-star-o'></i></li>
                                    <li><i class='fa fa-star-o'></i></li>
                                    <li class='no-star'><i class='fa fa-star-o'></i></li>
                                    <li class='no-star'><i class='fa fa-star-o'></i></li>
                                    <li class='review-item'><a href='#'>Read Review</a></li>
                                    <li class='review-item'><a href='#'>Write Review</a></li>
                                </ul>
                            </div>
                            <div class='price-box pt-20'>
                                
                                <span class='new-price new-price-2'  id='price-value'><span>đ</span>".$Variants[0]["price"]."</span>
                            </div>
                            <div class='product-desc' data-id = '".$productDetail["phoneID"]."'>
                                <p>
                                    Chip: ".$productDetail["chipset"]."
                                </p>
                                <p>
                                    CPU: ".$productDetail["cpuType"]."
                                </p>
                                <p>
                                    Body size: ".$productDetail["bodySize"]."
                                </p>
                                <p>
                                    Body weight: ".$productDetail["bodyWeight"]."
                                </p>
                                <p>
                                    Screen feature: ".$productDetail["screenFeature"]."
                                </p>
                                <p>
                                    Screen resolution: ".$productDetail["screenResolution"]."
                                </p>
                                <p>
                                    Os: ".$productDetail["os"]."
                                </p>
                                <p>
                                    Video capture: ".$productDetail["videoCapture"]."
                                </p>
                                <p>
                                    Camera front: ".$productDetail["cameraFront"]."
                                </p>
                                <p>
                                    Camera back: ".$productDetail["cameraBack"]."
                                </p>
                                <p>
                                    Camera feature: ".$productDetail["cameraFeature"]."
                                </p>
                                <p>
                                    Battery: ".$productDetail["battery"]."
                                </p>
                                <p>
                                    Sim: ".$productDetail["sim"]."
                                </p>
                                <p>
                                    Network support: ".$productDetail["networkSupport"]."
                                </p>
                                <p>
                                    Wifi: ".$productDetail["wifi"]."
                                </p>
                                <p>
                                    Misc: ".$productDetail["misc"]."
                                </p>
                                <span id='moreInfoBtn'>Xem thêm</span>
                            </div>
                            
                        <div class='product-variants'>
                        <div class='produt-variants-size'>
                            <label>Size</label>
                            <select class='nice-select' id='sizeSelect'>".$sizeOption."</select>
                        </div>
                        <div class='produt-variants-color'>
                            <label>Color</label>
                            <select class='nice-select' id='colorSelect'>".$colorOption."</select>
                        </div>
                    </div>
                    <div class='single-add-to-cart'>
                        <form action='#' class='cart-quantity'>
                            <div class='quantity'>
                                <label>Quantity</label>
                                <div class='cart-plus-minus'>
                                    <input class='cart-plus-minus-box' value='1' type='text'>
                                    <div class='dec qtybutton'><i class='fa fa-angle-down'></i></div>
                                    <div class='inc qtybutton'><i class='fa fa-angle-up'></i></div>
                                </div>
                            </div>
                            <button class='add-to-cart' type='submit'>Add to cart</button>
                        </form>
                    </div>";
                        }
                        ?>
                        
                        <div class="product-additional-info pt-25">
                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to
                                wishlist</a>
                            <div class="product-social-sharing pt-25">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a>
                                    </li>
                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Security policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Delivery policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p> Return policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>