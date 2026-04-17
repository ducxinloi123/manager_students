<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
layout('header-auth');

if(!empty($_POST)){
    $filterArr = filterData();
    echo '<pre>';
    print_r($filterArr);
    echo '</pre>';
die();
}

?>
<div class="login-container">
    <h3 class="text-center mb-4" style="font-weight: 700; color: #333;">REGISTER</h3>
    
    <form action="" method="POST">
        <div class="form-outline mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên..." required />
        </div>

        <div class="form-outline mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại..." required />
        </div>

        <div class="form-outline mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required />
        </div>

        <div class="form-outline mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự" required />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required />
        </div>

        <button type="submit" class="btn btn-primary btn-block">CREATE ACCOUNT</button>

        <div class="text-center mt-3">
            <p>Already a member? <a href="<?php echo _HOST_URL?>?module=auth&action=login">Login here</a></p>
        </div>
    </form>
</div>