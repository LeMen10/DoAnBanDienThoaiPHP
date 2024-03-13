<?php
    // require_once('/Code/Web/DoAnBanDienThoai/src/app/database/connect.php');
    // require_once('/Code/Web/DoAnBanDienThoai/src/app/models/ProductModel.php');
    
    require_once('/Code/Web/DoAnBanDienThoaiPHP/src/app/includes/addOrUpdateQueryParam.php');
    require_once('/Code/Web/DoAnBanDienThoaiPHP/src/app/includes/formatMoney.php');

    $query_sort_option = [
        "default" => "",
        "name_asc" => "ORDER BY p.name ASC",
        "name_desc" => "ORDER BY p.name DESC",
        "price_asc" => "ORDER BY v.price ASC",
        "price_desc" => "ORDER BY v.price DESC",
    ];
    $query_weight_option = [
        "default" => "",
        "tu_duoi_170g" => "WHERE s.`bodyWeight` <= '170'",
        "tu_170g_den_200g" => "WHERE s.`bodyWeight` BETWEEN '170' AND '200'",
        "tu_200g_tro_len" => "WHERE s.`bodyWeight` >= '200'",
    ];

    // Tạo 6 sp/trang
    $productsPerPage = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $begin = $page == 1 ? 0 : ($page * 6) - 6;
    $sort = isset($_GET['sort']) ? $_GET['sort'] : "default";
    $brand = isset($_GET['brand']) ? $_GET['brand'] : "";
    $weight = isset($_GET['weight']) ? $_GET['weight'] : "default";

    $product_model = new ProductModel();
    $result_6_phones = $product_model->getPhonesByPageNumber($productsPerPage, $page, $query_sort_option[$sort], $brand, $query_weight_option[$weight]);

    if($page != 1 || $sort != "default" || $brand != "" || $weight != "default") {
        // lấy hết để hiển thị, phân trang
        $result_all_phone = $product_model->getAllPhoneAndDetails($brand, $query_weight_option[$weight]);
        $num_all_rows = count($result_all_phone);
    } else {
        // lấy hết để hiển thị, phân trang
        $result_all_phone = $product_model->getAllPhoneAndDetails();
        $num_all_rows = count($result_all_phone);
    }

    $result_all_categories = $product_model->getAllCategoriesAndCountByPhoneID();

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
                                                echo " <div class='single-product-wrap'> ";
                                                echo " <div class='product-image'> ";
                                                echo " <a href=''> ";
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
                                        $updateCategoriesInUrl =  addOrUpdateQueryParam($currentUrl, "page", 1);
                                        $isChecked = (strlen(strstr($brand, $result_all_categories[$i]['name']))) ? 'checked' : '';
                                        echo '<li><input url="'. $updateCategoriesInUrl .'" ' . $isChecked . ' class="checkbox-categories" type="checkbox" name="' . $result_all_categories[$i]['name'] . '"><a class="a-disabled" href="#">' . $result_all_categories[$i]['name'] . ' (' . $result_all_categories[$i]['count'] . ')</a></li>';
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

                                        $count_tu_duoi_170g = count($product_model->getPhoneWeightByWeightAndCountByPhoneID($query_weight_option["tu_duoi_170g"]));
                                        $count_tu_170g_den_200g = count($product_model->getPhoneWeightByWeightAndCountByPhoneID($query_weight_option["tu_170g_den_200g"]));
                                        $count_tu_200g_tro_len = count($product_model->getPhoneWeightByWeightAndCountByPhoneID($query_weight_option["tu_200g_tro_len"]));

                                        echo '<li><input ' . $is1Checked . ' class="radio-weight" type="radio" name="tu_duoi_170g"><a class="a-disabled" href="#">dưới 170g (' . $count_tu_duoi_170g . ') </a></li>';
                                        echo '<li><input ' . $is2Checked . ' class="radio-weight" type="radio" name="tu_170g_den_200g"><a class="a-disabled" href="#">170g->200g (' . $count_tu_170g_den_200g . ') </a></li>';
                                        echo '<li><input ' . $is3Checked . ' class="radio-weight" type="radio" name="tu_200g_tro_len"><a class="a-disabled" href="#">trên 200g (' . $count_tu_200g_tro_len . ') </a></li>';
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

<script>
    // bỏ trạng thái click của thẻ a
    const allALinkCategories = document.querySelectorAll(".a-disabled");
    for (let i = 0;i< allALinkCategories.length; i++) {
        allALinkCategories[i].addEventListener("click" , (e) => {
            e.preventDefault();
        })
    }

    // filter = categories
    const allInputCheckboxCategories = document.querySelectorAll(".checkbox-categories");
    for (let i = 0;i< allInputCheckboxCategories.length; i++) {
        allInputCheckboxCategories[i].addEventListener("change" , (e) => {
            const currentUrl = e.target.getAttribute("url");
            const selectedOption = e.target.getAttribute("name");
            
            // nếu check vào brand đó
            if(e.target.checked) {
                // nếu trên url đã có param brand thì thêm vô
                if(currentUrl.includes("&brand")) {
                    // cắt để lấy ra param filter đó theo dấu &
                    const arrCurUrl = currentUrl.split("&");
                    const newArrCurUrl = arrCurUrl.map((value) => {
                        // lấy cái param brand ra thêm
                        if(value.includes("brand=") && !value.includes(selectedOption)) {
                            // thêm các giá trị brand cần filter vô
                            const newValue = value + "+" + selectedOption;
                            return newValue;
                        }
                        return value;
                    }).join("&");

                    window.location.href = newArrCurUrl;
                } 
                else {
                    // nếu trên url ko có param brand thì thêm
                    window.location.href = currentUrl + "&brand=" + selectedOption;
                }

            } else {
                // nếu uncheck vào brand đó
                if(currentUrl.includes("&brand")) {
                    const arrCurUrl = currentUrl.split("&");
                    const newArrCurUrl = arrCurUrl.map((value) => {
                        // ktra và lấy param ra để xóa
                        if(value.includes("brand=") && value.includes(selectedOption)) {
                            const arrayValueAfterRemoveEqual = value.split("=")[1];

                            // nếu có nhiều value trong param đó thì tìm và xóa cái uncheck
                            if(value.includes("+")) {
                                const arrCurUrlAfterSpliting = arrayValueAfterRemoveEqual.split("+");
                                const removeValue = arrCurUrlAfterSpliting.map(v => v === selectedOption ? "" : v).join("+");
                                // vì khi xóa hoặc thêm value trong param sẽ dư ra 1 dấu + ở cuối.
                                // đổi 2 dấu ++ thành 1, xóa + ở cuối
                                // khi xóa value đầu tiên sẽ xuất hiện =+ ở đầu => xóa dấu +
                                const newValue = removeValue.replace(/\++/g, "+").replace(/\+$/, '').replace(/\=+/g, "=").replace(/^\+/g, "");

                                return "brand=" + newValue;
                            } else {
                                // nếu chỉ có 1 value trong param đó thì xóa luôn param brand
                                return "";
                            }
                            
                        }
                        return value;
                    }).join("&").replace(/\&&/g , "&").replace(/\&$/, '');
                        // vì khi xóa hoặc thêm param trong url sẽ dư ra 1 dấu & ở cuối.
                        // đổi 2 dấu && thành 1, xóa & ở cuối
                    window.location.href = newArrCurUrl;
                } 
            }
        })
    }


    // filter = weight
    const allInputCheckboxWeight = document.querySelectorAll(".radio-weight");
    for (let i = 0;i< allInputCheckboxWeight.length; i++) {
        allInputCheckboxWeight[i].addEventListener("change" , (e) => {
            const currentUrl = window.location.href;
            const selectedOption = e.target.getAttribute("name");
            if(e.target.checked) {
                if(currentUrl.includes("&weight")) {
                    const arrCurUrlAfterSpliting = currentUrl.split("&");
                    const newArrCurUrl = arrCurUrlAfterSpliting.map((value) => {
                        if(value.includes("weight=")) {
                            const newValue = "weight=" + selectedOption;
                            return newValue;
                        }
                        return value;
                    }).join("&");

                    window.location.href = newArrCurUrl;
                } 
                else {
                    window.location.href = currentUrl + "&weight=" + selectedOption;
                }
            }
        });
    };
</script>