<?php
require  '../../../../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mail = new PHPMailer(true);
    $link = "http://localhost/DOAN/DoAnBanDienThoaiPHP/src/index.php?ctrl=forgot&email=".$email;

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

        $mail->Subject = 'Test Email';
        $mail->isHTML(true); // Đặt định dạng email thành HTML
        $mail->Body = 'Ấn vào link để đổi mật khẩu <a href="' . $link . '">' . $link . '</a>';

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
// ini_set("SMTP", "smtp.gmail.com");
// ini_set("smtp_port", "587");

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST["email"];

//     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         // Tạo một mã xác thực ngẫu nhiên
        
//         $link = "index.php?ctrl=forgot";

//         // Xử lý gửi email ở đây
//         $message = "Click the following link: <a href='$link'>$link</a>";

//         // Gửi email
//         $subject = "Link to Website";
//         $headers = "From: your_email@example.com\r\n";
//         $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
//         mail($email, $subject, $message, $headers);

//         $response = "Link sent to " . $email;
//     } else {
//         $message = "Invalid email address!";
//     }
//     echo $message;
// }