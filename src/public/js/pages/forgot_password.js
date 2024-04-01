var email;
$(document).ready(() => {
    email = document.getElementById("input_email");
    
    document.getElementById("input_email").addEventListener('change' ,validateEmail );
    

    document.getElementById("bt_sendEmail").addEventListener('click', handle);

    
   
})
function handle() {
    if (email.value === ""  ){
        alert("Vui lòng nhập đầy đủ thông tin.");
        
    }
    else{
        if(!validateEmail() ){
            return;
            
        }
        else{
            CheckExistEmail(email.value);
        
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
            if(res.check){
                alert("Người dùng đã tồn tại!");
                
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
    console.log(xhttp.setRequestHeader)
    xhttp.send("email=" + email);

}
