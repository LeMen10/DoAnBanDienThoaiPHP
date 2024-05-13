<?php
include_once './app/database/connect.php';
class CheckoutModel extends connect
{
<<<<<<< Updated upstream
    public function getCheckout($data, $customerID, $orderID = 0)
    {
        $sql = "";
        if($orderID == 0)
        {
            $temp = explode(',', $data);
            $resultString = '(' . implode(', ', $temp) . ')';
            $sql =
                'SELECT p.name, v.price, c.quantity, c.id, i.image, v.id as variantID FROM cart c ' .
                'JOIN variant v ON c.variantID = v.id ' .
                'JOIN image i ON v.phoneID = i.phoneID ' .
                'JOIN phone p ON v.phoneID = p.id WHERE i.colorID = v.colorID AND c.customerID = ' .
                $customerID .
                ' AND c.id IN ' .
                $resultString .
                ' GROUP BY c.id;';
        }
        else
        {
            $sql = 'SELECT p.name, v.price, o.quantity, i.image, v.id as variantID 
                FROM orderdetail o JOIN variant v ON o.variantID = v.id 
                JOIN image i ON v.phoneID = i.phoneID 
                JOIN phone p ON v.phoneID = p.id 
                WHERE o.orderID = '.$orderID.' GROUP BY v.id';
        }
=======
    public function getCheckout($dataProductID, $customerID)
    {
        $temp = explode(',', $dataProductID);
        $resultString = '(' . implode(', ', $temp) . ')';
        $sql =
            'SELECT p.name, v.price, c.quantity, c.id, i.image, v.id as variantID FROM cart c ' .
            'JOIN variant v ON c.variantID = v.id ' .
            'JOIN image i ON v.phoneID = i.phoneID ' .
            'JOIN phone p ON v.phoneID = p.id WHERE i.colorID = v.colorID AND c.customerID = ' .
            $customerID .
            ' AND c.id IN ' .
            $resultString .
            ' GROUP BY c.id;';
>>>>>>> Stashed changes
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAddress($customerID)
    {
        $sql =
            'SELECT p.name as province, d.name as district, w.name as wards, ' .
            'a.detail, a.recipientName, a.customerID, a.id, a.active, a.recipientPhone FROM address a ' .
            'JOIN customer c ON a.customerID = c.id ' .
            'JOIN province p ON a.provinceID = p.id ' .
            'JOIN district d ON a.districtID = d.id ' .
            'JOIN wards w ON a.wardsID = w.id ' .
            'WHERE a.customerID = '. $customerID .' AND a.visible = 1';
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getActiveAddress($customerID)
    {
        $sql =
            'SELECT p.name as province, d.name as district, w.name as wards, ' .
            'a.detail, a.recipientName, a.customerID, a.id, a.recipientPhone FROM address a ' .
            'JOIN customer c ON a.customerID = c.id ' .
            'JOIN province p ON a.provinceID = p.id ' .
            'JOIN district d ON a.districtID = d.id ' .
            'JOIN wards w ON a.wardsID = w.id ' .
            'WHERE a.customerID = ' .
            $customerID .
            ' AND a.active = 1';
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function saveAddress( $customerID, $provinceID, $districtID, $wardsID, $recipientName, $recipientPhone, $detail, $active)
    {
        $sql =
            'INSERT INTO `address`(`customerID`, `provinceID`, `districtID`, `detail`, `recipientName`, `recipientPhone`, `wardsID`, `active`) ' .
            "VALUES ( '$customerID', '$provinceID', '$districtID', '$detail', '$recipientName', '$recipientPhone', '$wardsID', '$active' )";
        mysqli_query($this->con, $sql);
    }

    public function updateAddress($id, $provinceID, $districtID, $wardsID, $recipientName, $recipientPhone, $detail)
    {
        $sql =
            "UPDATE `address` SET provinceID = '$provinceID', districtID = '$districtID', wardsID = '$wardsID', " .
            "recipientName = '$recipientName', recipientPhone = '$recipientPhone', detail = '$detail' " .
            "WHERE id = '$id'";
        mysqli_query($this->con, $sql);
    }

    public function getAddressEditing($id)
    {
        $sql =
            'SELECT a.provinceID, a.districtID, a.wardsID, ' .
            'a.detail, a.recipientName, a.customerID, a.recipientPhone, a.id FROM address a ' .
            'JOIN customer c ON a.customerID = c.id ' .
            'WHERE a.id = ' .
            $id;
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProvince()
    {
        $sql = 'SELECT * FROM province';
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getDistrict($id)
    {
        $sql = 'SELECT * FROM district WHERE provinceID = ' . $id;
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getWards($id)
    {
        $sql = 'SELECT * FROM wards WHERE districtID = ' . $id;
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function changeActiveAddress($addressID, $userID)
    {
        $deleteActive = "UPDATE `address` SET active = 0 WHERE customerID = '$userID'";
        $updateActive = "UPDATE `address` SET active = 1 WHERE customerID = '$userID' AND id = '$addressID'";
        mysqli_query($this->con, $deleteActive);
        mysqli_query($this->con, $updateActive);
        return true;
    }

    public function saveOrder($addressID, $totalPayment, $orderStatus, $customerID)
    {
        $sql =
            'INSERT INTO `order`(`addressID`, `totalPayment`, `orderStatus`, `customerID`) ' .
            "VALUES ( '$addressID', '$totalPayment', '$orderStatus', '$customerID' )";
        mysqli_query($this->con, $sql);
        $orderID = mysqli_insert_id($this->con);
        return $orderID;
    }

    public function saveOrderDetail($dataID, $orderID)
    {
        $sql = 'INSERT INTO orderDetail (orderID, variantID, quantity, price) VALUES ';
        foreach ($dataID as $row) {
            $variantID = $row['variantID'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $sql .= "( $orderID, $variantID, $quantity, $price),";
        }
        $sql = rtrim($sql, ',');
        mysqli_query($this->con, $sql);
    }
}
