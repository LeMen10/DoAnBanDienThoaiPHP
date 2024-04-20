<div id="edit-product" class="control-form" style="display: block;">
                    <span class="close" onclick="document.getElementById('product-control-modal').style.display='none'">
                        <i class="close-btn fa-solid fa-xmark"></i>
                    </span>
                    <div class="control-form__container">
                        <div class="control-form__heading">
                            <h3>Sửa thông tin sản phẩm</h3>
                        </div>
                        <div class="control-form__upload">
                            <button class="upload-img-btn" onclick="openEditFileBtnActive()">Upload ảnh</button>
                            <input type="file" name="" id="open-file" hidden="">
                            <div class="edit upload-box active">
                                <img src="./img/product/iphone/iphone002.png" alt="" class="upload-img" id="product-img">
                                <span class="edit-close" onclick="deleteImg()">
                                    <i class="close-btn fa-solid fa-xmark"></i>
                                </span>
                                <div class="upload-box-content">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                            <div class="control-form__form-box">
                                <label for="product-name" class="control-form__form-lable">Tên sản phẩm</label>
                                <input id="product-name" type="text" class="control-form__form-input" placeholder="Nhập tên" required="">
                            </div>
                            <div class="control-form__form-box">
                                <label for="product-category" class="control-form__form-lable">Loại sản phẩm</label>
                                <select name="" id="product-category">
                                    <option value="iphone">iPhone</option>
                                    <option value="ipad">Xiaomi</option>
                                    <option value="macbook">Samsung</option>
                                    <option value="apple-watch">Vivo</option>
                                </select>
                            </div>
                            <div class="control-form__form-box">
                                <label for="product-category" class="control-form__form-lable">Color</label>
                                <select name="" id="product-color">
                                    <option value="iphone">Xanh</option>
                                    <option value="ipad">Trắng</option>
                                    <option value="macbook">Tím</option>
                                    <option value="apple-watch">Đen</option>
                                </select>
                            </div>
                            <div class="control-form__form-box">
                                <label for="product-current-price" class="control-form__form-lable">Giá bán</label>
                                <input id="product-current-price" type="number" class="control-form__form-input" placeholder="Nhập giá bán" required="">
                            </div>
            
                            <button class="control-form___form-btn" type="submit">Lưu chỉnh sửa</button>
                    </div>
    </div>