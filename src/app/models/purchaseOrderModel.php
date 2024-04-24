<?php
include_once './app/database/connect.php';
class PurchaseOrderModel extends Connect{
    public function getOrdersByUserIDAndPage($userID, $Status, $pageIndex, $itemsPerPage, $sortDate = ""){
        $sql = "SELECT * FROM `order` 
        WHERE ".($Status == "All"? "": "orderStatus = '".$Status."' AND ")." 
        customerID = $userID ".($sortDate == ""? "" : "ORDER BY date DESC ").
        "LIMIT ".(($pageIndex -1) * $itemsPerPage).", $itemsPerPage";
        $result = mysqli_query($this->con, $sql);
        $orderIDList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orderIDList[] = $row;
        }
        return $orderIDList;
    }
    public function getOrdersByUserID($userID, $Status, $sortDate = ""){
        $sql = "SELECT * FROM `order` 
        WHERE ".($Status == "All"? "": "orderStatus = '".$Status."' AND ")." 
        customerID = $userID ".($sortDate == ""? "" : "ORDER BY date $sortDate ");
        $result = mysqli_query($this->con, $sql);
        $orderIDList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orderIDList[] = $row;
        }
        return $orderIDList;
    }
    public function getListOrderProduct($orderID){
        $sql = "SELECT p.name, od.quantity, od.price, i.image, c.color, v.size
        FROM `orderdetail` od
        JOIN `variant` v ON v.id = od.variantID
        JOIN `phone` p ON p.id = v.phoneID
        JOIN `image` i ON i.phoneID = v.phoneID 
        JOIN `color` c ON c.colorID = v.colorID
        WHERE od.orderID = $orderID AND i.colorID = v.colorID AND c.phoneID = v.phoneID
        GROUP BY v.id";
        $result = mysqli_query($this->con, $sql);
        $orderDetailList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orderDetailList [] = $row;
        }
        return $orderDetailList;
    }
    public function getCustomerInfoByOrderID($orderID)
    {
        $sql = "SELECT a.recipientName, a.recipientPhone, a.detail, o.customerID, o.date, o.totalPayment,
        o.orderStatus, o.id AS `orderID`, p.name AS Province, a.provinceID, d.name AS District,
        a.districtID, w.name AS Wards, a.wardsID
        FROM `address` a
        JOIN `order` o ON a.id = o.addressID
        JOIN `district` d ON a.districtID = d.id
        JOIN `province` p ON p.id = a.provinceID
        JOIN `wards` w ON w.id = a.wardsID
        WHERE o.id = $orderID";
        $result = mysqli_query($this->con, $sql);
        $orderDetail = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $orderDetail = $row;
        }
        return $orderDetail;
    }
    public function getOrderDetailByID($orderID)
    {
        $sql = "SELECT * FROM `order` WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $orderID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $orderDetail = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $orderDetail;
    }
    public function cancelOrder($orderID)
    {
        $sql = "UPDATE `order` SET `orderStatus`='Canceled' WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $orderID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    public function getAllProvince(){
        $sql = "SELECT * FROM province ORDER BY name ASC";
        $result = mysqli_query($this->con, $sql);
        $listProvince = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $listProvince [] = $row;
        }
        return $listProvince;
    }
    public function getAllDistrict($provinceID){
        $sql = "SELECT * FROM district WHERE provinceID = $provinceID ORDER BY name ASC";
        $result = mysqli_query($this->con, $sql);
        $listDistrict = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $listDistrict [] = $row;
        }
        return $listDistrict;
    }
    public function getAllWards($districtID){
        $sql = "SELECT * FROM wards WHERE districtID = $districtID ORDER BY name ASC";
        $result = mysqli_query($this->con, $sql);
        $listWards = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $listWards [] = $row;
        }
        return $listWards;
    }
    public function saveAddress($userID,$Name, $Phone, $P, $D, $W, $Detail)
    {
        $sql = "INSERT INTO `address`(`customerID`, `provinceID`, `districtID`, `detail`, `recipientName`, `wardsID`, `recipientPhone`)
        VALUES ($userID,$P,$D,'$Detail','$Name',$W,'$Phone')";
        mysqli_query($this->con, $sql);
        $insertedId = mysqli_insert_id($this->con);
        return $insertedId;
    }
    public function changeAddressOrder($orderID, $addressID)
    {
        $sql = "UPDATE `order` SET `addressID`= $addressID WHERE `id`=$orderID";
        mysqli_query($this->con, $sql);
    }
}