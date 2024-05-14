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
        toast({
            title: 'Thông báo!',
            message: 'Vui lòng nhập đầy đủ thông tin 😐',
            type: 'warning',
            duration: 2000,
        });
        return;
    }
    else{
        if(!validateEmail() || !validatePass() || !validatePass_Repass() ) return;
        else CheckExistEmail(email.value,password.value);
    }
}
const ResetPassword = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=reset&act=UpdatePassword',
        data: { email,password},
        dataType: 'json',
        success: res => {
            if(res.isSuccess){
                toast({
                    title: 'Thông báo!',
                    message: 'Đổi mât khẩu thành công 😊',
                    type: 'warning',
                    duration: 2000,
                });      
            }
            else{
                toast({
                    title: 'Thông báo!',
                    message: 'Đổi mât khẩu thất bại 😐',
                    type: 'warning',
                    duration: 2000,
                });
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
        url: 'index.php?ctrl=reset&act=CheckExistEmail',
        data: { email},
        dataType: 'json',
        success: res => {
            if(res.check) ResetPassword(email, password);
            else{
                toast({
                    title: 'Thông báo!',
                    message: 'Người dùng không tồn tại! 😐',
                    type: 'warning',
                    duration: 2000,
                });
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

const toast = ({ title = '', message = '', type = 'info', duration = 2000 }) => {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');
        const autoRemove = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);
        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemove);
            }
        };
        const icons = {
            success: 'fa-solid fa-circle-check',
            info: 'fa-solid fa-circle-info',
            warning: 'fa-solid fa-circle-exclamation',
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInleft ease .6s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                <div class="toast__icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast__body">
                    <h3 class="toast__title">${title}</h3>
                    <p class="toast__msg">${message}</p>
                </div>
                <div class="toast__close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            `;
        main.appendChild(toast);
    }
};