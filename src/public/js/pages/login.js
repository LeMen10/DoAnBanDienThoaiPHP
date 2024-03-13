var email, password, icon;
$(document).ready(() => {
    email = document.getElementById("input_email");
    password = document.getElementById("input_pass");
    icon = document.querySelector('.hm-wishlist');
    document.getElementById("input_email").addEventListener('change' ,validateEmail );
    document.getElementById("btn_Login").addEventListener('click' ,handleLogin );
})
function handleLogin() {
    if(email.value == "" || password.value == "") {
        alert("Vui lòng nhập đầy đủ thông tin");
    }
    else {
        LoadAccount(email.value,password.value);


    
    }
    
}

// function token(){
//     //tạo thời gian hết hạn của cookies
//     var expireTime = new Date();
//     expireTime.setTime(expireTime.getTime() + (1 * 60 * 60 * 1000)); // Thời gian hết hạn ở đây là 1 giờ
//     var cookieData = "email= " + email.value + "; password= " + password.value + "; expires = " + expireTime.toUTCString() + "; path=/";
    
//     document.cookie = "Token=" + encodeURIComponent(cookieData);
//     // document.cookie = "Token=" + cookieData;
//     deCodeToken(document.cookie);
//     alert("Email và password đã được lưu vào cookies.");
// }
// //giải mã token
// function deCodeToken(){
//     var decodedToken = {};
//     var keyValuePairs = token.split('; ');
//     keyValuePairs.forEach(function(pair) {
//         var keyValue = pair.split('=');
//         decodedToken[keyValue[0]] = keyValue[1];
//     });

//     return decodedToken;
// }

// const LoadAccount = (email, password) => {
//     return $.ajax({
//         type: 'post',
//         url: 'index.php?ctrl=login&act=Login',
//         data: { email, password },
//         dataType: 'json',
//         success: res => {
//             if(res.check) {
//                 alert("Đăng nhập thành công");
//             }
//             else{
//                 alert("Email hay password sai.");
//             }
//         },
//         error: err => {
//             console.log(err);
//         }
//     })
// }
const LoadAccount = (email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=login&act=Login',
        data: { email, password },
        dataType: 'json',
        success: res => {
            if(res.user['authorName'] === "customer") {
                var Taikhoan = JSON.stringify(res.user['id']);
                sessionStorage.setItem('token', Taikhoan);
                window.location.href = "index.php";

            }
            else if(res.user['authorName'] == "admin"){
                window.location.href = "index.php?ctrl=admin";
            }
            else {
                // if(confirm(res) == false){
                alert("sai tk mk");
            // }
        }
                
            // if(res.check) {
            //     alert("Đăng nhập thành công");
            //     window.location.href = "index.php";
            // }
            // else{
            //     alert("Đăng nhập thành công");
            //     window.location.href = 'index.php?ctrl=admin';
            // }
           
        },
        error: err => {
            console.log(err);
        }
        
    })
    
}

// const CheckLogin = (email, password) => {
//     return $.ajax({
//         type: 'post',
//         url: 'index.php?ctrl=register&act=CheckLogin',
//         data: { email, password },
//         dataType: 'json',
//         success: res => {
//             if(res.check){
//                 alert("Đăng nhập thành công");
//             }
//             else{
//                 alert("Email hay password sai.");
                
//             }
//         },
//         error: err => {
//             console.log(err);
//         }
//     })
// }
function validateEmail(){
    var regex = /\S+@\S+\.\S+/;
    if (!regex.test(email.value) )   {
        document.getElementById("error_email").style.display = "block";
    }
    else{
        document.getElementById("error_email").style.display = "none";
    } 
}

