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
}