<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}
require_once './templates/assets/layouts/header-auth.php';
?>
<div class="login-container text-center">
    <div class="success-icon mb-4">
        <i class="fas fa-check-circle"></i>
    </div>

    <h3 class="mb-3" style="font-weight: 700; color: #333;">KÍCH HOẠT THÀNH CÔNG!</h3>
    
    <p class="mb-4" style="font-size: 15px; color: #666; line-height: 1.6;">
        Chúc mừng tài khoản của bạn đã được kích hoạt thành công. 
        Giờ đây bạn đã có thể sử dụng tất cả các dịch vụ của chúng tôi.
    </p>

    <a href="<?php echo _HOST_URL?>?module=auth&action=login" class="btn btn-primary btn-block">
        ĐĂNG NHẬP NGAY
    </a>


</div>