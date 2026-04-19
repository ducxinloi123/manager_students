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
            var_dump($checkmail);
            if($checkmail >0){
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
   
    if (empty($erorr)){
         $msg = 'Đăng ký thành công!';
    }
    else {
        $msg = 'Dữ liệu không hợp lệ, vui lòng kiểm tra lại!';

    }
}




// if(!empty($erorr)){
//     $filterArr = filterData();
//     echo '<pre>';
//     print_r($erorr);
//     echo '</pre>';
// die();
// }

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
                <?php echo (!empty($erorr['fullname'])) ? '<small class="text-danger">'.reset($erorr['fullname']).'</small>' : ''; ?>
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