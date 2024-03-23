var firstName,lastName, address,addressMail, phone, password, confirmPassword , icon; 

$(document).ready(() => {
    firstName = document.getElementById(`FirstName`);
    lastName = document.getElementById("LastName");
    addressMail = document.getElementById("Email");
    password = document.getElementById("Password");
    confirmPassword = document.getElementById("Confirm_Password");
    icon = document.querySelector('.hm-wishlist');
    
    document.getElementById("FirstName").addEventListener('change' ,validate_FirstName );
    document.getElementById("LastName").addEventListener('change' ,validate_LastName );
    document.getElementById("Email").addEventListener('change' ,validateEmail );
    document.getElementById("Password").addEventListener('change' ,validatePass);
    document.getElementById("Confirm_Password").addEventListener('change' ,validatePass_Repass );

    document.getElementById("btn_register").addEventListener('click' ,handleRegister );
})

function handleRegister() {
    if (firstName.value === "" || lastName.value === ""  || addressMail.value === "" 
    || password.value === "" || confirmPassword.value === ""){
        alert("Vui lòng nhập đầy đủ thông tin.");
    }
    else{
        if(!validate_FirstName() || !validate_LastName() || !validateEmail() || !validatePass() ||  !validatePass_Repass() ){
            return;
            
        }
        else {
            CheckRegister(firstName.value,lastName.value,addressMail.value,password.value);
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
            if(res.check){
                alert("Người dùng đã tồn tại!");
            }
            else{
                InsertAccount(firstName, lastName, email, password);
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
const InsertAccount = (firstName, lastName, email, password) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=register&act=InsertAccount',
        data: {firstName, lastName, email, password },
        dataType: 'json',
        success: res => {
            if(res.check){
                alert("Đăng ký thành công.");
                window.location.href = 'index.php?ctrl=login';
            }
            else{
                alert("Đăng ký không thành công.");
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function validate_FirstName(){
    var regex = /^[^0-9]*$/;
    var check = false;
    if (!regex.test(firstName.value) )   {
        document.getElementById("error_firstName").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_firstName").style.display = "none";
        check = true;
    } 
    return check;
    
    
}
function validate_LastName(){
    var regex = /^[^0-9]*$/;
    var check = false;
    if (!regex.test(lastName.value) )   {
        document.getElementById("error_lastName").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_lastName").style.display = "none";
        check = true;
    } 
    return check;
}
function validateEmail(){
    var regex = /\S+@\S+\.\S+/;
    var check = false;
    if (!regex.test(addressMail.value) )   {
        document.getElementById("error_email").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_email").style.display = "none";
        check = true;
    } 
    return check;
}

function validatePass_Repass(){
    var check = false;
    if(password.value === confirmPassword.value){
        document.getElementById("error_confirmPassword").style.display = "none";
        check = true;
    }
    else {
        document.getElementById("error_confirmPassword").style.display = "block";
        check = false;
    }
    return check;

}
function validatePass(){
    var check = false;
    if( password.value.length < 4){
        document.getElementById("error_password").style.display = "block";
        check = false;
    }
    else{
        document.getElementById("error_password").style.display = "none";
        check = true;
    }
    return check;

}




