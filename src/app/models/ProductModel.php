<?php

require './app/database/connect.php';

class ProductModel extends connect {
    public function getAll(){
        $sql = "SELECT * FROM phone";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getVariantOfTrashProductByIdVariant($id){
        $sql = "SELECT * FROM variant WHERE `visible` = 0 and `id` = ".$id."";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function restoreVariantOfTrashProduct($id) {
        $sql = "UPDATE `variant` SET `visible`= 1 WHERE id = ".$id."";
        $result = mysqli_query($this->con, $sql);
        
        if ($result && mysqli_affected_rows($this->con) > 0) {
            return true; 
        } else {
            return false; 
        }
    }
    
    public function getTrashProductPerPage($page, $query){
        $begin = ($page * 5) - 5;
        $sql = "
            SELECT c.name as category, p.id as id, p.name, price, image, v.size as size, cl.color as color, v.id as variantID
            FROM phone p 
            LEFT JOIN category c ON p.category = c.id 
            LEFT JOIN variant v ON p.id = v.phoneID 
            LEFT JOIN color cl ON p.id = cl.phoneID 
            LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
            WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 0 AND p.name LIKE '%".$query."%'
            LIMIT ".$begin.",5
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllTrashProduct($query){
        $sql = "
            SELECT v.id AS variantid, v.quantity AS quantity, p.name AS phonename, c.name AS category, cl.color, v.price, v.size, img.image
            FROM phone p 
            LEFT JOIN category c ON p.category = c.id 
            LEFT JOIN variant v ON p.id = v.phoneID 
            LEFT JOIN color cl ON p.id = cl.phoneID 
            LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
            WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 0 AND p.name LIKE '%".$query."%'
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getAllPhoneAndDetails($brand = "", $weight = "", $search = "") {
        // nếu có brand
        if($brand != "") {
            // nếu có hơn 1 value trong brand
            if(strstr($brand, " ")) {
                $arrayValueBrand = explode(" ", $brand);

                $query_brand = "LEFT JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "LEFT JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : "";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $sql = "SELECT * FROM `phone` p 
                LEFT JOIN image i ON p.`id` = i.`phoneID` 
                LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                LEFT JOIN spec s ON p.`id` = s.`phoneID`
                ". $query_brand ."
                ".$query_weight."
                ".($search != "" ? ("WHERE p.`name` LIKE N'%".$search."%'"): "")."
                GROUP BY p.`id`";

        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getPhonesByPageNumber($productsPerPage, $page, $sort, $brand, $weight = "", $search = ""){
        // nếu có brand
        if($brand != "") {
            // nếu có hơn 1 value trong brand
            if(strstr($brand, " ")) {
                $arrayValueBrand = explode(" ", $brand);

                $query_brand = "LEFT JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "LEFT JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : " ";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $begin = ($page * 6) - 6;

        $sql = "SELECT p.`id` as PhoneId, p.`name` as PhoneName, i.`image` as PhoneImage, v.`price` as PhonePrice FROM `phone` p 
                LEFT JOIN image i ON p.`id` = i.`phoneID` 
                LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                LEFT JOIN spec s ON p.`id` = s.`phoneID`
                ". $query_brand ."
                ".$query_weight."
                ".($search != "" ? ("WHERE p.`name` LIKE N'%".$search."%'"): "")."
                GROUP BY p.`id` 
                ".$sort."
                LIMIT $begin, $productsPerPage";
                
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllCategoriesAndCountByPhoneID(){
        $sql = "SELECT c.name AS name, COUNT(p.id) as count FROM category c, phone p WHERE c.id = p.category GROUP BY c.id";
        
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getPhoneWeightByWeightAndCountByPhoneID($query_weight){
        $sql = "
            SELECT SUM(count) AS total_count
            FROM (
                SELECT s.bodyWeight AS bodyWeight, COUNT(p.id) AS count
                FROM spec s
                JOIN phone p ON s.phoneID = p.id
                ". $query_weight ."
                GROUP BY s.bodyWeight
            ) AS weight_counts;
        ";

        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            die("Query error: " . mysqli_error($this->con));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['total_count'] ?? 0; 
    }
}
