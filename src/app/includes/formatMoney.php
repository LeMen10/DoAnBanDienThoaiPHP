<?php 
function format_money($price) {
    $new_price = "";
    $length = strlen($price);
    // Duyệt từ dưới lên trên
    $count = 1;
    for ($i = $length - 1; $i >= 0; $i--) {
        if($count == 3) {
            $new_price = "." . $price[$i] . $new_price;
            $count = 1;
        } else {
            // Thêm số hiện tại vào $new_price
            $new_price = $price[$i] . $new_price;
            $count++;
        }
    }
    // xóa dấu . ở đầu câu và cuối câu
    $new_price = trim($new_price, '.');
    return $new_price;
}