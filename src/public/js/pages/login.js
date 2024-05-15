$(document).ready(() => {
    document.getElementById("btn_Login").addEventListener('click' ,handleLogin );
})
function handleLogin() {
    
    const email = document.getElementById(`input_email`).value;
    const password = document.getElementById("input_pass").value;
    LoadAccount(email,password);
}
const LoadAccount = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=login&act=Login',
        data: { email, password },
        dataType: 'json',
        success: res => {
            console.log(res);
            if (res.success == false) {
                toast({
                    title: 'Cảnh báo!',
                    message: 'Tài khoản không tồn tại. Vui lòng đăng nhập lại.',
                    type: 'warning',
                    duration: 1000,
                });
                return;
            }
            if (res.user) {
                let d = new Date();
                d.setTime(d.getTime() + 2 * 24 * 60 * 60 * 1000);
                var expires = 'expires=' + d.toUTCString();
                if (res.user === 'customer') {
                    document.cookie = 'token' + '=' + res.token + ';' + expires + ';path=/';
                    window.location.href = 'index.php';
                } else if (res.user === 'admin' || res.user === '       ') {
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
        }
    })
}