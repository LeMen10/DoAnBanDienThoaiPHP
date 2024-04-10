var iconAdmin;
$(document).ready(() => {
    // iconAdmin = document.getElementById("icon_admin");
    var logOutElement = document.getElementById("log_outAD");
    if(logOutElement == null){
        return;
    }
    const token = sessionStorage.getItem('token');
   
    if(token != null){
        logOutElement.addEventListener('click', Log_Out);
    }
    
})
function Log_Out(){
    sessionStorage.removeItem('token');
    window.location.href = 'index.php?ctrl=login';
    console.log("1");
}