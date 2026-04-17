<?php
if(!defined( '_NhanDuc')){
    die ('Truy cap kh hop le');
}


try {
    if (class_exists('PDO')) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // hỗ trợ về Tiếng Việt
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Đẩy lỗi vào ngoại lệ
        );

        $dsn = _DIVER . ':host=' . _HOST . '; dbname=' . _DB;

        $conn = new PDO($dsn, _USER, _PASSWORD, $options);
    }
} catch (Exception $ex) {
    require_once './modules/errors/404.php';
    die();
}