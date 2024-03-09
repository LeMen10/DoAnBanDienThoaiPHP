<?php

require './app/database/connect.php';

class ProductModel extends connect
{
    public function getAll(){
        $sql = "SELECT * FROM phone";
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

                $query_brand = "JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : "";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $sql = "SELECT * FROM `phone` p 
                JOIN image i ON p.`id` = i.`phoneID` 
                JOIN variant v ON p.`id` = v.`phoneID` 
                JOIN spec s ON p.`id` = s.`phoneID`
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

                $query_brand = "JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : " ";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $begin = ($page * 6) - 6;

        $sql = "SELECT p.`id` as PhoneId, p.`name` as PhoneName, i.`image` as PhoneImage, v.`price` as PhonePrice FROM `phone` p 
                JOIN image i ON p.`id` = i.`phoneID` 
                JOIN variant v ON p.`id` = v.`phoneID` 
                JOIN spec s ON p.`id` = s.`phoneID`
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
        $sql = "SELECT s.bodyWeight AS bodyWeight, COUNT(p.id) as count FROM spec s, phone p ". $query_weight ." AND s.phoneID = p.id GROUP BY s.bodyWeight";
        
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}
