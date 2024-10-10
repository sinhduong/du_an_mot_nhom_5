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
            header("location:" . BASE_URL . '?act=login');
        }
    }

    public function deleteOneGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'DELETE') {
            $cartDetailId = $_POST['cart_detail_id'];
            $this->modelGioHang->deleteChiTietGioHang($cartDetailId);
            header('Location: ' . BASE_URL . '?act=gio-hang');
            exit();
        }
    }

    public function incQtyCart()
    {
        // die(123);
        $this->modelGioHang->updateIncQty($_GET['id']);
        header('Location: ' . BASE_URL . '?act=gio-hang');
        exit();
    }
    public function decQtyCart()
    {
        $this->modelGioHang->updateDecQty($_GET['id']);
        header('Location: ' . BASE_URL . '?act=gio-hang');
        exit();
    }

    // Thanh toán

    public function ThanhToan()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addgioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
            }
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            require_once './views/thanhToan.php';
        } else {
            header("Location: login.php");
            exit;
        }
    }

    // Xử lý khi thanh toán (submit form)
    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);die;
            // Lấy dữ liệu từ form
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1; // Trạng thái đơn hàng mặc định là 1
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH-' . rand(1000, 9999); // Tạo mã đơn hàng ngẫu nhiên

            // Thêm thông tin đơn hàng vào cơ sở dữ liệu
            $donHangId = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );

            if ($donHangId) {
                // Lấy chi tiết giỏ hàng
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($user['id']);

                // Thêm từng sản phẩm trong giỏ hàng vào chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $this->modelDonHang->addChiTietDonHang(
                        $donHangId,
                        $item['san_pham_id'],
                        $item['so_luong'],
                        $item['don_gia'],
                        $item['thanh_tien']
                    );
                }

                // Xóa giỏ hàng sau khi đơn hàng được thêm thành công
                $this->modelGioHang->clearGioHang($tai_khoan_id);

                // Chuyển hướng người dùng đến trang chi tiết đơn hàng
                header('location:' . BASE_URL . '?act=don-hang');
                exit;
            }
        }
    }



    // Đơn hàng

    public function danhSachDonHang()
    {
        
        $listDonHang = $this->modelDonHang->getAllDonHang();

        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];
        // lấy thông tin dơn hàng ở bảng 
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // lấy danh sách sản phẩm  đã đặt của đơn hàng ở bảng chi tiết
        $sanPhamDonHang = $this->modelDonHang->getListSPDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/detailDonHang.php';
    }
}
