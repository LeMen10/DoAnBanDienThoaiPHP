<?php
require './app/database/connect.php';

class AccountModel extends connect{
    public function CheckLogin($email, $password) {
        $query = "SELECT * FROM 'customer' WHERE 'email' = '$email' AND 'password' = '$password'";
        $check = true;
        $result = mysqli_query($this->con, $query);
        if (!$result) {
            $check = false;
        }
        return $check;
    }


    public function Register($firstName, $lastName, $email, $password, $address, $phoneNumber){
        $fullName = $firstName.' '.$lastName;
        $sql = "INSERT INTO `customer`(`name`,`email`, `password`,`address`,`phoneNumber`) VALUES ('$fullName','$email','$password','$address','$password')";
        $check = true;
        $result = mysqli_query($this->con, $sql);
      
        return $result;
    }

    public function CheckRegister($email) {
        $query = "SELECT * FROM customer WHERE email = '$email' ";
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



