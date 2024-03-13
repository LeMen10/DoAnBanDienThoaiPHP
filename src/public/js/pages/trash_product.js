function restoreProduct(productId) {
    $.ajax({
        url: 'index.php?ctrl=trash_product&act=restore_product',
        type: 'POST',
        data: { id: productId},
        success: function(response){
            alert('Khôi phục điện thoại thành công!');
            location.reload(); // Tải lại trang để cập nhật danh sách điện thoại
        },
        error: function(xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}