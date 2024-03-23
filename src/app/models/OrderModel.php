<?php
require './app/database/connect.php';

class OrderModel extends connect{
    public function GetAllOrder() {
        $query = "SELECT o.id, c.name, o.totalPayment, o.date , o.orderStatus 
        FROM `customer` c, `order` o WHERE c.id = o.customerID";
        $result = mysqli_query($this->con, $query);
        $order = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
        return $order;
    }
    public function GetQuantityOrder() {
        $query = "SELECT COUNT(o.id) AS quantity
        FROM `customer` c, `order` o WHERE c.id = o.customerID";
        $result = mysqli_query($this->con, $query);
        $quantity = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $quantity = $row['quantity'];
        }
        return $quantity;
    }
    public function GetAllOrderByPage($page) {
        $begin = ($page * 3) - 3;
        $query = "SELECT o.id, c.name, o.totalPayment, o.date , o.orderStatus 
        FROM `customer` c, `order` o WHERE c.id = o.customerID
        LIMIT $begin, 3;";
        $result = mysqli_query($this->con, $query);
        $order = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
        return $order;
    }
    public function GetDetailOrderProduct($id) {
        $query = "SELECT c.name as nameCustomer, o.address, c.phoneNumber, i.image, p.name as namePhone, o.totalPayment, od.quantity 
        FROM `customer` c JOIN `order` o  on c.id = o.customerID 
        JOIN `orderdetail` od on o.id = od.orderID
        JOIN `variant` v on od.variantID = v.id
        JOIN `phone` p on v.phoneID = p.id 
        JOIN `image` i on p.id = i.phoneID 
        WHERE od.orderID = $id AND v.colorID = i.colorID
        GROUP BY v.id";
        $result = mysqli_query($this->con, $query);
        $order_detail = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order_detail[] = $row;
        }
        return $order_detail;
    }
    function UpdateStatus($id, $status) {
        $sql = "UPDATE `order` SET `orderStatus` = '$status' WHERE `id` = $id";
        $result = mysqli_query($this->con, $sql);
        return $result;
        
    }
    function SortByDate(){
        $sql = "SELECT * FROM `order` ORDER BY `date`";
        $result = mysqli_query($this->con, $sql);
        $pro = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pro[] = $row;
        }
        return $pro;
    }

    function Search($ten){
        $sql = "SELECT c.name as nameCustomer, o.id, o.date, o.orderStatus, o.address, c.phoneNumber, i.image, p.name as namePhone, o.totalPayment, od.quantity 
        FROM `customer` c JOIN `order` o  on c.id = o.customerID 
        JOIN `orderdetail` od on o.id = od.orderID
        JOIN `variant` v on od.variantID = v.id
        JOIN `phone` p on v.phoneID = p.id 
        JOIN `image` i on p.id = i.phoneID 
        WHERE c.name LIKE '%$ten%' AND v.colorID = i.colorID
        GROUP BY v.id ";
        $result = mysqli_query($this->con, $sql);
        $arr_search = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $arr_search[] = $row;
        }
        return $arr_search;
    }


}