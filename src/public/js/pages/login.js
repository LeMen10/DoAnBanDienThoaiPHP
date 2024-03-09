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
            console.log(res.email);
        },
        error: err => {
            console.log(err);
        }
    })
}