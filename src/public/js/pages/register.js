var firstName ;
const lastName = document.getElementById("LastName");
const address = document.getElementById("Address");
const addressMail = document.getElementById("Email");
const phone = document.getElementById("Phone");
const password = document.getElementById("Password");
const confirmPassword = document.getElementById("Confirm_Password");
$(document).ready(() => {
    firstName = document.getElementById(`FirstName`);
    document.getElementById("btn_register").addEventListener('click' ,handleRegister );
    document.getElementById("FirstName").addEventListener('change' ,validate_FirstName );
    document.getElementById("LastName").addEventListener('change' ,validate_LastName );
    document.getElementById("Email").addEventListener('change' ,validateEmail );
    document.getElementById("Address").addEventListener('change' ,handleRegister );
    document.getElementById("Phone").addEventListener('change' ,handleRegister );
    document.getElementById("Password").addEventListener('change' ,handleRegister );
    document.getElementById("Confirm_Password").addEventListener('change' ,handleRegister );
})

function handleRegister() {
    
    
    if (firstName.value === "" || lastName.value === "" || address.value === "" || addressMail.value === "" 
    || phone.value === "" || password.value === "" || confirmPassword.value === ""){
        alert("Vui lòng nhập đầy đủ thông tin.");
    }
    else{


    }
    CheckRegister(firstName.value,lastName.value,addressMail.value,password.value,address.value,phone.value);
    
}
const CheckRegister = (firstName, lastName, email, password, address, phone) => {
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
                InsertAccount(firstName, lastName, email, password, address, phone);
                
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
const InsertAccount = (firstName, lastName, email, password, address, phone) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=register&act=InsertAccount',
        data: {firstName, lastName, email, password, address, phone },
        dataType: 'json',
        success: res => {
            if(res.check){
                alert("Đăng ký thành công.");
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
function validateEmail(){
    preg_match('/\S+@\S+\.\S+/', addressMail.value, matches);
    if (count(matches) == 0) {
        return false;
    }
    return true;
}

function validatePhoneNumber(){
    preg_match('/^0(\d{9}|9\d{8})$/', phone.value, matches);
    if (count(matches) == 0) {
        return false;
    }
    return true;
}

function validatePass_Repass(){
    if(password.value == confirmPassword.value)
        return true;
    else return false;
}

function validate_FirstName(){
    var regex = /^[^0-9]*$/;
    if (!regex.test(firstName.value) )   {
        document.getElementById("error_firstName").style.display = "block";
        console.log("hai");
    }
    else{
        document.getElementById("error_firstName").style.display = "none";
    console.log("hai");
    } 
    
}
function validate_LastName(){
    tenChuaSo = false;
    if (preg_match( preg_match('/d[0-9]/', lastName.value))) {
        tenChuaSo = true;
        
    }
    else return false;
}
function validate_Address(){
    tenChuaSo = false;
    if (preg_match( preg_match('/^[0-9A-Za-z\s\-/,.ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂƯỨỪễỆỈỊỌỎỐỒỔÔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỔỖỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠỢỤỦỨỪễỆỈỊỌỎỐỒỔỘỚỜỞỠ', address.value))) {
        tenChuaSo = true;
        
    }
    else return false;
}



