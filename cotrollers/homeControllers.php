<?php
class homeControllers
{
    public $modelSanPham;

    public function home()
    {
        $listSanPham= $this->modelSanPham->getAllSanPham();
        $listSanPhamBuy= $this->modelSanPham->getAllSanPhamBuy();
        $listSanPhamShort= $this->modelSanPham->getAllSanPhamShort();
        require_once './views/home.php';
    }

    public function trangchu()
    {
        echo ('đây là trang chủ');
    }

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
    }

  public function chiTietSanPham(){
    if (isset($_GET['id_san_pham'])) {
        $id = intval($_GET['id_san_pham']); // Sanitize input
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc);die;

        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    } 
  }
}
