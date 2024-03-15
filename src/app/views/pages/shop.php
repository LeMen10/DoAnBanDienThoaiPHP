<?php
    require './app/includes/addOrUpdateQueryParam.php';
    require './app/includes/formatMoney.php';

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $begin = $page == 1 ? 0 : ($page * 6) - 6;
    
    $productsPerPage = isset($productsPerPage) ? $productsPerPage : "";
    $brand = isset($brand) ? $brand : "";
    $weight = isset($weight) ? $weight : "default";
    $sort = isset($sort) ? $sort : "default";

    $result_all_categories = isset($result_all_categories) ? $result_all_categories : $result_all_categories;
    $count_tu_duoi_170g = isset($count_tu_duoi_170g) ? $count_tu_duoi_170g : 0;
    $count_tu_170g_den_200g = isset($count_tu_170g_den_200g) ? $count_tu_170g_den_200g : 0;
    $count_tu_200g_tro_len = isset($count_tu_200g_tro_len) ? $count_tu_200g_tro_len : 0;

    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="single-banner shop-page-banner">
                    <a id="banner" href="">
                        <img src="public/img/bg-banner/2.jpg" alt="Li's Static Banner">
                    </a>
                    <script>
                        document.getElementById("banner").addEventListener("click", (e) => {
                           e.preventDefault(); 
                        });
                    </script>
                </div>
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                        </div>
                        <div class="toolbar-amount">
                            <span> <?php echo "Showing ",$begin == 0 ? 1 : $begin," to ",($begin + 6) > $num_all_rows ? $num_all_rows : ($begin + 6) ," of ", $num_all_rows  ?></span>
                        </div>
                    </div>
                    <div class="product-select-box">
                        <div class="product-short">
                            <p>Sort By:</p>
                            <select class="nice-select" id="sortDropdown" onchange="changeSortDropDown(event)">
                                <option <?php if($sort == "default") echo "selected" ?>  value="default">Default</option>
                                <option <?php if($sort == "name_asc") echo "selected" ?>  value="name_asc">Name (A - Z)</option>
                                <option <?php if($sort == "name_desc") echo "selected" ?>  value="name_desc">Name (Z - A)</option>
                                <option <?php if($sort == "price_asc") echo "selected" ?>  value="price_asc">Price (Low &gt; High)</option>
                                <option <?php if($sort == "price_desc") echo "selected" ?>  value="price_desc">Price (High &gt; Low)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    <?php  
                                        if (count($result_6_phones) > 0) {
                                            for ($i = 0; $i < count($result_6_phones); $i++) {
                                                echo " <div class='col-lg-4 col-md-4 col-sm-6 mt-40'> ";
                                                echo " <div class='single-product-wrap' onClick='showDetail(".$result_6_phones[$i]["PhoneId"].")'> ";
                                                echo " <div class='product-image'> ";
                                                echo " <a> ";
                                                echo " <img src='public/img/phone_image/".$result_6_phones[$i]["PhoneImage"]."' alt='".$result_6_phones[$i]["PhoneImage"]."'> ";
                                                echo " </a> ";
                                                echo " </div> ";
                                                echo " <div class='product_desc'> ";
                                                echo " <div class='product_desc_info'> ";
                                                echo " <h4><a class='product_name' href='single-product.html'>".$result_6_phones[$i]["PhoneName"]."</a></h4>";
                                                echo " <div class='price-box'> ";
                                                echo " <span class='new-price'>".format_money($result_6_phones[$i]["PhonePrice"])." VNĐ</span> ";
                                                echo " </div> ";
                                                echo " </div> ";
                                                echo " </div> ";
                                                echo " </div> ";
                                                echo " </div> ";
                                            }
                                        } else {
                                            echo "<p class='w-100 h3 font-weight-normal text-center mt-40'>0 có sản phẩm tương ứng</p>";
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    <ul class="pagination-box pt-xs-20 pb-xs-15">
                                        <?php 
                                            $productsPerPage = 6;
                                            $totalPages = ceil($num_all_rows / $productsPerPage);
                                            
                                            if($page > 1) {
                                                echo '<li><a href="'. addOrUpdateQueryParam($currentUrl, "page", $page - 1) .'" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a></li>';
                                            }
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                            }
                                            if($page < $totalPages) {
                                                echo '<li> <a href="'. addOrUpdateQueryParam($currentUrl, "page", $page + 1) .' " class="Next"> Next <i class="fa fa-chevron-right"></i></a> </li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                    <div class="sidebar-title">
                        <h2>Brand</h2>
                    </div>
                    <div class="category-tags">
                        <ul>
                            <?php 
                                for ($i = 0; $i < count($result_all_categories); $i++) {
                                    $updatePageInUrl =  addOrUpdateQueryParam($currentUrl, "page", 1);
                                    echo '<li><a href="'. addOrUpdateQueryParam($updatePageInUrl, "brand", $result_all_categories[$i]['name']) .'">'.$result_all_categories[$i]['name'].'</a></li>';
                                };
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-categores-box">
                    <div class="sidebar-title">
                        <h2>Filter By</h2>
                    </div>
                    <button class="btn-clear-all mb-sm-30 mb-xs-30"><a href="/src/index.php?ctrl=shop" class="black">Clear all</a></button>
                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Categories</h5>
                        <div class="categori-checkbox">
                            <form action="#">
                                <ul>
                                <?php 
                                    for ($i = 0; $i < count($result_all_categories); $i++) {
                                        $updatePage =  addOrUpdateQueryParam($currentUrl, "page", 1);
                                        $isChecked = (strlen(strstr($brand, $result_all_categories[$i]['name']))) ? 'checked' : '';
                                        echo '<li><input url="'. $updatePage .'" ' . $isChecked . ' class="checkbox-categories" type="checkbox" name="' . $result_all_categories[$i]['name'] . '"><a class="a-disabled" href="#">' . $result_all_categories[$i]['name'] . ' (' . $result_all_categories[$i]['count'] . ')</a></li>';
                                    }
                                ?>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                        <h5 class="filter-sub-titel">Weight</h5>
                        <div class="categori-checkbox">
                            <form action="#">
                                <ul>
                                    <?php
                                        $is1Checked = (strlen(strstr($weight, "tu_duoi_170g"))) ? 'checked' : '';
                                        $is2Checked = (strlen(strstr($weight, "tu_170g_den_200g"))) ? 'checked' : '';
                                        $is3Checked = (strlen(strstr($weight, "tu_200g_tro_len"))) ? 'checked' : '';

                                        $updatePage =  addOrUpdateQueryParam($currentUrl, "page", 1);

                                        echo '<li><input url="'. $updatePage .'" ' . $is1Checked . ' class="radio-weight" type="radio" name="tu_duoi_170g"><a class="a-disabled" href="#">dưới 170g (' . $count_tu_duoi_170g . ') </a></li>';
                                        echo '<li><input url="'. $updatePage .'" ' . $is2Checked . ' class="radio-weight" type="radio" name="tu_170g_den_200g"><a class="a-disabled" href="#">170g->200g (' . $count_tu_170g_den_200g . ') </a></li>';
                                        echo '<li><input url="'. $updatePage .'" ' . $is3Checked . ' class="radio-weight" type="radio" name="tu_200g_tro_len"><a class="a-disabled" href="#">trên 200g (' . $count_tu_200g_tro_len . ') </a></li>';
                                    ?>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
