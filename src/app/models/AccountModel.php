<?php
include_once './app/database/connect.php';
class AccountModel extends connect
{
    public function CheckLogin($email)
    {
        $query = "SELECT c.id, c.name, c.email, c.visible, c.password, 
        author.name AS authorName, author.ID AS authorID
        FROM customer c, author 
        WHERE email = '$email' AND c.author = author.ID";

        $result = mysqli_query($this->con, $query);
        // $check = false;
        $user = null;
        if ($result->num_rows) {
            $user = mysqli_fetch_array($result);
        }
        return $user;
    }

    public function login($user)
    {
        $payload = $user;
        $key = 'VDaZW4QaV6rjAnPlK5RZTO63zLeslqkI2FiEGeCP77I=';
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $header = json_encode($header);
        $header = base64_encode($header);

        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        $signature = hash_hmac('sha256', $header . '.' . $payload, $key, true);
        $signature = base64_encode($signature);

        $jwt = $header . '.' . $payload . '.' . $signature;

        return $jwt;
    }

    public function Register($firstName, $lastName, $email, $password)
    {
        $hashed_password = md5($password);
        $fullName = $firstName . ' ' . $lastName;
        $sql = "INSERT INTO `customer`(`name`,`email`, `password`) VALUES ('$fullName','$email','$hashed_password')";
        $check = true;
        $result = mysqli_query($this->con, $sql);

        return $result;
    }

    public function CheckRegister($email)
    {
        $query = "SELECT * FROM customer WHERE email = '$email'";
        $result = mysqli_query($this->con, $query);
        $check = false;
        if ($row = mysqli_fetch_assoc($result)) {
            $check = true;
        }
        return $check;
    }

    function LoadAllCustomer($email, $password)
    {
        $query = "SELECT * FORM 'customer' WHERE 'email' = $email AND 'password' = $password";
        $result = mysqli_query($this->con, $query);
        $acc = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $acc = $row;
        }
        return $acc;
    }

    public function checkPassword($passworddb, $password){
        $hashPassword = md5($password);
        if($hashPassword === $passworddb) return true;
        return false;
    }
}
