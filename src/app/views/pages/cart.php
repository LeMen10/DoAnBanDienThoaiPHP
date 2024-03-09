<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li class="active"><?php echo ucfirst($data['page']); ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-checkall">
                                        <input type="checkbox" class="checkall">
                                    </th>
                                    <th class="li-product-thumbnail">Images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-quantity">Quantity</th>
                                    <th class="li-product-subtotal">Total</th>
                                    <th class="li-product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['cart'] as $item) {
                                    echo "
                                        <tr class='wrap-product-item' data-id='". $item['id'] ."'>
                                            <td class='li-product-remove'>
                                                <input type='checkbox' class='checkbox-cart'>
                                            </td>
                                            <td class='li-product-thumbnail'><a href='#'><img src='public/img/phone_image/". $item['image'] ."' alt='Li's Product Image'></a></td>
                                            <td class='li-product-name'><a href='#'>". $item['name'] ."</a></td>
                                            <td class='li-product-price'><span class='amount'><span class='currency-unit'>đ</span><span class='currency-price' data-id='". $item['id'] ."'>". $item['price']."</span></span></td>
                                            <td class='quantity'>
                                                <div class='cart-plus-minus'>
                                                    <input class='cart-plus-minus-box ip-quantity' data-id='". $item['id'] ."' value='". $item['quantity'] ."' type='text'>
                                                    <div class='dec qtybutton qtybutton-add' data-id='". $item['id'] ."'><i class='fa fa-angle-down'></i></div>
                                                    <div class='inc qtybutton qtybutton-sub' data-id='". $item['id'] ."'><i class='fa fa-angle-up'></i></div>
                                                </div>
                                            </td>
                                            <td class='product-subtotal'><span class='amount' ><span class='currency-unit'>đ</span><span class='product-subtotal-value' data-id='".$item['id']."'>".$item['quantity']*$item['price']."</span></span></td>
                                            <td class='li-product-remove button-delete' data-id='". $item['id'] ."'><i class='fa-solid fa-trash'></i></td>
                                        </tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <div class="cart-page-content">
                                    <ul>
                                        <li>Total 
                                            <span>
                                                <span class="currency-unit">đ</span>
                                                <span class="total-price">0</span>
                                            </span>
                                        </li>
                                    </ul>
                                    <a href="index.php?ctrl=checkout">Checkout</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>