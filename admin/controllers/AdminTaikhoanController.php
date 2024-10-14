<?php
class AdminTaikhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;
    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
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
        // Kiểm tra xem dữ liệu có được submit bằng phương thức POST không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Tạo một mảng trống để chứa các lỗi
            $error = [];

            // Kiểm tra và thêm lỗi nếu có
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Tên người dùng không được bỏ trống';
            }
            if (empty($email)) {
                $error['email'] = 'Email người dùng không được bỏ trống';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'Email không hợp lệ';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui lòng chọn trạng thái';
            }

            // Lưu mảng lỗi vào session để hiển thị trong form
            $_SESSION['error'] = $error;

            // Nếu không có lỗi, tiến hành cập nhật tài khoản
            if (empty($error)) {
                // Cập nhật tài khoản
                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai);

                // Điều hướng về trang danh sách tài khoản quản trị sau khi cập nhật thành công
                header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Nếu có lỗi, điều hướng về lại form với id người quản trị viên
                $_SESSION['flash'] = true;
                header("location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }

    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123@123ab', PASSWORD_BCRYPT);
        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);

        if ($status && $tai_khoan['chuc_vu_id'] == 1) {
            header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } elseif ($status && $tai_khoan['chuc_vu_id'] == 2) {
            header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            var_dump('lỗi khi reset tài khoản');
            die;
        }
    }
    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaikhoan(2);
        // var_dump($listKhachHang);
        // die;
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }
    public function formEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }
    public function postEditKhachHang()
    {
        // Kiểm tra xem dữ liệu có được submit bằng phương thức POST không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Tạo một mảng trống để chứa các lỗi
            $error = [];

            // Kiểm tra và thêm lỗi nếu có
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Tên người dùng không được bỏ trống';
            }
            if (empty($email)) {
                $error['email'] = 'Email người dùng không được bỏ trống';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'Email không hợp lệ';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui lòng chọn trạng thái';
            }
            if (empty($ngay_sinh)) {
                $error['ngay_sinh'] = 'Vui lòng chọn ngày sinh';
            }
            if (empty($gioi_tinh)) {
                $error['gioi_tinh'] = 'Vui lòng chọn giới tính';
            }

            // Lưu mảng lỗi vào session để hiển thị trong form
            $_SESSION['error'] = $error;

            // Nếu không có lỗi, tiến hành cập nhật tài khoản
            if (empty($error)) {
                // Cập nhật tài khoản
                $this->modelTaiKhoan->updateKhachHang($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $trang_thai);

                // Điều hướng về trang danh sách tài khoản quản trị sau khi cập nhật thành công
                header("location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                // Nếu có lỗi, điều hướng về lại form với id người quản trị viên
                $_SESSION['flash'] = true;
                header("location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function detailKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        // var_dump($id_khach_hang);

        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);
        // var_dump($listDonHang);die;

        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }









    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form
            $email = $_POST['email'];
            $password = $_POST['password'];
            // var_dump($email);die;

            // xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user == $email) {
                // đăng nhập thành công
                // lưu thông tin vào session
                $_SESSION['user_admin'] = $user;
                header("location:" . BASE_URL_ADMIN);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;
                $_SESSION['flash'] = true;
                header("location:" . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header("location: " . BASE_URL_ADMIN . '?act=login-admin');
            exit();
        }
    }

    function checkLoginAdmin()
    {
        if (!isset($_SESSION['user_admin'])) {
            header("location:" . BASE_URL_ADMIN . '?act=login-admin');
            // include_once './views/auth/formLogin.php';
            exit();
        }
    }
}
