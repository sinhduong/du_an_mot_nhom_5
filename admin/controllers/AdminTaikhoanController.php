<?php
class AdminTaikhoanController
{
    public $modelTaiKhoan;
    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }
    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaikhoan(1);
        // var_dump($listQuanTri);
        // die;
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }
    public function postAddQuanTri()
    {
        // xử lý dữ liệu 
        // var_dump($_POST);
        // KIỂM  tra xem dữ liệu có được submit hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // Tạo một mảng chống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'tên  không được bỏ trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được bỏ trống';
            }
            $_SESSION['error'] = $errors;
            // nếu không có lỗi thì tiến hành thêm Tài khoản
            if (empty($errors)) {
                // nều không có lỗi thì tiến hành thêm  Tài khoản
                // Đặt pasword mặc định - 123@123
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                // var_dump($password);die;

                // khai báo chức vụ
                $chuc_vu_id = 1;
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);
                header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Trả lỗi trả về form và lỗi
                $_SESSION['flash'] = true;

                header("location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }
    public function formEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }
    public function postEditQuanTri()
    {
        // xử lý dữ liệu 
        // var_dump($_POST);
        // KIỂM  tra xem dữ liệu có được submit hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Tạo một mảng chống để chứa dữ liệu
            $error = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được bỏ trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được bỏ trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }
            $_SESSION['error'] = $errors;

            // nếu không có lỗi thì tiến hành thêm tài khoản
            if (empty($error)) {
                // nều không có lỗi thì tiến hành thêm tài khoản
                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai);
                header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header("location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
}
