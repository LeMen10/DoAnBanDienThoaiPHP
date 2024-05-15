<?php
include_once './app/database/connect.php';

class ReceiptModel extends Connect
{
    public function getPhoneNameByCategory($categoryid)
    {
        $sql = "SELECT id, `name` FROM `phone` WHERE  category = $categoryid";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getSizeByPhoneID($phoneid)
    {
        $sql = "SELECT sizeID, `size` FROM variant WHERE phoneID = $phoneid GROUP BY sizeID";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getColorByColorID($sizeid, $phoneid)
    {
        $sql = "SELECT c.colorID, c.color FROM variant v JOIN phone p ON v.phoneID = p.id
            JOIN color c ON c.phoneID = p.id 
            WHERE c.colorID = v.colorID AND v.sizeID = $sizeid AND p.id = $phoneid AND v.visible = 1";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getAllSupplier(){
        $sql = "SELECT `id`, `name` FROM `supplier`";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function insertReceipt($supplierID, $employeeID){
        $sql = "INSERT INTO `receipt`(`supplierID`, `employeeID`, `date`) 
        VALUES ($supplierID,$employeeID,CURRENT_DATE)";
        $result = mysqli_query($this->con, $sql);
        if($result) {
            // Nếu truy vấn INSERT thành công, lấy ID của hàng mới được thêm vào
            $last_insert_id = mysqli_insert_id($this->con);
            return $last_insert_id;
        } else {
            // Trả về false nếu truy vấn không thành công
            return false;
        }
    }
    public function getVariant($phoneID, $sizeID, $colorID)
    {
        $sql = "SELECT v.id FROM variant v
        WHERE v.phoneID = $phoneID AND v.sizeID = $sizeID AND v.colorID = $colorID";
         $result = mysqli_query($this->con, $sql);
         if($row = mysqli_fetch_assoc($result)) {
             // Trả về giá trị ID của biến thể được tìm thấy
             return $row['id'];
         } else {
             // Trường hợp không tìm thấy biến thể, có thể trả về một giá trị mặc định hoặc thông báo lỗi
             return null;
         }
    }
    public function InsertorUpdateReceiptDetail($receiptID, $variantID, $quantity, $price)
    {
        $sql = "SELECT * FROM `receipt` r JOIN receiptdetail rd ON r.id = rd.receiptID 
        WHERE rd.variantID = $variantID AND r.id = $receiptID";
        $result = mysqli_query($this->con, $sql);
        if(($result && mysqli_num_rows($result) > 0)){
            $sql = "UPDATE `receiptdetail` SET `quantity`= $quantity,`price`= $price 
            WHERE receiptID = $receiptID AND variantID =$variantID";
        }else{
            $sql = "INSERT INTO `receiptdetail`( `receiptID`,`variantID`, `quantity`, `price`) 
            VALUES ($receiptID,$variantID,$quantity,$price)";
        }
        $result = mysqli_query($this->con, $sql);
        if($result) {
            // Nếu truy vấn INSERT thành công, trả về true hoặc một giá trị khác để biểu thị sự thành công
            return true;
        } else {
            // Nếu truy vấn không thành công, có thể xử lý lỗi ở đây hoặc trả về false
            return false;
        }
    }
    public function GetAllProductInReceipt($receiptID){
        $sql = "SELECT v.id, p.name, v.size, c.color, rd.price, rd.quantity
        FROM `receiptdetail` rd 
        JOIN variant v ON rd.variantID = v.id 
        JOIN phone p ON p.id = v.phoneID 
        JOIN color c ON c.id = v.colorID 
        JOIN receipt r ON r.id = rd.receiptID 
        WHERE r.id = $receiptID";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function DeleteProductInReceipt($variantID,$receiptID){
        $sql = "DELETE FROM `receiptdetail` WHERE receiptID = $receiptID AND variantID = $variantID";
        $result = mysqli_query($this->con, $sql);
         if($result) {
            // Nếu truy vấn INSERT thành công, trả về true hoặc một giá trị khác để biểu thị sự thành công
            return true;
        } else {
            // Nếu truy vấn không thành công, có thể xử lý lỗi ở đây hoặc trả về false
            return false;
        }
    }
    public function UpdateVariantByReceiptDetail($variantID,$price, $quantity){
        $sql = "UPDATE `variant` SET `price`=$price,`quantity`=$quantity WHERE id = $variantID";
        $result = mysqli_query($this->con, $sql);
         if($result) {
            // Nếu truy vấn INSERT thành công, trả về true hoặc một giá trị khác để biểu thị sự thành công
            return true;
        } else {
            // Nếu truy vấn không thành công, có thể xử lý lỗi ở đây hoặc trả về false
            return false;
        }
    }
    public function GetOneVariant($variantID){
        $sql = "SELECT `price`, `quantity` FROM `variant` WHERE id = $variantID";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function checkReceiptDetail($receiptID){
        $sql = "SELECT * FROM `receiptdetail` WHERE receiptID = $receiptID;";
        $result = mysqli_query($this->con, $sql);
         if(($result && mysqli_num_rows($result) > 0)) {
            // Nếu truy vấn INSERT thành công, trả về true hoặc một giá trị khác để biểu thị sự thành công
            return true;
        } else {
            // Nếu truy vấn không thành công, có thể xử lý lỗi ở đây hoặc trả về false
            return false;
        }
    }
}