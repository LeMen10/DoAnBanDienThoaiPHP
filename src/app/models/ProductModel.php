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

    public function getTrashProductByID($id){
        $sql = "SELECT * FROM phone WHERE phone.`visible` = 0 and phone.`id` = ".$id."";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function restoreProduct($id) {
        $sql = "UPDATE phone SET `visible` = 1 WHERE `id` = ".$id."";
        $result = mysqli_query($this->con, $sql);
        
        if ($result && mysqli_affected_rows($this->con) > 0) {
            return true; 
        } else {
            return false; 
        }
    }

    public function getTrashProductPerPage($page){
        $begin = ($page * 5) - 5;
        $sql = "
            SELECT p.id as id, name, price, image, category 
            FROM phone p 
            LEFT JOIN image i ON p.id = i.id 
            LEFT JOIN variant v ON p.id = v.id 
            WHERE p.visible = 0
            LIMIT ".$begin.",5
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllTrashProduct(){
        $sql = "
            SELECT p.id 
            FROM phone p 
            LEFT JOIN image i ON p.id = i.id 
            LEFT JOIN variant v ON p.id = v.id 
            WHERE p.visible = 0
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getAllPhoneAndDetails($brand = "", $weight = "") {
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
                GROUP BY p.`id`";

        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getPhonesByPageNumber($productsPerPage, $page, $sort, $brand, $weight = ""){
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
