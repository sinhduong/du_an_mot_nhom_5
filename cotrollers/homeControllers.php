<?php
class homeControllers
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

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
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
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


    // logout:
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL);
        exit();
    }


    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                // Lấy thông tin tài khoản từ email người dùng
                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

                // Kiểm tra xem người dùng đã có giỏ hàng chưa
                $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);
                if (!$gioHang) {
                    // Nếu chưa có, tạo giỏ hàng mới
                    $gioHangID = $this->modelGioHang->addGioHang($email['id']);
                    $gioHang = ['id' => $gioHangID];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    // Nếu đã có, lấy chi tiết giỏ hàng
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                // Lấy thông tin sản phẩm từ POST
                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = intval($_POST['so_luong']);
                $checkSanPham = false;

                // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                if (isset($chiTietGioHang)) {
                    foreach ($chiTietGioHang as $detail) {
                        if ($detail['san_pham_id'] == $san_pham_id) {
                            // Nếu đã có, cập nhật số lượng
                            $newSoLuong = $detail['so_luong'] + $so_luong;
                            $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                            $checkSanPham = true;
                            break;
                        }
                    }
                }

                // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới sản phẩm
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }

                header("location:" . BASE_URL . '?act=gio-hang');
            } else {
                header("location:" . BASE_URL . '?act=login');
            }
        }
    }
    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy thông tin tài khoản từ email người dùng
            $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // Kiểm tra xem người dùng đã có giỏ hàng chưa
            $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);
            if (!$gioHang) {
                // Nếu chưa có, tạo giỏ hàng mới
                $gioHangID = $this->modelGioHang->addGioHang($email['id']);
                $_SESSION['gio_hang_id'] = $gioHangID; // Lưu ID giỏ hàng vào session
                $gioHang = ['id' => $gioHangID];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $_SESSION['gio_hang_id'] = $gioHang['id']; // Lưu ID giỏ hàng vào session
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // $checkSanPham = false;

            require_once './views/gioHang.php';
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
    }
    public function updateGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantities = $_POST['quantity'] ?? []; // Lấy dữ liệu số lượng từ form
            $gioHangId = $_SESSION['gio_hang_id']; // Lưu ID giỏ hàng trong session

            foreach ($quantities as $sanPhamId => $soLuong) {
                // Cập nhật số lượng cho từng sản phẩm trong giỏ hàng
                $this->modelGioHang->updateSoLuong($gioHangId, $sanPhamId, intval($soLuong));
            }

            // Quay lại trang giỏ hàng
            header('Location:' . BASE_URL . '?act=gio-hang');
            exit();
        }
    }
    public function deleteOneGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanPhamId = $_POST['san_pham_id'] ?? null;
            if ($sanPhamId && isset($_SESSION['gio_hang_id'])) {
                $this->modelGioHang->deleteChiTietGioHang($_SESSION['gio_hang_id'], $sanPhamId);
            }
            header('Location: ' . BASE_URL . '?act=gio-hang');
            exit();
        }
    }

    // thanh toán:
    public function ThanhToan()
{
    // Check if the user is logged in
    if (isset($_SESSION['user_client'])) {
        // Retrieve user information
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        
        // Get the shopping cart associated with the user
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

        // If the shopping cart does not exist, create a new one
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addgioHang($user['id']);
            $gioHang = ['id' => $gioHangId];
        }
        
        // Retrieve details of the shopping cart
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

        // Load the payment view with the shopping cart details
        require_once './views/thanhToan.php';
    } else {
        // Handle case for unauthenticated users
        // Consider redirecting to login or showing error
        header("Location: login.php"); // Example redirection
        exit;
    }
}
    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH' . rand(1000, 9999);
            //thêm thông tin vào db
            $this->modelDonHang->addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id);
        }
    }
}
