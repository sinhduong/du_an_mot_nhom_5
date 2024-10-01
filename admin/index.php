<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaikhoanController.php';
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
    'delete-san-pham' => (new AdminSanPhamController())->deleteSanPham($_GET['id']),

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
    'form-sua-khach-hang'=> (new AdminTaikhoanController())->formEditKhachHang(),
    'update-khach-hang'=> (new AdminTaikhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang'=> (new AdminTaikhoanController())->detailKhachHang(),


    // route bình luận
    'update-trang-thai-binh-luan'=> (new AdminSanPhamController())->updateTrangThaiBinhLuan(),

};
