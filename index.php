<?php
session_start();

require_once './commons/env.php';
require_once './commons/function.php';
require_once './cotrollers/homeControllers.php';
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';



$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

match ($act) {
   '/' => (new homeControllers())->home(),
   'chi-tiet-san-pham' => (new homeControllers())->chiTietSanPham(),
   'tim-kiem-san-pham' => (new homeControllers())->timKiemSP(),
   'shop-danh-muc-san-pham' => (new homeControllers())->shopSanPhamSM(),
   'san-pham' => (new homeControllers())->locSanPham(),
   'load-san-pham-theo-danh-muc' => (new homeControllers())->loadSanPhamTheoDanhMuc(),

   // Bình luận
   'add-binh-luan' => (new homeControllers())->postBinhLuan(),

   // auth
   'login' => (new homeControllers())->formLogin(),
   'logout' => (new homeControllers())->logout(),
   'check-login' => (new homeControllers())->postLogin(),

   'dang-ky' => (new homeControllers())->formDangKy(),
   'xu-ly-dang-ky' => (new homeControllers())->postDangKy(),

   // giỏ hàng
   'them-gio-hang' => (new homeControllers())->addGioHang(),
   'gio-hang' => (new homeControllers())->gioHang(),
   'delete-san-pham-gio-hang' => (new homeControllers())->deleteOneGioHang(),
   'incQty' => (new homeControllers())->incQtyCart(),
   'decQty' => (new homeControllers())->decQtyCart(),


   // thanh toán

   'thanh-toan' => (new homeControllers())->ThanhToan(),
   'xu-ly-thanh-toan' => (new homeControllers())->postThanhToan(),

   // Đơn hàng
   'don-hang' => (new homeControllers())->danhSachDonHang(),
   'huy-don-hang' => (new homeControllers())->updateDonHang(),
   'chi-tiet-don-hang' => (new homeControllers())->detailDonHang($_GET['id_don_hang']),




   // thanh menu
   'contact' => (new homeControllers())->contact(),
   'gioi-Thieu' => (new homeControllers())->gioiThieu(),
   'blog' => (new homeControllers())->blog(),
};
