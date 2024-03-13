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
