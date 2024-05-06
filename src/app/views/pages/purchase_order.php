
<div class="container" id="purchase-order-list">
    <?php
        //Thiết lập phân trang
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($currentUrl, '&page') !== false) {
            $currentUrl = strstr($currentUrl, '&page', true);
        }

        //Hiện chi tiết đơn hàng
        if(isset($orderDetail) && isset($customerInfo) && isset($listProduct))
        {
            echo "<div class='detail-purchase-order'> <div class='title-order'><span onclick='returnHandle(event)'><i class='fa-solid fa-arrow-left'></i></span>";
            echo "<h1>ORDER ID: ".$orderDetail["id"]."</h1>";
            echo "<h2>".$orderDetail["orderStatus"]."</h2>";
            echo "</div><div class='purchase-order-content'><div class='purchase-order-info'><div class='status-order-map'>";
            $Status = $orderDetail["orderStatus"];
            if($Status == "Canceled")
            {
                echo "<div class='item-map'>";
                echo "<div class='circle red-active'></div>";
                echo "<div class='status-label'>Order Placed</div>";
                echo "<div class='line-map red-active'></div></div>";
                echo "<div class='item-map'>";
                echo "<div class='circle red-active'></div>";
                echo "<div class='status-label'>Canceled</div></div>";
            }
            else 
            {
                $statusID = 0;
                if($Status == "Delivering") $statusID = 1;
                if($Status == "Completed") $statusID = 2;
                echo "<div class='item-map'>";
                echo "<div class='circle active'></div>";
                echo "<div class='status-label'>Order Placed</div>";
                echo "<div class='line-map active'></div></div>";
                echo "<div class='item-map'>";
                echo "<div class='circle active'></div>";
                echo "<div class='status-label'>Processed</div>";
                echo "<div class='line-map ".($statusID == 0? "":" active")."'></div></div>";
                echo "<div class='item-map'>";
                echo "<div class='circle".($statusID == 0? "":" active")."'></div>";
                echo "<div class='status-label'>Delivering</div>";
                echo "<div class='line-map".($statusID == 1 || $statusID == 0? "":" active")."'></div></div>";
                echo "<div class='item-map'>";
                echo "<div class='circle".($statusID == 2? " active":"")."'></div>";
                echo "<div class='status-label'>Completed</div></div>";
            }
            echo "</div><div class='payment-and-date'>";
            $address = $customerInfo["detail"].", ".$customerInfo["Wards"].", ".$customerInfo["District"].", ".$customerInfo["Province"];
            echo "<div class= 'Info-container'>";
            echo "<div class='addressInfo'>";
            echo "<p>Receiver: ".$customerInfo["recipientName"]."</p>";
            echo "<p>Address: ".$address."</p>";
            echo "<p>Phone: ".$customerInfo["recipientPhone"]."</p></div>";
            echo "<div class='paymentInfo'>";
            echo "<p>Total payment: <span>đ</span>".$orderDetail["totalPayment"]."</p>";
            echo "<p>Order date: ".$orderDetail["date"]."</p></div></div>";
            echo "<div class='product-list'><h4>Product</h4>";
            foreach ($listProduct as $Product) 
            {
                echo "<ul class='product-list'><li class='product-info'> ";
                echo "<img src='public/img/phone_image/".$Product["image"]."' alt='' class='image_product'>";
                echo "<div class='detail-info'><div class='product-name'>".$Product["name"]."</div>";
                echo "<div class='product-size'>Size: ".$Product["size"]."</div>";
                echo "<div class='color-product'>Color: ".$Product["color"]."</div><div class='price-content'>";
                echo "<div class='quantity-product'>x".$Product["quantity"]."</div>";
                echo "<div class='price-product'>".$Product["price"]."</div>";                    
                echo "</div></di></iv></li></ul>";
            }
            echo "</div>";
            echo "<div class='purchase-order-note'><div class='note-info'> <h4>Note</h4>";
            echo "<p>You are only allowed to cancel an order while the order is being processed.</p></div>";
            if($orderDetail['orderStatus'] == 'Completed')
            {
                echo "<button onclick='openBuyAgainForm(".$orderDetail["id"].")'>Buy again</button>";
            }
            echo "</div></div></div></div></div>";
        }
        //Hiện danh sách đơn hàng
        else if(isset($listOrder) && isset($listOrderPerPage))
        {
            echo "<ul class='status-purchase-order'>";
            echo "<li class='status-li' id='status-All' onClick='handleChangeStatusList(\"All\")'>All</li>";
            echo "<li class='status-li' id='status-Processing' onClick='handleChangeStatusList(\"Processing\")'>Processing</li>";
            echo "<li class='status-li' id='status-Delivering' onClick='handleChangeStatusList(\"Delivering\")'>Wait delivering</li>";
            echo "<li class='status-li' id='status-Completed' onClick='handleChangeStatusList(\"Completed\")'>Completed</li>";
            echo "<li class='status-li' id='status-Canceled' onClick='handleChangeStatusList(\"Canceled\")'>Canceled</li></ul>";
            echo "<div class='search-purchase-order'><button class='search-order-button' type='submit'><i class='fa fa-search'></i></button>";
            echo "<input type='text' placeholder='Search phone name, id ...' id='search-purchase'>";
            echo "</div><div class='purchase-order-container'></div>";
            echo "<div class='purchase-order-container'>";
            if(count($listOrder) == 0)
            {
                echo "<div class='empty-list-order'>These are no purchases</div>";
            }
            foreach ($listOrderPerPage as $Order) {
                echo " <div class='purchase-order-list'><div class='purchase-order-item'>";
                echo "<div class='order-info'><div class='order-id'>".$Order["id"]."</div>";
                echo "<div class='order-status'>".$Order["orderStatus"]."</div></div>";
                echo "<div class='partition-line'></div>";
                foreach ($Order["listProduct"] as $Product) 
                {
                    echo "<ul class='product-list' onClick='handleOnClickItemOrderList(".$Order["id"].")'><li class='product-info'> ";
                    echo "<img src='public/img/phone_image/".$Product["image"]."' alt='' class='image_product'>";
                    echo "<div class='detail-info'><div class='product-name'>".$Product["name"]."</div>";
                    echo "<div class='product-size'>Size: ".$Product["size"]."</div>";
                    echo "<div class='color-product'>Color: ".$Product["color"]."</div><div class='price-content'>";
                    echo "<div class='quantity-product'>x".$Product["quantity"]."</div>";
                    echo "<div class='price-product'>".$Product["price"]."</div>";
                    echo "</div></di></iv></li></ul>";
                }
                echo "<div class='payment-info'>";
                echo "<div class='delivery-info'></span>";
                if ($Order["orderStatus"] == "Completed") echo "The order has been delivered successfully.";
                else if ($Order["orderStatus"] == "Canceled") echo "The order has been cancelled.";
                else if ($Order["orderStatus"] == "Delivering") echo "Your order is being delivered to you.";
                else echo "Your order is being processed and will be delivered to you soon.";
                echo "</span></div>";
                echo "<div class='more-info'>";
                echo "<div class='total-amount-payable'><span>đ</span>".$Order["totalPayment"]."</span></div>";
                echo "<div class='action-content'>";
                if($Order["orderStatus"] == "Processing")
                {
                    echo "<button class='change-info' onClick='openChangeAddressForm(".$Order["id"].")' type='submit'>Change info</button>";
                    echo "<button class='cancel-order' onClick='openCancelForm(".$Order["id"].")' type='submit'>Cancel</button>";
                }
                echo "</div> </div> </div> </div></div>";
            }
            echo "</div>";
            echo "<div class='purchase-order-pagination'>";
            $totalPages = ceil(count($listOrder) / 5);
            if($totalPages > 1)
            {
                $maxPageShow = ($currentPage + 2) < $totalPages? ($currentPage + 2): $totalPages;
                $i = $currentPage < 3? 1: $currentPage - 2;
                if ($currentPage > 1) {
                    echo "<a class='page-Index button-action' href='$currentUrl&page=".($currentPage - 1)."'><i class='fa-solid fa-chevron-left'></i></a>";
                }
                for (; $i <= $maxPageShow; $i++) {
                    if ($i == $currentPage) {
                        echo "<span class='page-Index current'>$i</span>";
                    } else {
                        echo "<a class='page-Index' href='$currentUrl&page=$i'>$i</a>";
                    }
                }
                if ($currentPage < $totalPages) {
                    echo "<a class='page-Index button-action' href='$currentUrl&page=".($currentPage + 1)."'><i class='fa-solid fa-chevron-right'></i></a>";
                }
            }
            echo "</div>";
        }
        
    ?>
</div>
<div class="cancel-overlay"></div>
<form class="cancel-form" order-id = ''>
<div class="cancel-body">
        <i class="fas fa-sad-tear"></i> 
        <span>Confirm order deletion</span>
        <button class="close-btn" onclick="closeCancelForm(event)">&times;</button>
    </div>
    <div class="cancel-footer">
        <button class="confirm-btn" onclick="handleDeleteOrder()">Confirm</button>
    </div>
</form>

<form class="change-form" order-id = ''>
    <div class="change-address-body">
        <div>Change info</div>
        <button class="close-btn" onclick="closeChangeAddressForm(event)">&times;</button>
        <div class='change-customer-content'>
            <div class='customer-info info-content'>
                <div class='customer-name'>
                    <label>Recipient name:</label>
                    <input id="customer-name-input" type="text" value="" size="25" placeholder="Mảnh đẹp trai" />
                    <span class="err-span" id="err-name-span"></span>
                </div>
                <div class='customer-phone info-content'>
                    <label>Recipient phone:</label>
                    <input id="customer-phone-input" type="text" value="" size="25" placeholder="khum một hai ..." />
                    <span class="err-span" id="err-phone-span"></span>
                </div>
            </div>
        </div>
        <div class='change-address-content'>
            <div class='address-info'>
                <div class='province-name address-content'>
                    <label>Province:</label>
                    <select name="select-address" id="province-select"></select>
                </div>
                <div class='district-name address-content'>
                    <label>District:</label>
                    <select name="select-address" id="district-select"></select>
                </div>
                <div class='wards-name address-content'>
                    <label>Wards:</label>
                    <select name="select-address" id="wards-select"></select>
                </div>
                <div class='detail-address info-content'>
                    <label>Detail:</label>
                    <input id="detail-address-input" type="text" value="" size="25" placeholder="75/12 Nguyễn Văn Cừ ..." />
                </div>
            </div>
        </div>
    </div>
    <div class="change-footer">
        <button class="confirm-btn" onclick="handleChangeInfo(event)">Confirm</button>
    </div>
</form>

<form class="buy-again-form" order-id = ''>
<div class="buy-again-body">
        <i class="fa-light fa-face-kiss-wink-heart"></i>
        <span>Would you like to repurchase this order?</span>
        <button class="close-btn" onclick="closeBuyAgainForm(event)">&times;</button>
    </div>
    <div class="buy-again-footer">
        <button class="confirm-btn" onclick="navigateCheckout(event)">Confirm</button>
    </div>
</form>