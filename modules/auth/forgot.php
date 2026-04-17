<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
layout('header-auth');

?>
<div class="login-container">
    <h3 class="text-center mb-3" style="font-weight: 700; color: #333;">FORGOT PASSWORD</h3>
    <p class="text-center mb-4" style="font-size: 13px; color: #777;">
        Nhập email của bạn để nhận hướng dẫn khôi phục mật khẩu.
    </p>
    
    <form action="" method="POST">
        <div class="form-outline mb-4">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required />
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-3">RESET PASSWORD</button>

        <div class="text-center">
            <p><a href="<?php echo _HOST_URL?>?module=auth&action=login" style="text-decoration: none;">← Quay lại đăng nhập</a></p>
        </div>
    </form>
</div>