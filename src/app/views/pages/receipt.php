
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
                <div class="d-flex align-items-center container-head">
                    <div class="comboxnbtn">
                        <div class="divsupplier">
                            <label class="lb-supplier"> Nhà cung cấp:</label>
                            <select class="iput1 supplier">
                            <?php
                                if(isset ($suppliers)){
                                    foreach ($suppliers as $item) {
                                        echo "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="btn-create-receipt">
                            <button type="button" class="btn btn-success" onclick = "handleOpen(1,0)">Create Receipt</button>
                        </div>
                    </div>
                    <div class="btn-add-receipt">
                        <button type="button" class="btn btn-success add-receipt" onclick = "handleOpen(0,1)">Thêm</button>
                    </div>
                </div> 
            </div>
        </div>
        <div class= "form-add-receipt">
            <div class="col-12 pt-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col" class = "col-name-phonename">Name</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Color</th>
                                        <th scope="col" >Quantity</th>
                                        <th scope="col" >Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class='body_user'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="btn-cal-ok">
                        <button type="button" class="btn btn-success" onclick ="handleClose(1)">Hủy</button>
                        <button type="button" class="btn btn-success" onclick ="UpdateByReceipt()">Oke</button>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>

<div class="add-user-overlay">
    <div class="form-add-user">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(0)"></i>
        <div class="add-user-wapper">  
                <label class="lb-category" >Category:</label>
                <select class="iput1 category-add" onchange = 'handlePhoneNameChange()'>
                </select>
                                            
                <label class="lb-category" >Phone Name:</label>
                <select class="iput1 phonename-add" onchange = 'handleSizeChange()'>
                </select>
                <label class="lb-category" >Size:</label>
                <select class="iput1 size-add" onchange = 'handleColorChange()'>
                </select>
                <label class="lb-category" >Color:</label>
                <select class="iput1 color-add">
                </select>
                <label class="lb-password lbuser" >Giá:</label>
                <input class="iputuser price-add" type="number">

                <label class="lb-password lbuser" >Số lượng:</label>
                <input class="iputuser quantity-add" type="number">            
           
                <button class='btn-add-user complete' onclick="CreateReceipt()">Sumbit</button>
        </div>
    </div>
</div>
  