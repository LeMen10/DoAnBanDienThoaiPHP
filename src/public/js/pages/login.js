var email, password ,icon_close, checkShowPass;
$(document).ready(() => {
    email = document.getElementById("input_email");
    password = document.getElementById("input_pass");
    checkShowPass = document.getElementById("show_passs");
    
    checkShowPass.addEventListener('change', ShowPass);

    document.getElementById("input_email").addEventListener('change', validateEmail);
    document.getElementById("input_email").addEventListener('change', validateEmail);
    document.getElementById("btn_Login").addEventListener('click', handleLogin);

    document.getElementById("Forgotten_password").addEventListener('click', FormForgotPassword);
    icon = document.getElementById("icon_close");
    icon.addEventListener('click', close_formLogin);
})
function FormForgotPassword() {
    
    window.location.href = "index.php?ctrl=forgot_password";
    // window.location.href = "index.php?ctrl=forgot";

}
function handleLogin() {
    if (email.value == "" || password.value == "") {
        alert("Vui lòng nhập đầy đủ thông tin");
    }
    else {
        LoadAccount(email.value, password.value);
    }
}

const LoadAccount = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=login&act=Login',
        data: { email, password },
        dataType: 'json',
        success: res => {
            if (res.user) {
                if (res.user['authorName'] === "customer") {
                    var Taikhoan = JSON.stringify(res.user['id']);
                    sessionStorage.setItem('token', Taikhoan);
                    window.location.href = "index.php";

                }
                else if (res.user['authorName'] === "admin") {
                    var Taikhoan = JSON.stringify(res.user['id']);
                    sessionStorage.setItem('token', Taikhoan);
                    window.location.href = "index.php?ctrl=admin";
                }
            }
            else {
                    alert("Tài khoản hoặc mật khẩu bị sai!");
                }

        },
        error: err => {
            console.log(err);
        }
    })
}
function validateEmail() {
    var regex = /\S+@\S+\.\S+/;
    if (!regex.test(email.value)) {
        document.getElementById("error_email").style.display = "block";
    }
    else {
        document.getElementById("error_email").style.display = "none";
    }
}
function close_formLogin() {
    window.location.href = "index.php";

}
function ShowPass() {
    if (checkShowPass.checked) {
        password.type = "text";
        
    }
    else {
        password.type = "password";
    }
}

