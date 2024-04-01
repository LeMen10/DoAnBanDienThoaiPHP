<div class="modal-cus">
    <div class='modal-overlay'>
        <img src="public/img/banner/1_1.jpg" alt="" class="w-100">
    </div>

    <div class="modal-body col-sm-12 col-md-12 col-xs-12 col-lg-6">
        <!-- <form action="index.php?ctrl=login" method = "post" class="auth-form"> -->
            <div class="login-form">
                <div class="d-flex justify-content-between">
                    <h4 class="login-title">Reset Password</h4>
                    <i id="icon_close" class="fa-solid fa-xmark"></i>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12 mb-20">
                        <label>Email</label>
                        <input value="<?php if(isset($email)) echo $email ?>" name="email_RS" id="email_RS" class="mb-0 " type="email" placeholder="Email">
                        <div class="error" id="error_email_RS" >Sai định dạng Email.(VD:acb@gmail.com)</div>
                    </div>
                    <div class="col-12 mb-20">
                        <label>Nhập Password mới</label>
                        <input name= "password" id="input_pass_RS" class="mb-0 js_input_pass" type="password" placeholder="Password">
                        <div class="error" id="error_password_RS" >Password ít nhất 4 ký tự, không chứa khoảng trắng.</div>
                    </div>
                    <div class="col-12 mb-20">
                        <label>Nhập lại Password mới</label>
                        <input name= "password_RS" id="input_repeat_pass_RS" class="mb-0 js_input_pass" type="password" placeholder="Password">
                        <div class="error" id="error_passwordRe_RS" >Không trùng với Password.</div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                            <input type="checkbox" id="show_pass_RS">
                            <label for="show_pass_RS">Show pass</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <button name="bt_ok" id="bt_ok_RS" class="ok-forgotPass-button mt-0">OK</button>
                    </div>
                 
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>
