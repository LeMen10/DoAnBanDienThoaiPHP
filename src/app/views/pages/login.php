
<div class="modal-cus">

    <div class="modal-body col-sm-12 col-md-12 col-xs-12 col-lg-6">
        <!-- <form action="index.php?ctrl=login" method = "post" class="auth-form"> -->
            <div class="login-form">
                <div class="d-flex justify-content-between">
                    <h4 class="login-title">Login</h4>
                    <span>
                        <i id="close-icon" class="fa-solid fa-xmark close-icon"></i>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12 mb-20">
                        <input name="email" id="input_email" class="mb-0 " type="email" placeholder="Email">
                        <div class="error" id="error_email" >Sai định dạng Email.(VD:acb@gmail.com)</div>
                    </div>
                    <div class="col-12 mb-20">
                        <input name= "password" id="input_pass" class="mb-0 js_input_pass" type="password" placeholder="Password">
                        <div class="error" id="error_password" >Sai Password.</div>
                    </div>
                    <div class="col-md-8">
                        <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                            <input type="checkbox" id="show_passs">
                            <label for="show_passs">Show pass</label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                        <a id="Forgotten_password" href="#"> Forgotten password</a>
                    </div>
                    <div class="process mb-20">
                        <div class="col-md-12 group-button">
                            <button name="bt_login" id="btn_Login" class="login-button mt-0">Login</button>
                        </div>
                    </div>
                    <div class="link-register">
                        <span>If you do not already have an account. </span> 
                        <a class="dang-Ky" href="index.php?ctrl=register">Register</a>
                        <span>here.</span> 
                    </div>
                    
                 
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>

