<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li class="active"><?php echo ucfirst($data['page']);?></li>
            </ul>
        </div>
    </div>
</div>

<div class="checkout-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center">
                <div class="address-checkout-title mr-10">Địa chỉ: </div>
                <div class="address-checkout"></div>
                
                <div class="ml-10 btn-chage-address" onclick="changeAddress()">Thay đổi</div>
            </div>
            <div class="col-12 mt-20">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-thumbnail">Images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-quantity">Quantity</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['checkout'] as $item) {
                                    echo "
                                        <tr class='wrap-product-item' >
                                            <td class='li-product-thumbnail'><a href='#'><img src='public/img/phone_image/". $item['image'] ."' alt='Li's Product Image'></a></td>
                                            <td class='li-product-name'><a href='#'>". $item['name'] ."</a></td>
                                            <td class='li-product-price'><span class='amount'><span class='currency-unit'>đ</span><span class='currency-price'>". $item['price']."</span></span></td>
                                            <td class='quantity'>". $item['quantity'] ."</td>
                                            <td class='product-subtotal'><span class='amount' ><span class='currency-unit'>đ</span><span class='product-subtotal-value'>".$item['quantity']*$item['price']."</span></span></td>
                                        </tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Checkout totals</h2>
                                <div class="cart-page-content">
                                    <ul>
                                        <li>Total 
                                            <span>
                                                <span class="currency-unit">đ</span>
                                                <?php 
                                                    $total = 0;
                                                    foreach ($data['checkout'] as $item) {
                                                        $total += $item['quantity']*$item['price'];
                                                    } 
                                                    echo "<span class='total-price'>". $total ."</span>"
                                                ?>
                                            </span>
                                        </li>
                                    </ul>
                                    <p class="btn-payment">Payment</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class='modal check-show-address'>
    <div class='modal__overlay'></div>
    <div class='modal__body'>
        <div class='auth-form'>
            <div class='auth-form__container'>
                <div class='auth-form__header'>
                    <h3 class='auth-form__heading'>Địa chỉ của tôi.</h3>
                </div>

                <div class='address-list-wrap'></div>
                <button class='btn-add-address' onclick="showModalCreateAddress()">
                    <i class="fa-solid fa-plus icon-add-address"></i>
                    Thêm địa chỉ mới
                </button>
                <div class='auth-form__control'>
                    <button
                        class='btn, auth-form__control-back, btn--normal, btn-back-modal-address'
                    >
                        Trở lại
                    </button>
                    <button
                        class='btn, btn-success, view-cart, ml-20'
                        onclick="saveShippingAddress()"
                    >
                        Hoàn thành
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class='modal check-show-modal'>
    <div class='modal__overlay'></div>
    <div class='modal__body'>
        <div class='auth-form'>
            <div class='auth-form__container'>
                <div class='auth-form__header'>
                    <h3 class='auth-form__heading heading-title'></h3>
                    <p class='auth-form__switch-btn'></p>
                </div>
                <div class='auth-form__form add-auth-form__group'>
                    <div class='auth-form__group'>
                        <input
                            type="text"
                            placeholder="Họ và tên"
                            name="recipientName"
                            class='auth-form__input'
                        />
                    </div>
                    <div class='auth-form__group'>
                        <input
                            type="text"
                            placeholder="Số điện thoại"
                            name="recipientPhone"
                            class='auth-form__input'
                        />
                    </div>
                </div>
                
                <div class='auth-form__form add-auth-form__group'>
                    <div class='auth-form__group'>
                        <select class="w-100" name="" id="province" onclick="onChangeProvince(this)"></select>
                    </div>
                    <div class='auth-form__group'>
                        <select class="w-100" name="" id="district" onclick="onChangeDistrict(this)" disabled>
                            <option value = "0">Chọn Quận/Huyện</option>
                        </select>
                    </div>
                </div>
                
                <div class='auth-form__form add-auth-form__group'>
                    <div class='auth-form__group'>
                        <select class="w-100" name="" id="wards" onclick="onChangeWards(this)" disabled>
                            <option value = "0">Chọn Xã/Phường</option>
                        </select>
                    </div>
                    <div class='auth-form__group'>
                        <input
                            type="text"
                            placeholder="Địa chỉ cụ thể"
                            name="detail"
                            class='auth-form__input mt-0'
                        />
                    </div>
                </div>
                
                <div class='auth-form__control'>
                    <button
                        class='btn, auth-form__control-back, btn--normal, btn-back-modal-add'
                    >
                        Trở lại
                    </button>
                    <button class='btn, btn--primary, btn-success, ml-20' onclick="checkInputAddress()">
                        Hoàn thành
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
