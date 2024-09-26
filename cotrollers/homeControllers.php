<?php
class homeControllers
{
    public $modelSanPham;

    public function home()
    {
        echo ('đây là trang home');
    }

    public function trangchu()
    {
        echo ('đây là trang chủ');
    }

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
    }

    public function danhSachSanPham()
    {
        $listProducts = $this->modelSanPham->GetAllProduct();
        // var_dump($listProducts);
        require_once './views/listProduct.php';
    }
}
