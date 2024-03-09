<?php

require './app/database/connect.php';

class CartModel extends connect
{
    public function getCart()
    {
        $sql =
            'SELECT p.name, v.price, c.quantity, c.id, i.image FROM cart c ' .
            'JOIN variant v ON c.phoneID = v.phoneID ' .
            'JOIN image i ON c.phoneID = i.phoneID ' .
            'JOIN phone p ON c.phoneID = p.id WHERE c.customerID = 1 GROUP BY c.id;';
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function checkStock($id)
    {
        $check_stock =
            'SELECT v.quantity FROM phone p ' .
            'JOIN cart c ON c.phoneID = p.id ' .
            'JOIN variant v ON p.id = v.phoneID ' .
            'WHERE c.id = ' .
            $id .
            ' GROUP BY c.id;';

        $rs = mysqli_query($this->con, $check_stock);
        // $row = mysqli_fetch_assoc($rs);

        // if ($row) return $row;
        // else return 404;

        $rows = [];
        while ($row = mysqli_fetch_assoc($rs)) {
            $rows[] = $row;
        }
        return $rows;
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
}
