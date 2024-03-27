var icon;
$(document).ready(() => {
    icon = document.querySelector('#avatar');
    const id = parseInt(sessionStorage.getItem('token').replace(/"/g,""));
    
    LoadName(id);
})
function LoadName(id){
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=getUserName',
        data: { id },
        dataType: 'json',
        success: res => {
            var name_split = res.user['name'][0].toUpperCase();
            icon.innerHTML = name_split;
            
        },
        error: err => {
            console.log(err);
        }

    })
    
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
