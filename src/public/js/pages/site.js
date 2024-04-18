var searchBox, suggestionBox;
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
    searchBox = document.getElementById("searchInput");
    suggestionBox = document.getElementById("suggestionBox");
    document.querySelector('.li-btn').addEventListener("click", function (event) {
        navigateShopPage(event);
    });
    searchBox.addEventListener("input", function () {
        var inputValue = searchBox.value.trim();
        if (inputValue === "") {
            suggestionBox.innerHTML = "";
            return;
        }
        loadSuggestion();
    });
    searchBox.addEventListener('keydown', function (event) {
    navigateShopPage(event);
    });
})
function LoadName(id) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=getUserName',
        data: { id },
        dataType: 'json',
        success: res => {     
            menuOption.innerHTML += "<ul id='user-menu' >" +
                                        "<li><a href='index.php?ctrl=purchase_order&userID="+id+"'>Đơn mua</a></li>" +
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
function navigateShopPage(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        var inputValue = searchBox.value.trim();
        if (inputValue != "") {
            window.location.href = "index.php?ctrl=shop&search=" + searchBox.value;
        }
    }
}
function loadSuggestion() {
    stringFind = searchBox.value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=GetSuggestion',
        data: { stringFind },
        dataType: 'json',
        success: res => {
            suggestionBox.innerHTML = "";
            res.suggest.forEach(item => {
                var suggestionItem = document.createElement('div');
                suggestionItem.textContent = item['name'];
                suggestionItem.addEventListener('click', function () {
                    searchBox.value = suggestionItem.textContent;
                    suggestionBox.innerHTML = "";
                    searchBox.focus();
                });
                suggestionBox.appendChild(suggestionItem);
            });
        },
        error: err => {
            console.log(err);
        }

    })
}