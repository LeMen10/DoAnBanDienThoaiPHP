<?php
include_once './app/database/connect.php';
class CartModel extends connect
{
    public function getCart($id)
    {
        $sql =
            'SELECT p.name, v.price, c.quantity, c.id, i.image FROM cart c ' .
            'JOIN variant v ON c.variantID = v.id ' .
            'JOIN image i ON v.phoneID = i.phoneID ' .
            'JOIN phone p ON v.phoneID = p.id WHERE c.customerID = ' .
            $id .
            ' AND i.colorID = v.colorID GROUP BY c.id;';
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function checkStock($variantID)
    {
        $check_stock = "SELECT v.quantity FROM variant v WHERE v.id = '$variantID'";

        $rs = mysqli_query($this->con, $check_stock);
        $stock = null;
        if ($rs->num_rows) {
            $stock = mysqli_fetch_array($rs);
        }
        return $stock;
    }

    public function updateQuantity($id, $quantity)
    {
        $sql = 'UPDATE cart c SET c.quantity = ' . $quantity . ' WHERE c.id = ' . $id;
        mysqli_query($this->con, $sql);
    }

    public function removeItem($id)
    {
        $sql = 'DELETE FROM cart WHERE id = ' . $id;
        mysqli_query($this->con, $sql);
    }

    public function getVariantID($id)
    {
        $sql = 'SELECT c.variantID FROM cart c WHERE c.id = ' . $id;
        $rs = mysqli_query($this->con, $sql);
        $variantID = mysqli_fetch_assoc($rs);
        return $variantID;
    }

    public function getCountItemCart($customerID)
    {
        $sql = 'SELECT COUNT(*) as count FROM cart WHERE customerID = ' . $customerID;
        $rs = mysqli_query($this->con, $sql);
        $count = mysqli_fetch_assoc($rs);
        return $count;
    }
}
