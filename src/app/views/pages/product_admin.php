<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success">Add</button>
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
                        <tr>
                            <th scope="col">
                                <input type="checkbox" name="" id="">
                            </th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="product-item">
                            <th scope="row">
                                <input type="checkbox" name="" id="">
                            </th>
                            <td>
                                <img src="public/img/phone_image/IPhone14_1_1.jpg" alt="" class="image_product">
                                <p>iPhone 14</p>
                            </td>
                            <td>Otto</td>
                            <td>mark@email.com</td>
                            <td>UK</td>
                        </tr>
                    </tbody>
                </table>
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
                <!-- <label class="lb-suplier" >Suplier:</label>
                <select class="iput1 suplier">
                </select>            -->
                <label class="lb-title" >Name Phone:</label>
                <input class="iput1 name-add" type="text">
                                            
                <label class="lb-category" >Category:</label>
                <select class="iput1 category-add">
                </select>
        
                <label class="lb-ramrom" >RAM/ROM:</label>
                <input class="iput1 ramrom-add" type="text" >
            
                <label class="lb-color" >Color:</label>
                <input class="iput1 color-add" type="text" >
                          
            </div>
            <button class='btn-add complete' onclick="AddPhone()">Add Phone</button>
        </div>
    </div>
</div>