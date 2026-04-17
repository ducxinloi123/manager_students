<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
function layout ($layout){
    if(file_exists(_PATH_URL_TEMPALTES.'/assets/layouts/'.$layout.'.php')){
        require_once _PATH_URL_TEMPALTES.'/assets/layouts/'.$layout.'.php';
    }
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $content) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình Server
        $mail->SMTPDebug = 0; // Chỉnh lên 2 nếu muốn xem log lỗi chi tiết
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Bạn dùng Gmail để gửi
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lynhanduc123@gmail.com'; // Email dùng để gửi
        $mail->Password   = 'iexpkgoghodwrxqg'; // Mật khẩu ứng dụng (không phải pass đăng nhập)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // Người gửi & Người nhận
        $mail->setFrom('lynhanduc0406@gmail.com', 'manager_students');
        $mail->addAddress($to);

        // Nội dung Email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $content;

        return $mail->send(); 
    } catch (Exception $e) {
        return false;
    }
}
function isPost (){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    else {
        return false;
    }
}
function isGET (){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    else {
        return false;
    }
}
function filterData($method =''){
    $filterArr = []; // Chỉnh lại tên cho đúng chính tả "Filter"

    // 1. Trường hợp không truyền method (tự động nhận diện)
    if (empty($method)) {
        // Xử lý GET
        if (isGet() && !empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
        // Xử lý POST
        if (isPost() && !empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    } 
    // 2. Trường hợp ép buộc method cụ thể
    else {
        $method = strtolower($method);
        if ($method == 'get' && !empty($_GET)) {
            // ... (copy logic xử lý GET ở trên xuống)
        } else if ($method == 'post' && !empty($_POST)) {
            // ... (copy logic xử lý POST ở trên xuống)
        }
    }

    return $filterArr; // <--- Dòng này để cứu lỗi "Assigning void" nè!
}
function validateEmail($email){
    if(!empty($email)){
        $checkmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    return $checkmail;
}
function validateInt ($number){
    if(!empty($number)){
        $checknumber = filter_var($number,FILTER_VALIDATE_INT);
    }
    return $checknumber;
}
function isPhone ($phone){
    $phoneFirst = false;
    if($phone[0] == '0'){
        $phoneFirst = true ;
        $phone = substr($phone,1);
    }
    $checkphone = false;
    if(validateInt($phone)){
        $checkphone = true;
    }
    if($phoneFirst & $checkphone){
        return true;
    }
    return false;
}