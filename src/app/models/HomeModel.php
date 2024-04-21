<?php
require './app/database/connect.php';

class HomeModel extends connect{

    
        public function GetUser($userID) {
            $query = "SELECT * FROM customer WHERE id = $userID";
            
            $result = mysqli_query($this->con, $query);
            // $check = false;
            $user = null;
            if($result->num_rows){
                $user = mysqli_fetch_array($result);
                
            }
            return $user;
        }

        public function GetSuggestion($stringFind) {
            $query = "SELECT name FROM phone WHERE name LIKE N'%".$stringFind."%'";
            $result = mysqli_query($this->con, $query);
            $suggestions = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row;
            }
            return $suggestions;
        }

        public function getPhones($productsPerPage, $page){
            $begin = ($page * $productsPerPage) - $productsPerPage;
    
            $sql = "SELECT p.`id` as PhoneId, p.`name` as PhoneName, i.`image` as PhoneImage, v.`price` as PhonePrice FROM `phone` p 
                    LEFT JOIN image i ON p.`id` = i.`phoneID` 
                    LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                    LEFT JOIN spec s ON p.`id` = s.`phoneID`
                    GROUP BY p.`id` 
                    LIMIT $begin, $productsPerPage";
                    
            $result = mysqli_query($this->con, $sql);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
}