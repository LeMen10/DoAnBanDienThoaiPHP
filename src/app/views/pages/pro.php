<?php
require  '../../../../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mail = new PHPMailer(true);
    $link = "http://localhost/DOAN/DoAnBanDienThoaiPHP/src/index.php?ctrl=reset&email=".$email;

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nhatduong7975@gmail.com'; // Thay bằng địa chỉ email của bạn
        // Mật khẩu ứng dụng của gmail (phải bật xác thực 2 lớp, sau đó lấy mật khẩu ứng dụng trong xác thực 2 lớp)
        $mail->Password = 'ghnq fbie wknm synk'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('nhatduong7975@gmail.com', 'minh');
        if (isset($email)) {
            // Gửi email đến địa chỉ email đã chỉ định
            $mail->addAddress($email);
        } else {
            throw new Exception('Email address is not defined.');
        }
        // $mail->addAddress($email);

        $mail->Subject = 'Reset Password';
        $mail->isHTML(true); // Đặt định dạng email thành HTML
        $mail->Body = 'Ấn vào link để đổi mật khẩu <a href="' . $link . '">' . $link . '</a>';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}