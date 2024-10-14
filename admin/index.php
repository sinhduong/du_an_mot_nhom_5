<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';

// checkLoginAdmin();

require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaikhoanController.php';
require_once './controllers/AdminDonHangController.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanpham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

match ($act) {
    // Trang chủ báo cáo thống kê
    '/' => (new AdminBaoCaoThongKeController())->home(),

    // route danh mục
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'update-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc($_GET['id']),
    'delete-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc($_GET['id']),

    // route sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditSanPham(),
    'update-san-pham' => (new AdminSanPhamController())->postEditSanPham($_GET['id']),
    'sua-album-san-pham' => (new AdminSanPhamController())->postEditAlbumSanPham($_GET['id']),
    'delete-san-pham' => (new AdminSanPhamController())->deleteSanPham($_GET['id']),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),

    // Route quản lý tài khoản quản trị
    'list-tai-khoan-quan-tri' => (new AdminTaikhoanController())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AdminTaikhoanController())->formAddQuanTri(),
    'them-quan-tri' => (new AdminTaikhoanController())->postAddQuanTri(),
    'form-sua-quan-tri' => (new AdminTaikhoanController())->formEditQuanTri(),
    'update-quan-tri' => (new AdminTaikhoanController())->postEditQuanTri(),

    // Route reset password tài khoản
    'reset-password' => (new AdminTaikhoanController())->resetPassword(),

    // Route quản lý tài khoản khách hàng
    'list-tai-khoan-khach-hang' => (new AdminTaikhoanController())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaikhoanController())->formEditKhachHang(),
    'update-khach-hang' => (new AdminTaikhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaikhoanController())->detailKhachHang(),

    // route đơn hàng 
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang($_GET['id_don_hang']),
    'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(),
    'update-don-hang' => (new AdminDonHangController())->postEditDonHang($_GET['id']),


    // route bình luận
    'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),



    // route auth
    'login-admin' => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin' => (new AdminTaiKhoanController())->logout(),

};
