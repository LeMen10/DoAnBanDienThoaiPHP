<?php
require './app/database/connect.php';

class UserModel extends connect
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
        $sql = "SELECT * FROM `customer` WHERE visible = 0";
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
}
