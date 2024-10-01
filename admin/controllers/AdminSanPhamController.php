<?php
class AdminSanPhamController
{
    public $modelSanPham;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }
    public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $id_khach_hang =  $_POST['id_khach_hang'];
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
        // var_dump($binhLuan['trang_thai']);
        // die();
        if ($binhLuan) {
            $binhLuan['trang_thai'] = !$binhLuan['trang_thai'];
            // var_dump($binhLuan['trang_thai']);
            // die();
            $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $binhLuan['trang_thai']);
            header("location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $id_khach_hang);
        }
    }
}
