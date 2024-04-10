var icon, menuOption, log_out;
$(document).ready(() => {
    log_out = document.querySelector(".log_out");
    menuOption = document.querySelector(".hm-wishlist");
    if(menuOption == null) {
        return;
    }
    const token = sessionStorage.getItem('token');
    if(token == null){
        document.getElementById("avatar").addEventListener('click' ,formLogIn );
        
    }
    else{
        const id = parseInt(token.replace(/"/g, "")) ;
        LoadName(id);
        
    }
    
})
function LoadName(id) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=getUserName',
        data: { id },
        dataType: 'json',
        success: res => {
            
            menuOption.innerHTML += "<ul id='user-menu' >" +
                                        "<li><a >Đơn mua</a></li>" +
                                        "<li><a class='log_out' onClick = 'Log_Out()'>Đăng xuất</a></li>" +
                                    "</ul>"
            icon = document.querySelector('#avatar');
            var name_split = res.user['name'][0].toUpperCase();
            icon.textContent = name_split;


        },
        error: err => {
            console.log(err);
        }
    })
}
function Log_Out(){
    sessionStorage.removeItem('token');
    window.location.href = 'index.php?ctrl=login';
}
function formLogIn() {
    window.location.href = 'index.php?ctrl=login';
}

function changeParamInUrl(param, paramValue, url) {
    if(paramValue !== "") {
        if(url.includes(param)) {
            const arrCurUrlAfterSpliting = url.split("&");
            const newArrCurUrl = arrCurUrlAfterSpliting.map((value) => {
                if(value.includes(`${param}=`)) {
                    const newValue = `${param}=` + paramValue;
                    return newValue;
                }
                return value;
            }).join("&");
            window.location.href = newArrCurUrl;
        } 
        else {
            window.location.href = url + `&${param}=` + paramValue;
        }
    }
}
