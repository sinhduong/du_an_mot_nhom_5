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
    public function formEditDanhMuc()
    {
        if (isset($_GET['id_danh_muc'])) {
            $id = intval($_GET['id_danh_muc']); // Sanitize input
            $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);

            if ($danhmuc) {
                require_once './views/danhmuc/editDanhMuc.php';
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
    public function postEditDanhMuc($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $error = [];
            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'tên danh mục không được bỏ trống';
            }

            if (empty($error)) {
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                $danhmuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc()
    {
        if (isset($_GET['id_danh_muc'])) {
            $id = intval($_GET['id_danh_muc']); // Lấy id từ URL
            $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);

            if ($danhmuc) {
                $this->modelDanhMuc->destroyDanhMuc($id);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                echo "Danh mục không tồn tại.";
            }
        } else {
            echo "ID danh mục không hợp lệ.";
        }
    }
}
