<div class="modal-cus">
<div class="modal-body col-sm-12 col-md-12 col-xs-12 col-lg-6">
        
        <div class="login-form">
            <h4 class="login-title">Register</h4>
            <div class="row">
                <div class="col-md-6 col-12 mb-20">
                
                    <label>First Name</label>
                    <input  name="First_Name" id="FirstName" class="mb-0" type="text" placeholder="First Name">
                    <div class="error" id="error_firstName" >First Name không hợp lệ.(Không chứa ký số và các ký tự đặc biệt)</div>
                </div>
                <div class="col-md-6 col-12 mb-20">
                    <label>Last Name</label>
                    
                    <input name="Last_Name" id="LastName" class="mb-0" type="text" placeholder="Last Name">
                    <div class="error_login" id="error_lastName" >Last Name không hợp lệ.(Không chứa ký số và các ký tự đặc biệt)</div>
                </div>
                <div class="col-md-12 mb-20">
                    <label>Email Address*</label>
                    
                    <input name="Email" id="Email" class="mb-0" type="email" placeholder="Email Address">
                    <div class="error_login" id="error_email" >Sai định dạng Email.(VD:acb@gmail.com)</div>
                </div>

                <!-- <div class="col-md-12 mb-20">
                    <label>Address</label>
                    
                    <input name="Address" id="Address" class="mb-0" type="address" placeholder="Address">
                    <div class="error" id="error_address" >Không nhập các ký tự đặc biệt.</div>
                </div> -->
                <div class="col-md-6 mb-20">
                    <label>Password</label>
                    
                    <input name="Password" id="Password" class="mb-0" type="password" placeholder="Password">
                    <div class="error" id="error_password" >Password ít nhất 4 ký tự, không chứa khoảng trắng.</div>
                </div>
                <div class="col-md-6 mb-20">
                    <label>Confirm Password</label>
                    
                    <input name="Confirm_Password" id="Confirm_Password" class="mb-0" type="password" placeholder="Confirm Password">
                    <div class="error" id="error_confirmPassword" >Không trùng khớp với Passwword.</div>
                </div>
                <div class="col-md-12 mb-20">
                    <label>Phone</label>
                    
                    <input name="Phone" id="Phone" class="mb-0" type="phone" placeholder="Phone">
                    <div class="error" id="error_phone" >Sai định dạng số điện thoại.(SĐT phải đủ 10 số.VD:0999999999)</div>
                </div>
                
                <div class="col-12">
                    <button id="btn_register" class="register-button mt-0">Register</button>
                </div> 
            </div>
        </div>
    
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../../../public/js/lib/jquery.validate.min.js"></script>
<!-- <script >
    $("#auth-form").validate({
        rules: {
            First_Name: {
                required: true, 
                
                remote: "../../../public/PhP/CheckEmail.php"
            },
            Last_Name: {
                required: true,
                
                remote: "../../../public/PhP/CheckEmail.php"
            },
            Email: {
                required: true,
                email: true, 
                remote: "../../../public/PhP/CheckEmail.php"
            },
            Password: {
                required: true, 
                minlength: 4
            },
            Address: {
                required: true,
                Address : true,
                remote: "../../../public/PhP/CheckEmail.php"
            },
            Phone: {
                required: true,
                Phone : true,
                remote: "../../../public/PhP/CheckEmail.php"
            },

            Confirm_Password: {
                equalTo: "#Confirm_Password"
            },

        },
        messages: {
            First_Name: {
                required: "Mời nhập First Name.", 
                
                remote: "First Name không được chứa ký tự số."
            },
            Last_Name: {
                required: "Mời nhập Last Name.", 
                
                remote: "Last Name không được chứa ký tự số."
            },
            Email: {
                required: "Mời nhập Email.",
                email: "Sai định dạng Email.",
                remote: "Email đã tồn tại."
            },
            Address: {
                required: "Mời nhập Address.", 
                
                remote: "."
            },
            Phone: {
                required: "Mời nhập số điện thoại.", 
                
                remote: "."
            },
            Password: {
                required: "Mời nhập Password.", 
                minlength: "Password tối thiểu 4 ký tự."
            },
            Confirm_Password: {
                required: "Không trùng khớp với Password", 
                
            },
        },
        submitHandler: function(form){
            console.log($(form).serializeArray());
            $.ajax({
            type: "post",
            url: "./public/PhP/HandleRegister.php",
            data: $(form).serializeArray(), 
            success: function(response) {
                response = JSON.parse(response);
                if(response) {
                    window.location = "./home.php";
                }
            }
        })
        }
    })

</script> -->


