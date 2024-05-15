const checkRole = () => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=role&act=getRole',
        dataType: 'json',
        success: res => {
            if(res.role == 'customer') window.location.href = 'index.php';
            else window.location.href = 'index.php?ctrl=admin';
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
}