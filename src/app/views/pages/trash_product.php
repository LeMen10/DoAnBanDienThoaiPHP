<?php 
    require './app/includes/addOrUpdateQueryParam.php';
    require './app/includes/formatMoney.php';

    $product_model = new ProductModel();
    $all_trash_products = $product_model->getAllTrashProduct();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $trash_products_per_page = $product_model->getTrashProductPerPage($page);
    
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="row g-4">
    <div class="col-12 pt-1">
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Product</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Category</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 0; $i < count($trash_products_per_page); $i++) {
                                $price = $trash_products_per_page[$i]["price"] ? format_money($trash_products_per_page[$i]["price"]) : 0;

                                echo '
                                    <tr class="product-item">
                                        <td class="text-center">'.$trash_products_per_page[$i]["name"].'</td>
                                        <td class="text-center">
                                            <img src="public/img/phone_image/'.$trash_products_per_page[$i]["image"].'" alt="'.$trash_products_per_page[$i]["image"].'" class="image_product">
                                        </td>
                                        <td class="text-center">'.$price.' VNĐ</td>
                                        <td class="text-center">'.$trash_products_per_page[$i]["category"].'</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" onClick="restoreProduct('.$trash_products_per_page[$i]["id"].')">Khôi phục</button>
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
                                    $num_all_rows = count($all_trash_products);
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
</div>