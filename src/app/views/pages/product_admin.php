<?php 
    require './app/includes/formatMoney.php';
    require './app/includes/addOrUpdateQueryParam.php';
?>

<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-success" onclick="handleOpen(null,1)">Add</button>
                    <button type="button" class="btn btn-success ml-10" onclick="checkDeleteProduct()">Delete</button>
                </div>
                <a href="index.php?ctrl=trash_product">
                    <i class="fa-regular fa-trash-can icon-trash"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 pt-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class='tr-title-table'>
                            <th scope="col">
                                <input type="checkbox" name="" class="parent_checkbox" onclick='showAllCheckbox()'>
                            </th><th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Ram/Rom</th>
                            <th scope="col">Color</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class='body_product'>
                        <?php
                            if (isset($products)) {
                                foreach ($products as $product) {
                                    $ram_rom = explode(" ", $product["size"]);
                                    $size = join("/",$ram_rom);

                                    echo "<tr class='product-item'>
                                    <th scope='row'>
                                        <input type='checkbox' name='' class='child_checkbox' dataid='".$product["variantid"]."'>
                                    </th>
                                    <td>".$product["variantid"]."</td>
                                    <td class='td-img-product'>
                                        <img class='img-product' src='public/img/phone_image/".$product["image"]."' alt='' class='image_product'>
                                        
                                    </td>
                                    
                                    <td>".$product["phonename"]."</td>
                                    <td>".$product["category"]."</td>
                                    <td>".format_money($product["price"])." VNĐ</td>
                                    <td>".$size."</td>
                                    <td>".$product["color"]."</td>
                                    <td>".$product["quantity"]."</td>
                                    <td class='td-action'>
                                        <span class='edit-product' onclick='handleOpen(".$product["variantid"].",0)'>
                                            <i class='fa-solid fa-pen-to-square prdmng-icon-edit'></i>
                                        </span>
                                        <span class='delete-product' onclick='deleteProduct(".$product["variantid"].")'>
                                            <i class='fa-regular fa-trash-can prdmng-icon-trash'></i>
                                        </span>
                                        </td>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <div class="paginatoin-area">
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <?php 
                                    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                                    
                                    $productsPerPage = 5;
                                    $num_all_rows = isset($quantity) ? $quantity : 0;
                                    $totalPages = ceil($num_all_rows / $productsPerPage);
                                    
                                    if($page > 1) {
                                        echo '<li><a href="'. addOrUpdateQueryParam($currentUrl, "page", $page - 1) .'" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a></li>';
                                    }
                                    
                                    if($totalPages > 5){
                                        if($page > 20){
                                            for ($i = $totalPages - 5; $i < $totalPages; $i++) {
                                                        echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                                    }
                                        }
                                        else if($page > 3){
                                            for ($i = $page - 2; $i <= $page + 2 && $i<$totalPages; $i++) {
                                                echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                            }
                                        
                                        }else{
                                            for ($i = 1; $i <= 5 && $i<$totalPages; $i++) {
                                                echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                            }
                                        }
                                    }else{
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                        }
                                    }
                                    if($page < $totalPages - 3) {
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
<div class="update-product-overlay">
    <div class="form-edit-product">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(0)"></i>
        <div class="update-wapper">
            <div class="update-left">
                <div class="update-img">
                    <button class="btn-update img" onclick="OpenFileUpdate()">Tải ảnh</button>
                    <input type="file" id="fileInput" onchange="updateFile()" style="display: none;" >
                    <div class='update-img-product' style="height: 84px;">
                        <img id="update_image" alt='' class='image_product' class="size-img-update">                            
                    </div>      
                </div>
                                    
                <label class="lb-title" >Name Phone:</label>
                <input class="iput title" type="text">
                                            
                <label class="lb-category" >Category:</label>
                <select class="iput category">
                </select>
        
                <label class="lb-ramrom" >RAM/ROM:</label>
                <input class="iput ramrom" type="text" >
            
                <label class="lb-color" >Color:</label>
                <input class="iput color" type="text" >
            
                <label class="lb-price" >Price:</label>
                <input class="iput price" type="number">
        
                <label class="lb-quantity" >Quantity:</label>
                <input class="iput quantity" type="number">

                <label class="lb-chip" >Chip:</label>
                <input class="iput chip" type="text" >
            
                <label class="lb-cpu" >CPU:</label>
                <input class="iput cpu" type="text">
                                    
                <label class="lb-bodysize" >Body Size:</label>
                <input class="iput bodysize" type="text">

                <label class="lb-bodyweight" >Body Weight:</label>
                <input class="iput bodyweight" type="text">
                                            
                <label class="lb-screentech" >Screen Tech:</label>
                <input class="iput screentech" type="text">
        
                

            </div>
            <div class="update-right">
                <label class="lb-screensize" >Screen Size:</label>
                <input class="iput screensize" type="text" >

                <label class="lb-screenresolution" >Screen Resolution:</label>
                <input class="iput screenresolution" type="text" >
            
                <label class="lb-screenfeature" >Screen Feature:</label>
                <input class="iput screenfeature" type="text">
        
                <label class="lb-cameraback" >Camera Back:</label>
                <input class="iput cameraback" type="text">

                <label class="lb-camerafront" >Camera Front:</label>
                <input class="iput camerafront" type="text" >
            
                <label class="lb-camerafeature" >Camera Feature:</label>
                <input class="iput camerafeature" type="text">
        
                <label class="lb-videocapture" >Video Capture:</label>
                <input class="iput videocapture" type="text">
                
                <label class="lb-battery" >Battery:</label>
                <input class="iput battery" type="text" >

                <label class="lb-sim" >Sim:</label>
                <input class="iput sim" type="text" >

                <label class="lb-networksupport" >Network Support:</label>
                <input class="iput networksupport" type="text" >

                <label class="lb-wifi" >Wi-Fi:</label>
                <input class="iput wifi" type="text" >

                <label class="lb-os" >OS:</label>
                <input class="iput os" type="text" >

                <label class="lb-misc" >Feature Other:</label>
                <input class="iput misc" type="text" >
            </div>                        
        </div>
    
        
        <button class='btn-update complete' onclick="UpdatePhone()">Complete</button>
       
    </div>
</div>
<div class="add-product-overlay">
    <div class="form-add-product">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(1)"></i>
        <div class="add-wapper">
            <div class="add-left">
                <div class="add-img">
                    <button class="btn-add-img img" onclick="OpenFileUpdate()">Tải ảnh</button>
                    <input type="file" id="fileInput" onchange="updateFile()" style="display: none;" >
                    <div class='update-img-product' style="height: 84px;">
                        <img id="update_image" alt='' class='image_product' class="size-img-update">                            
                    </div>      
                </div>     
                <label class="lb-suplier" >Suplier:</label>
                <select class="iput suplier">
                </select>           
                <label class="lb-title" >Name Phone:</label>
                <input class="iput1 title" type="text">
                                            
                <label class="lb-category" >Category:</label>
                <select class="iput1 category">
                </select>
        
                <label class="lb-ramrom" >RAM/ROM:</label>
                <input class="iput1 ramrom" type="text" >
            
                <label class="lb-color" >Color:</label>
                <input class="iput1 color" type="text" >
                <div class = "priceandquantity">
                    <label class="lb-price" >Price:</label>
                    <input class="iput1 price" type="number">
            
                    <label class="lb-quantity" >Quantity:</label>
                    <input class="iput1 quantity" type="number">
                </div>                
            </div>
        <button class='btn-add complete' onclick="UpdatePhone()">Add Phone</button>
    </div>
</div>
