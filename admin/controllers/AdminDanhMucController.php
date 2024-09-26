<?php
class AdminDanhMucController
{
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function  formAddDanhMuc()
    {
        // hiển thị form
        require_once './views/danhmuc/addDanhMuc.php';
    }
    public function postAddDanhMuc()
    {
        // xử lý dữ liệu 
        // var_dump($_POST);
        // KIỂM  tra xem dữ liệu có được submit hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo một mảng chống để chứa dữ liệu
            $error = [];
            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'tên danh mục không được bỏ trống';
            }

            // nếu không có lỗi thì tiến hành thêm danh mục
            if (empty($error)) {
                // nều không có lỗi thì tiến hành thêm dnah mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                // Trả lỗi trả về form
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }
}
