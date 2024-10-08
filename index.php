<?php
session_start();
if (session_status() !== PHP_SESSION_ACTIVE) {
   die('Session không hoạt động');
}

require_once './commons/env.php';
require_once './commons/function.php';
require_once './cotrollers/homeControllers.php';
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';



$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

match ($act) {
   '/' => (new homeControllers())->home(),
   'chi-tiet-san-pham' => (new homeControllers())->chiTietSanPham(),

   // auth
   'login' => (new homeControllers())->formLogin(),
   'check-login' => (new homeControllers())->postLogin(),

   // giỏ hàng
   'them-gio-hang'=>(new homeControllers())->addGioHang(),
};
