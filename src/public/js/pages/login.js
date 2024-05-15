var email, password, icon_close, checkShowPass;
$(document).ready(() => {
    email = document.getElementById('input_email');
    password = document.getElementById('input_pass');
    checkShowPass = document.getElementById('show_passs');

    checkShowPass.addEventListener('change', ShowPass);

    document.getElementById('input_email').addEventListener('change', validateEmail);
    document.getElementById('btn_Login').addEventListener('click', handleLogin);

    document.getElementById('Forgotten_password').addEventListener('click', FormForgotPassword);
    icon = document.getElementById('close-icon');
    icon.addEventListener('click', close_formLogin);

});
function FormForgotPassword() {
    window.location.href = 'index.php?ctrl=forgot_password';
    // window.location.href = "index.php?ctrl=forgot";
}
function handleLogin() {
    if (email.value == '' || password.value == '') {
        alert('Vui lòng nhập đầy đủ thông tin');
    } else {
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
            console.log(res);
            if(res.success == false) {
                toast({
                    title: 'Cảnh báo!',
                    message: 'Tài khoản không tồn tại. Vui lòng đăng nhập lại.',
                    type: 'warning',
                    duration: 1000,
                });
                return;
            }
            if (res.user) {
                console.log(res.user)
                let d = new Date();
                d.setTime(d.getTime() + 2 * 24 * 60 * 60 * 1000);
                var expires = 'expires=' + d.toUTCString();
                if (res.user === 'customer') {
                    document.cookie = 'token' + '=' + res.token + ';' + expires + ';path=/';
                    window.location.href = 'index.php';
                } else if (res.user === 'admin' || res.user === 'membership') {
                    document.cookie = 'token' + '=' + res.token + ';' + expires + ';path=/';
                    window.location.href = 'index.php?ctrl=admin';
                }
            } else {
                toast({
                    title: 'Cảnh báo!',
                    message: 'Tài khoản không tồn tại. Vui lòng đăng nhập lại.',
                    type: 'warning',
                    duration: 1000,
                });
                return;
            }
        },
        error: err => {
            console.log(err);
        },
    });
};
function validateEmail() {
    var regex = /\S+@\S+\.\S+/;
    if (!regex.test(email.value)) {
        document.getElementById('error_email').style.display = 'block';
    } else {
        document.getElementById('error_email').style.display = 'none';
    }
}
function close_formLogin() {
    window.location.href = 'index.php';
}
function ShowPass() {
    if (checkShowPass.checked) password.type = 'text';
    else password.type = 'password';
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
