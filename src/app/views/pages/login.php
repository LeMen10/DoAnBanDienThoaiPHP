<!-- <?php
    if($_POST['bt_login']){
        $email = $_POST['email'];
        $pass = $_POST['password'];
    }
    if($_POST['bt_login']){
        setcookie("email", $email, time()+(86400));
        setcookie("pass", $pass, time()+(86400));
        $mess= "Đã ghi nhận cookies.";
    }
?> -->
<div class="modal-cus">
    <div class='modal-overlay'>
        <img src="public/img/banner/1_1.jpg" alt="" class="w-100">
    </div>

    <div class="modal-body col-sm-12 col-md-12 col-xs-12 col-lg-6">
        <!-- <form action="index.php?ctrl=login" method = "post" class="auth-form"> -->
            <div class="login-form">
                <div class="d-flex justify-content-between">
                    <h4 class="login-title">Login</h4>
                    <i id="icon_close" class="fa-solid fa-xmark"></i>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12 mb-20">
                        <label>Email</label>
                        <input name="email" id="input_email" class="mb-0 " type="email" placeholder="Email">
                        <div class="error" id="error_email" >Sai định dạng Email.(VD:acb@gmail.com)</div>
                    </div>
                    <div class="col-12 mb-20">
                        <label>Password</label>
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
                        <a href="#"> Forgotten pasward?</a>
                    </div>
                    <div class="col-md-12">
                        <button name="bt_login" id="btn_Login" class="login-button mt-0">Login</button>
                    </div>
                 
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>

