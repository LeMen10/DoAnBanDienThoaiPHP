var email,password,confirmPassword, show_pass, btnClose;
$(document).ready(() => {
    email = document.getElementById("email_RS");
    password = document.getElementById("input_pass_RS");
    confirmPassword = document.getElementById("input_repeat_pass_RS");
    show_pass = document.getElementById("show_pass_RS");

    show_pass.addEventListener('change', ShowPass);
    document.getElementById("email_RS").addEventListener('change' ,validateEmail);
    document.getElementById("input_pass_RS").addEventListener('change' ,validatePass);
    document.getElementById("input_repeat_pass_RS").addEventListener('change' ,validatePass_Repass );
    btnClose = document.getElementById("icon_close");
    btnClose.addEventListener('click', close_formLogin);

    document.getElementById("bt_ok_RS").addEventListener('click' ,handle );
})
function handle() {
    
    if (email.value === "" ||  password.value === "" || confirmPassword.value === ""){
        alert("Vui lòng nhập đầy đủ thông tin.");
        
    }
    else{
        if(!validateEmail() || !validatePass() || !validatePass_Repass() ) return;
        else CheckExistEmail(email.value,password.value);
    }
}
const ResetPassword = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=forgot&act=UpdatePassword',
        data: { email,password},
        dataType: 'json',
        success: res => {
            if(res.isSuccess){
                alert("đổi mât khẩu thanh cong");
                
            }
            else{
                alert("đổi mât khẩu ko thanh cong");
                return;
            }
        },
        error: err => {
            console.log(err);
        }
    })
}

const CheckExistEmail = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=forgot&act=CheckExistEmail',
        data: { email},
        dataType: 'json',
        success: res => {
            if(res.check){
                ResetPassword(email, password);
                
            }
            else{
                alert("Người dùng không tồn tại!");
                return;
            }
        },
        error: err => {
            console.log(err);
        }
    })
}

function validateEmail(){
    var regex = /\S+@\S+\.\S+/;
    var check = false;
    if (!regex.test(email.value) )   {
        document.getElementById("error_email_RS").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_email_RS").style.display = "none";
        check = true;
    } 
    return check;
}
function validatePass(){
    var check = false;
    if( password.value.length < 4){
        document.getElementById("error_password_RS").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_password_RS").style.display = "none";
        check = true;
    }
    return check;

}
function validatePass_Repass(){
    var check = false;
    if(password.value === confirmPassword.value){
        document.getElementById("error_passwordRe_RS").style.display = "none";
        check = true;
    }
    else {
        document.getElementById("error_passwordRe_RS").style.display = "block";
        check = false;
    }
    return check;

}

function ShowPass() {
    if (show_pass.checked) {
        confirmPassword.type = "text";
        password.type = "text";
    }
    else {
        confirmPassword.type = "password";
        password.type = "password";
    }
}
function close_formLogin() {
    window.location.href = "index.php";

}