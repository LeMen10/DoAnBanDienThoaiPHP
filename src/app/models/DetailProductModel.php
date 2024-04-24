<?php
include_once './app/database/connect.php';
class DetailProductModel extends Connect{

    public function getProductDetail($phoneID){
        $sql = "SELECT p.name AS phonename, p.date, p.detail, s.*, c.name AS categoryname
        FROM phone p JOIN spec s ON p.id = s.phoneID JOIN category c ON p.category = c.id
        WHERE p.id = $phoneID AND p.visible = 1";
        $result = mysqli_query($this->con, $sql);
        $productDetail = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $productDetail = $row;
        }
        return $productDetail;
    }
    public function getAllProductVariants($phoneID){
        $sql = "SELECT sizeID, size, price, quantity FROM variant WHERE phoneID = $phoneID GROUP BY sizeID";
        $result = mysqli_query($this->con, $sql);
        $Variants = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $Variants[] = $row;
        }
        return $Variants;
    }
    public function getVariant($phoneID, $sizeID, $colorID)
    {
        $sql = "SELECT * FROM variant v
        WHERE v.phoneID = $phoneID AND v.sizeID = $sizeID AND v.colorID = $colorID";
        $result = mysqli_query($this->con, $sql);
        $Variant = [];
        if($row = mysqli_fetch_assoc($result)) {
            $Variant = $row;     
        }
        return $Variant;
    }
    public function getAllColorSize($phoneID, $sizeID){
        $sql = "SELECT c.colorID, c.color FROM variant v JOIN phone p ON v.phoneID = p.id
                    JOIN color c ON c.phoneID = p.id 
                        WHERE c.colorID = v.colorID AND v.sizeID = $sizeID AND p.id = $phoneID";
        $result = mysqli_query($this->con, $sql);
        $colorOptions = [];
        while ($row = mysqli_fetch_assoc($result)) {
           $colorOptions[] = $row;
        }
        return $colorOptions;
    }
    public function getAllImage($phoneID)
    {
        $sql = "SELECT * FROM image WHERE image.phoneID = $phoneID";
        $result = mysqli_query($this->con, $sql);
        $Images = [];
        while ($row = mysqli_fetch_assoc($result)) {
           $Images[] = $row;
        }
        return $Images;
    }

    public function addToCart($variantID, $Quantity, $userID)
    {
        $sql = 'INSERT INTO `cart`( `variantID`, `quantity`, `customerID`) VALUES ('.$variantID.', '.$Quantity.', '.$userID.') ';
        mysqli_query($this->con, $sql);
        $cartID = mysqli_insert_id($this->con);
        return $cartID;
    }
    public function getTotalCart($userID)
    {
        $sql = 'SELECT c.quantity, v.price FROM cart c JOIN variant v ON c.variantID = v.id 
        WHERE c.customerID = '.$userID;
        $result = mysqli_query($this->con, $sql);
        $totalValue =  array(
            'price' => 0, 
            'count' => 0   
        );
        while ($row = mysqli_fetch_assoc($result)) {
           $totalValue['price'] += $row['price'];
           $totalValue['quantity'] += $row['quantity'];
        }
        return $totalValue;
    }
}