<header>
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="">
                            <img src="public/img/logo/logo-1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <form action="#" class="hm-searchbox">
                        <input type="text" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <li class="hm-minicart">
                                <a href="index.php?ctrl=cart" class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">£80.00
                                        <span class="cart-item-count">2</span>
                                    </span>
                                </a>
                            </li>
                            <li class="hm-wishlist">
                            <!-- <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown link
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            </div> -->
                            <?php
                                if(isset($user)){
                                    print_r($user);
                                    var_dump($user);
                                    echo $user;
                                    // echo "<a href='index.php?ctrl=login'>
                                    //         <i class='fa-regular fa-user'></i>
                                    //     </a>";
                                    
                                        
                                    
                                }
                                else {
                                    echo "<a href='index.php?ctrl=login'>
                                                <i id='avatar' class=''></i>
                                            </a>";
                                        echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='#'>Action</a>
                                                <a class='dropdown-item' href='#'>Another action</a>
                                                <a class='dropdown-item' href='#'>Something else here</a>
                                            </div>";
                                    
                                }

                            ?>
                            </li>
            </div>
        </div>
    </div>
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hb-menu">
                        <nav>
                            <ul class="header-menu-wrap">
                                <li class="dropdown-holder">
                                    <a href="index.php?">Home</a>
                                </li>
                                <li class="megamenu-holder">
                                    <a href="index.php?ctrl=shop">Shop</a>
                                </li>
                                <li>
                                    <a href="index.php?ctrl=about">About Us</a>
                                </li>
                                <li>
                                    <a href="index.php?ctrl=contact">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
</header>