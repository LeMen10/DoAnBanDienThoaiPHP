<div class="row g-4">
<div class="col-12">
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success">Add</button>
                <a href="index.php?ctrl=trash_user">
                    <i class="fa-regular fa-trash-can icon-trash"></i>
                </a>
            </div> 
        </div>
    </div>
</div>

<div class="update-user-overlay">
    <div class="form-edit-user">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(0)"></i>
        <div class="update-user-wapper">
                        
                <label class="lb-name lbuser" >Name:</label>
                <input class="iputuser name" type="text">
                                            
                <label class="lb-email lbuser" >Email:</label>
                <input class="iputuser email" type="text" >
            
                <label class="lb-author lbuser" >Author:</label>
                <select class="iputuser author">
                </select>
                </div>      
        <button class='btn-update-user complete' onclick="UpdateUser()">Complete</button>
       
    </div>
</div>
<div class="add-user-overlay">
    <div class="form-add-user">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(1)"></i>
        <div class="add-user-wapper">
            
                <label class="lb-name lbuser" >Name:</label>
                <input class="iputuser name-add" type="text">
                
                <label class="lb-password lbuser" >Password:</label>
                <input class="iputuser password-add" type="password">

                <label class="lb-email lbuser" >Email:</label>
                <input class="iputuser email-add" type="text" >

                <label class="lb-author lbuser" >Author:</label>
                <select class="iputuser author-add">
                </select>            
           
        <button class='btn-add-user complete' onclick="AddUser()">Add User</button>
                        </div>
    </div>
</div>