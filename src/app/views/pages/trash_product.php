<?php 
    require './app/includes/addOrUpdateQueryParam.php';
    require './app/includes/formatMoney.php';



    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $trash_products_per_page = isset($trash_products_per_page) ? $trash_products_per_page : [];
    
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 pt-1 py-2 px-4">
            <div class="h-100 d-flex justify-content-between align-items-center">
                <div>
                    <button id="btnRestoreAll" type="button" class="btn btn-primary">Khôi phục</button>
                </div>
                <div>
                    <input id="searchInput" class="border-0 w-50 mr-30 h-100" name="query" placeholder="Nhập tên điện thoại..." />
                    <button url="<?php echo addOrUpdateQueryParam($currentUrl, "page", 1) ?>" id="btnSubmitSearchInput" class="btn btn-success">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-3">
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <?php 
                            if(count($trash_products_per_page) == 0) {
                                echo "<p class='w-100 h3 font-weight-normal text-center mt-40'>0 có sản phẩm tương ứng</p>";
                            } else {
                                echo '
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="" id="checkAll">
                                    </th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Product</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Ram/Rom</th>
                                    <th scope="col" class="text-center">Color</th>
                                    <th scope="col" class="text-center">Category</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                ';
                            }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 0; $i < count($trash_products_per_page); $i++) {
                                $price = $trash_products_per_page[$i]["price"] ? format_money($trash_products_per_page[$i]["price"]) : 0;

                                echo '
                                    <tr class="product-item">
                                        <th scope="row">
                                            <input variantID="'.$trash_products_per_page[$i]["variantID"].'" type="checkbox" name="" id="checkboxToRestore">
                                        </th>
                                        <td class="text-center">'.$trash_products_per_page[$i]["name"].'</td>
                                        <td class="text-center">
                                            <img src="public/img/phone_image/'.$trash_products_per_page[$i]["image"].'" alt="'.$trash_products_per_page[$i]["image"].'" class="image_product">
                                        </td>
                                        <td class="text-center">'.$price.' VNĐ</td>
                                        <td class="text-center">'.str_replace(' ', '/', $trash_products_per_page[$i]["size"]).'</td>
                                        <td class="text-center">'.$trash_products_per_page[$i]["color"].'</td>
                                        <td class="text-center">'.$trash_products_per_page[$i]["category"].'</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" onClick="restoreProduct('.$trash_products_per_page[$i]["variantID"].')">Khôi phục</button>
                                        </td>
                                    </tr>
                                ';
                            };
                        ?>
                    </tbody>
                </table>
                <div class="paginatoin-area">
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <?php 
                                    $productsPerPage = 5;
                                    $num_all_rows = isset($quantity) ? $quantity : 0;
                                    $totalPages = ceil($num_all_rows / $productsPerPage);
                                    
                                    $startPage = max(1, min($page - 2, $totalPages - 4)); // Tính toán trang bắt đầu
                                    $endPage = min($totalPages, max(1, $page + 2)); // Tính toán trang kết thúc

                                    if($page > 1) {
                                        echo '<li><a href="'. addOrUpdateQueryParam($currentUrl, "page", $page - 1) .'" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a></li>';
                                    }

                                    for ($i = $startPage; $i <= $endPage; $i++) {
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
</div>

