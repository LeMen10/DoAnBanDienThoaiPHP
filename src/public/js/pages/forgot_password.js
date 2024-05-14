var email, close;
$(document).ready(() => {
    email = document.getElementById("input_email");
    document.getElementById("input_email").addEventListener('change' ,validateEmail );
    document.getElementById("bt_sendEmail").addEventListener('click', handle);
    close = document.getElementById("close-icon");
    close.addEventListener('click', close_formLogin);
})
function handle() {
    if (email.value === "" ){
        toast({
            title: 'Cảnh báo!',
            message: 'Vui lòng nhập email để tạo mật khẩu mới. kh nhập thì cút',
            type: 'warning',
            duration: 2000,
        });
    }
    else{
        if(!validateEmail() ) return;
        else{
            let check = CheckExistEmail(email.value);
            if(check) sendLink();
        }
    }
}
const CheckExistEmail = (email) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=forgot_password&act=CheckExistEmail',
        data: { email},
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if(res.check) return true;
            else{
                toast({
                    title: 'Cảnh báo!',
                    message: 'Người dùng không tồn tại. Vui lòng kiểm tra lại email.',
                    type: 'warning',
                    duration: 2000,
                });
                return false;
            }
        },
        error: err => {
            console.log(err);
        }
    })
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

function validateEmail(){
    var regex = /\S+@\S+\.\S+/;
    var check = false;
    if (!regex.test(email.value) )   {
        document.getElementById("error_email").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_email").style.display = "none";
        check = true;
    } 
    return check;
}
function sendLink() {
    var email = document.getElementById("input_email").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "./app/views/pages/pro.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);

}
function close_formLogin() {
    window.location.href = "index.php";

}

const navigationLogin = () => { window.location.href = 'index.php?ctrl=login' };