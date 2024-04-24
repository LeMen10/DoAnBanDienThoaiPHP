<div class="modal-cus">
    <div class='modal-overlay'>
        <img src="public/img/banner/forgotPassword.jpg" alt="" class="w-100">
    </div>

    <div class="modal-body col-sm-12 col-md-12 col-xs-12 col-lg-6">
        <!-- <form action="pro.php" method="post" class="auth-form"> -->

        <div class="login-form">
            <div class="d-flex justify-content-between">
                <h4 class="login-title">Forgot Password</h4>
                <span>
                    <i id="close-icon" class="fa-solid fa-xmark close-icon"></i>
                </span>
            </div>
            <div class="row">
                <div class="col-md-12 col-12 mb-40">
                    <input name="email" id="input_email" class="mb-0 " type="email" placeholder="Email">
                    <div class="error" id="error_email">Sai định dạng Email.(VD:acb@gmail.com)</div>
                    
                </div>

                <div class="col-md-12 group-button">
                    <button onclick="sendLink()" type="submit" name="bt_ok" id="bt_sendEmail" class="ok-forgotPass-button mt-0">Gửi Email</button>
                </div>
                <div id="message"></div>
            </div>
        </div>

        <!-- </form> -->
    </div>

</div>