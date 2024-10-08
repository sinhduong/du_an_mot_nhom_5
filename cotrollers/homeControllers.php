<?php
class homeControllers
{
    public $modelSanPham;
    public $modelTaiKhoan;

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listSanPhamBuy = $this->modelSanPham->getAllSanPhamBuy();
        $listSanPhamShort = $this->modelSanPham->getAllSanPhamShort();
        require_once './views/home.php';
    }

    public function trangchu()
    {
        echo ('đây là trang chủ');
    }

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
    }

    public function chiTietSanPham()
    {
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




    //   auth 
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }
    public function postLogin()
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
                $_SESSION['user_client'] = $user;
                header("location:" . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;
                $_SESSION['flash'] = true;
                header("location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                // Lấy dữ liệu giỏ hàng của người dùng
                // var_dump($email['id']);
                // die;

                $gioHang = $this->modelGioHang->getGioHangFromID($email['id']);
            } else {
                var_dump('Chưa đăng nhập');
                die;
            }

            // Lấy thông tin sản phẩm từ POST
            $sanPhamID = $_POST['san_pham_id'];
            $soLuong = intval($_POST['so_luong']);
            // var_dump($sanPhamID, $soLuong); 
            // die; 
        }
    }
}
