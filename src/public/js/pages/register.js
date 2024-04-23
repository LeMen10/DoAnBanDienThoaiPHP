var firstName, lastName, address, addressMail, phone, password, confirmPassword, icon, close;

$(document).ready(() => {
    firstName = document.getElementById(`FirstName`);
    lastName = document.getElementById('LastName');
    addressMail = document.getElementById('Email');
    password = document.getElementById('Password');
    confirmPassword = document.getElementById('Confirm_Password');
    icon = document.querySelector('.hm-wishlist');

    document.getElementById('FirstName').addEventListener('change', validate_FirstName);
    document.getElementById('LastName').addEventListener('change', validate_LastName);
    document.getElementById('Email').addEventListener('change', validateEmail);
    document.getElementById('Password').addEventListener('change', validatePass);
    document.getElementById('Confirm_Password').addEventListener('change', validatePass_Repass);
    close = document.getElementById('close-icon');
    close.addEventListener('click', close_formLogin);

    document.getElementById('btn_register').addEventListener('click', handleRegister);
});

function handleRegister() {
    if (
        firstName.value === '' ||
        lastName.value === '' ||
        addressMail.value === '' ||
        password.value === '' ||
        confirmPassword.value === ''
    ) {
        alert('Vui lòng nhập đầy đủ thông tin.');
    } else {
        if (
            !validate_FirstName() ||
            !validate_LastName() ||
            !validateEmail() ||
            !validatePass() ||
            !validatePass_Repass()
        ) {
            return;
        } else {
            CheckRegister(firstName.value, lastName.value, addressMail.value, password.value);
        }
    }
}
const CheckRegister = (firstName, lastName, email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=register&act=CheckRegister',
        data: { email },
        dataType: 'json',
        success: res => {
            if (res.check) {
                toast({
                    title: 'Thông báo!',
                    message: 'Email đã có người đăng ký 🙁',
                    type: 'warning',
                    duration: 1000,
                });
            } else {
                InsertAccount(firstName, lastName, email, password);
            }
        },
        error: err => {
            console.log(err);
        },
    });
};
const InsertAccount = (firstName, lastName, email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=register&act=InsertAccount',
        data: { firstName, lastName, email, password },
        dataType: 'json',
        success: res => {
            if (res.check) {
                window.location.href = 'index.php?ctrl=login';
            } else {
                toast({
                    title: 'Thông báo!',
                    message: 'Người dùng không tồn tại. Vui lòng kiểm tra lại email.',
                    type: 'warning',
                    duration: 2000,
                });
            }
        },
        error: err => {
            console.log(err);
        },
    });
};
function validate_FirstName() {
    var regex = /^[^0-9]*$/;
    var check = false;
    if (!regex.test(firstName.value)) {
        document.getElementById('error_firstName').style.display = 'block';
        check = false;
    } else {
        document.getElementById('error_firstName').style.display = 'none';
        check = true;
    }
    return check;
}
function validate_LastName() {
    var regex = /^[^0-9]*$/;
    var check = false;
    if (!regex.test(lastName.value)) {
        document.getElementById('error_lastName').style.display = 'block';
        check = false;
    } else {
        document.getElementById('error_lastName').style.display = 'none';
        check = true;
    }
    return check;
}
function validateEmail() {
    var regex = /\S+@\S+\.\S+/;
    var check = false;
    if (!regex.test(addressMail.value)) {
        document.getElementById('error_email').style.display = 'block';
        check = false;
    } else {
        document.getElementById('error_email').style.display = 'none';
        check = true;
    }
    return check;
}

function validatePass_Repass() {
    var check = false;
    if (password.value === confirmPassword.value) {
        document.getElementById('error_confirmPassword').style.display = 'none';
        check = true;
    } else {
        document.getElementById('error_confirmPassword').style.display = 'block';
        check = false;
    }
    return check;
}
function validatePass() {
    var check = false;
    if (password.value.length < 4) {
        document.getElementById('error_password').style.display = 'block';
        check = false;
    } else {
        document.getElementById('error_password').style.display = 'none';
        check = true;
    }
    return check;
}
function close_formLogin() {
    window.location.href = 'index.php';
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
