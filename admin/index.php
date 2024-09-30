<?php
require_once '../commons/env.php';
require_once '../commons/function.php';
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanpham.php';

$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

match ($act) {
    // route danh mục
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'update-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc($_GET['id']),
    'delete-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc($_GET['id']),

};
