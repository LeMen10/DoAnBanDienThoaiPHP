<?php
include_once './app/database/connect.php';

class UserModel extends Connect
{
    public function create($id, $email, $fullname, $password, $ngaysinh, $gioitinh, $role, $trangthai)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `nguoidung`(`id`, `email`,`hoten`, `gioitinh`,`ngaysinh`,`matkhau`,`trangthai`, `manhomquyen`) VALUES ('$id','$email','$fullname','$gioitinh','$ngaysinh','$password',$trangthai, $role)";
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }

    public function delete($id)
    {
        $check = true;
        $sql = "DELETE FROM `nguoidung` WHERE `id`='$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }

    public function update($id, $email, $fullname, $password, $ngaysinh, $gioitinh, $role, $trangthai)
    {
        $querypass = '';
        if ($password != '') {
            $passwordd = password_hash($password, PASSWORD_DEFAULT);
            $querypass = ", `matkhau`='$passwordd'";
        }
        $sql = "UPDATE `nguoidung` SET `email`='$email', `hoten`='$fullname',`gioitinh`='$gioitinh',`ngaysinh`='$ngaysinh',`trangthai`='$trangthai',`manhomquyen`='$role' $querypass WHERE `id`='$id'";
        return $sql;
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }

    // Update Profile
    public function updateProfile($fullname, $gioitinh, $ngaysinh, $email, $id)
    {
        $sql = "UPDATE `nguoidung` SET `email` = '$email',`hoten`='$fullname',`gioitinh`='$gioitinh',`ngaysinh`='$ngaysinh'WHERE `id`='$id'";
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }

    // Up avatar
    public function uploadFile($id, $tmpName, $imageExtension, $validImageExtension, $name)
    {
        $check = true;

        if (!in_array($imageExtension, $validImageExtension)) {
            $check = false;
        } else {
            $newImageName = $name . '-' . uniqid(); // Generate new name image
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, './public/media/avatars/' . $newImageName);
            $sql = "UPDATE `nguoidung` SET `avatar`='$newImageName' WHERE `id`='$id'";
            mysqli_query($this->con, $sql);
            $check = true;
        }
        return $check;
    }

    public function getAll()
    {
        $sql = "SELECT nguoidung.*, nhomquyen.`tennhomquyen`
        FROM nguoidung, nhomquyen
        WHERE nguoidung.`manhomquyen` = nhomquyen.`manhomquyen`";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM `nguoidung` WHERE `id` = '$id'";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEmail($email)
    {
        $sql = "SELECT email,otp FROM `nguoidung` WHERE `email` = '$email'";
        $result = mysqli_query($this->con, $sql);
        if ($result) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }

    public function getAllCustomerDeleted(){
        $sql = "SELECT COUNT(*) AS count FROM customer c WHERE c.visible = 0";
        $result = mysqli_query($this->con, $sql);
        $Count = 0;
        if ($row = mysqli_fetch_assoc($result)) {
            $Count = $row["count"];
        }
        return $Count;
    }
    public function getAllCustomerDeletedPerPage($page){
        $begin = ($page * 5) - 5;
        $sql = "SELECT c.* FROM customer c WHERE c.visible = 0 LIMIT $begin, 6";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function restore_customer($id){
        $sql = 'UPDATE customer SET visible = 1 WHERE id = ' . $id;
        mysqli_query($this->con, $sql);
    }

    public function restore_multiple_customer($arrID){
        $intArray = array_map('intval', $arrID);
        $resultString = '(' . implode(', ', $intArray) . ')';
        $sql = 'UPDATE customer SET visible = 1 WHERE id IN ' . $resultString;
        mysqli_query($this->con, $sql);
    }

    // public function getUserByID($id)
    // {
    //     $sql = "SELECT * FROM `customer` WHERE `id` = '$id'";
    //     $result = mysqli_query($this->con, $sql);
    //     return mysqli_fetch_assoc($result);
    // }

    public function getUserByID($userID)
    {
        $query = "SELECT * FROM customer WHERE id = $userID";
        $result = mysqli_query($this->con, $query);
        // $check = false;
        $user = null;
        if ($result->num_rows) {
            $user = mysqli_fetch_array($result);
        }
        return $user;
    }

    public function getTotalCart($userID)
    {
        $userID = mysqli_real_escape_string($this->con, $userID);

        $sql = "SELECT COUNT(c.id) AS totalQuantity, SUM(v.price * c.quantity) AS totalPrice 
                FROM cart c 
                JOIN variant v ON c.variantID = v.id 
                WHERE c.customerID = '$userID'";
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            // Handle query error
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            return array('price' => 0, 'quantity' => 0);
        }
        return array('price' => $row['totalPrice'], 'quantity' => $row['totalQuantity']);
    }

    public function getAllUserByPage($page,$search=""){
        $begin = ($page * 5) - 5;
        $sql ="SELECT c.id, c.name, c.email,c.author, a.name AS Author FROM `customer` c 
        JOIN author a ON a.ID = c.author 
        WHERE ".($search != "" ? ("c.name LIKE N'%".$search."%' AND"): "")." c.visible = 1
        LIMIT $begin, 5;";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function QuantityUser(){
        $sql = "SELECT COUNT(*) AS Quantity FROM customer WHERE visible = 1";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $rows = $row;
        }
        return $rows["Quantity"];
    }
    public function DeleteUser($id){
        $sql = "UPDATE customer SET visible = 0 WHERE id = $id;";
        $result = mysqli_query($this->con, $sql);
    }
    public function GetUser($id){
        $sql = "SELECT c.*,a.name AS Author, a.id AS AuthorID FROM customer c 
        JOIN author a ON c.author = a.ID WHERE c.id = $id";
        $result = mysqli_query($this->con, $sql);
        $users = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $users = $row;
        }
        return $users;
    }
    
    function updateUser($id,$name, $email, $author){
        $sql = "UPDATE customer SET `name` = '$name', email = '$email', author = $author
        WHERE id = $id";
        $result = mysqli_query($this->con, $sql); 
        return $result;
    }
    function insertUser($name, $email,$author){
        $password = md5("1234");
        $sql = "INSERT INTO customer (`name`, `email`, `password`, `author`, `visible`) 
        VALUES ('$name','$email','$password',$author, 1)";
        $result = mysqli_query($this->con, $sql); 
        return $result;
    }
    public function DeleteUserByCheckbox($id)
    {
        $temp = explode(',', $id);
        $resultString = '(' . implode(', ', $temp) . ')'; // (12,32,13,32)
        $sql = "UPDATE customer SET visible = 0 WHERE id IN $resultString;";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function SearchUser($temp){
        $sql = "SELECT * FROM customer WHERE `name` LIKE '%$temp%' AND visible = 1";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAuthor(){
        $sql = "SELECT * FROM author";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function saveRole($arrID){
        foreach ($arrID as $object) {
            $featureID = $object['f'];
            $authorID = $object['a'];
            $show = isset($object['s']) ? $object['s'] : 0;
            $edit = isset($object['e']) ? $object['e'] : 0;
        
            $sql = "UPDATE `access` SET `show`= $show, `edit`= $edit
            WHERE authorID=$authorID AND featureID=$featureID";
            mysqli_query($this->con, $sql);
        }
        mysqli_close($this->con);
    }

    public function checkPermission($authorID, $featureID){
        $sql = "SELECT * FROM `access` WHERE authorID = $authorID AND featureID = $featureID";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function getFeature($id){
        $sql = "SELECT a.*, f.name FROM `access` a 
                JOIN author au ON a.authorID = au.ID 
                JOIN feature f ON a.featureID = f.id WHERE a.authorID = '$id';";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    
}
