<?php
require_once './commons/env.php';
require_once './commons/function.php';
require_once './cotrollers/homeControllers.php';
require_once './models/SanPham.php';



$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

match ($act) {
   '/' => (new homeControllers())->home(), //Trường hợp đặc biệt

   'trangchu' => (new homeControllers())->trangchu(),
   // BASE_URL/?act=trangchu

   // 'danh-sach-san-pham' => (new homeControllers())->danhSachSanPham()
   // BASE_URL/?act=danh-sach-san-pham
   'chi-tiet-san-pham' =>(new homeControllers())->chiTietSanPham(),
};
