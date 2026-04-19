<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
layout('header-auth');
$msg = '';
if(isPost()){
    $filter = filterdata();
    $erorr = [];

    //validate fuullname
    if(empty(trim($filter['fullname']))){
        $erorr['fullname']['required'] = "Ho ten bat buoc phai nhap";
    }
    else{
         if(empty(trim($filter['fullname'])) > 5){
        $erorr['fullname']['length'] = "Ho ten phai lon hon 5 ki tu";
    }
    }
    //validate email
    if(empty(trim($filter['email']))){
        $erorr['email']['required'] ='Email la bat buoc phai nhap';
    }else {
        if(!validateEmail(trim($filter['email']))){
            $erorr['email']['isEmail'] = 'Email khong dung dinh dang';
        }else{
            $email = $filter['email'];
            $checkmail = getRows("SELECT * FROM users where Email ='$email'");
            // var_dump($checkmail);
            if($checkmail > 0){
                $erorr['email']['check'] = 'Email da ton tai';
            }
        }
    }
    //validate phone 
    if(empty($filter['phone'])){
        $erorr['phone']['required'] = 'so dien thoai bat buoc phai nhap';
    }
    else {
        if(!isPhone($filter['phone'])){
            $erorr['phone']['isPhone'] = 'so dien thoai khhong dung dinh dang';
        }
    }
    //validate password
     if(empty($filter['password'])){
        $erorr['password']['required'] = 'mat khau bat buoc phai nhap';
    }
    else {
        if(strlen(trim($filter['password'])) < 6 ){
        $erorr['password']['length'] = 'mat khau phai lon hon 6 ki tu';
        }
    }
    //validata cofirm_pass
     if(empty($filter['password'])){
        $erorr['confirm_password']['required'] = 'vui long nhap lai mk';
    }
    else {
        if(trim($filter['password']) !== trim($filter['confirm_password']))   {
        $erorr['confirm_password']['like'] = 'mat khau khong khop';
        }
    }
//    if(!empty($filter)){
//     $filterArr = filterData();
//     echo '<pre>';
//     print_r($filter);
//     echo '</pre>';
// die();
// }
if (empty($erorr)){
    $activeToken = sha1(uniqid().time());
    
    $data = [
        'FullName'     => $filter['fullname'],
        'Email'        => $filter['email'],
        'Phone'        => $filter['phone'],
        'password'     => password_hash($filter['password'], PASSWORD_DEFAULT),
        'Address'      => $filter['address'] ?? null, // Dùng ?? null để tránh lỗi Undefined
        'Foget_token'  => '',                        // Bổ sung dòng này để sửa lỗi Fatal
        'Active_token' => $activeToken,
        'Status'       => 0,
        'Group_id'     => 1,
        'Create_at'    => date('Y-m-d H:i:s'),
    ];

    $insertStatus = insert('users', $data);
    
    if($insertStatus){
        $to = $filter['email'];
    $subject = 'Kích hoạt tài khoản Manager Students - Nhân Đức';
    
    // Tạo link kích hoạt
    $linkActive = _HOST_URL.'/?module=auth&action=active&token='.$activeToken;

    // 2. Thiết kế nội dung mail bằng HTML & CSS (Inline)
    $content = '
    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;">
        <div style="background-color: #007bff; color: white; padding: 20px; text-align: center;">
            <h2 style="margin: 0;">Chào mừng bạn đến với Manager Students!</h2>
        </div>
        <div style="padding: 20px;">
            <p>Chào <strong>'.$filter['fullname'].'</strong>,</p>
            <p>Chúc mừng bạn đã đăng ký thành công tài khoản tại hệ thống của <strong>Nhân Đức</strong>.</p>
            <p>Để bắt đầu sử dụng, bạn vui lòng nhấn vào nút bên dưới để kích hoạt tài khoản:</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="'.$linkActive.'" style="background-color: #28a745; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">KÍCH HOẠT TÀI KHOẢN</a>
            </div>

            <p style="font-size: 0.9em; color: #666;">Nếu nút trên không hoạt động, bạn có thể copy link sau và dán vào trình duyệt:</p>
            <p style="font-size: 0.8em; color: #007bff; word-break: break-all;">'.$linkActive.'</p>
        </div>
        <div style="background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 0.8em; color: #777; border-top: 1px solid #ddd;">
            Cảm ơn bạn đã ủng hộ Dev Nhân Đức.<br>
            Đây là email tự động, vui lòng không phản hồi email này.
        </div>
    </div>
    ';
        sendMail($to, $subject, $content);
        $msg = 'Đăng ký thành công!';
        // Redirect hoặc xóa session cũ...
    } else {
        $msg = 'Lỗi hệ thống không thể đăng ký.';
    }
}
    else {
        $msg = 'Dữ liệu không hợp lệ, vui lòng kiểm tra lại!';
        setSessionFlash('olddata',$filter);
        setSessionFlash('error',$erorr);

    }
    $olddata = getSessionFlash('olddata');
    $erorrArr = getSession('error');
}




// if(!empty($erorr)){
//     $filterArr = filterData();
//     echo '<pre>';
//     print_r($erorr);
//     echo '</pre>';
// die();
// }erorr 

?>
<div class="container" style="max-width: 500px; margin: 50px auto;">
    <div class="login-container shadow p-4 bg-white rounded">
        <h3 class="text-center mb-4" style="font-weight: 700; color: #333;">REGISTER</h3>
        
        <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo (empty($erorr)) ? 'success' : 'danger'; ?> text-center">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-outline mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên..." value="<?php echo $filter['fullname'] ?? ''; ?>" />
                <?php echo (!empty($erorr['fullname'])) ? '<small class="text-danger">'.reset($erorr['fullname']).'</small>' : '';  ?>
            </div>

            <div class="form-outline mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại..." value="<?php echo $filter['phone'] ?? ''; ?>" />
                <?php echo (!empty($erorr['phone'])) ? '<small class="text-danger">'.reset($erorr['phone']).'</small>' : ''; ?>
            </div>

            <div class="form-outline mb-3">
                <label class="form-label">Email address</label>
                <input type="text" name="email" class="form-control" placeholder="example@gmail.com" value="<?php echo $filter['email'] ?? ''; ?>" />
                <?php echo (!empty($erorr['email'])) ? '<small class="text-danger">'.reset($erorr['email']).'</small>' : ''; ?>
            </div>

            <div class="form-outline mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự" />
                <?php echo (!empty($erorr['password'])) ? '<small class="text-danger">'.reset($erorr['password']).'</small>' : ''; ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" />
                <?php echo (!empty($erorr['confirm_password'])) ? '<small class="text-danger">'.reset($erorr['confirm_password']).'</small>' : ''; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block w-100">CREATE ACCOUNT</button>

            <div class="text-center mt-3">
                <p>Already a member? <a href="<?php echo _HOST_URL?>?module=auth&action=login">Login here</a></p>
            </div>
        </form>
    </div>
</div>