<?php
require './app/database/connect.php';

class AccountModel extends connect{

    
        public function CheckLogin($email, $password) {
            $query = "SELECT customer.* , author.name AS authorName FROM customer, author WHERE email = '$email' AND password = '$password' AND customer.author = author.ID";
            
            $result = mysqli_query($this->con, $query);
            // $check = false;
            $user = null;
            if($result->num_rows){
                $user = mysqli_fetch_array($result);
                
            }
            return $user;
        }


    public function Register($firstName, $lastName, $email, $password){
        $fullName = $firstName.' '.$lastName;
        $sql = "INSERT INTO `customer`(`name`,`email`, `password`) VALUES ('$fullName','$email','$password')";
        $check = true;
        $result = mysqli_query($this->con, $sql);
      
        return $result;
    }

    public function CheckRegister($email) {
        $query = "SELECT * FROM customer WHERE email = '$email'";
        $result = mysqli_query($this->con, $query);
        $check = false;
        if ($row = mysqli_fetch_assoc($result)) {
            $check = true;
        }
        return $check;
    }

    // function validateEmail($email){
    //     preg_match('/\S+@\S+\.\S+/', $email, $matches);
    //     if (count($matches) == 0) {
    //         return false;
    //     }
    //     return true;
    // }

    // function validatePhoneNumber($sdt){
    //     preg_match('/^0(\d{9}|9\d{8})$/', $sdt, $matches);
    //     if (count($matches) == 0) {
    //         return false;
    //     }
    //     return true;
    // }

    // function validatePass_Repass($pass, $repass){
    //     if($pass == $repass)
    //         return true;
    //     else return false;
    // }

    // function validate_Name($firstName, $lastName){
    //     $tenChuaSo = false;
    //     if (preg_match('/d[0-9]/', $firstName)  || preg_match('/d[0-9]/', $lastName)) {
    //         $tenChuaSo = true;
    //     }
    //     else return false;
    // }
    function LoadAllCustomer($email,$password) {
        $query = "SELECT * FORM 'customer' WHERE 'email' = $email AND 'password' = $password";
        $result = mysqli_query($this->con, $query);
        $acc = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $acc = $row;
        }
        return $acc;

    }
}



