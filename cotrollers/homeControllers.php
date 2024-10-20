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
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();

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


    // menu con
    public   function contact()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        require_once './views/lienHe.php';
    }
    public   function gioiThieu()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        require_once './views/gioiThieu.php';
    }
    public   function blog()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        require_once './views/blog.php';
    }

    public function shopSanPhamSM()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        require_once './views/sanPham/shop.php';
    }
    public function locSanPham()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();

        // Lấy tất cả sản phẩm trước khi lọc
        $listSanPham = $this->modelSanPham->getAllSanPham();

        // Kiểm tra request từ URL để áp dụng bộ lọc
        if (isset($_GET['filter'])) {
            switch ($_GET['filter']) {
                case 're':
                    // Sắp xếp sản phẩm theo giá tăng dần
                    usort($listSanPham, function ($a, $b) {
                        $giaA = !$a['gia_khuyen_mai'] ? $a['gia_san_pham'] : $a['gia_khuyen_mai'];
                        $giaB = !$b['gia_khuyen_mai'] ? $b['gia_san_pham'] : $b['gia_khuyen_mai'];
                        return $giaA <=> $giaB; // Tăng dần
                    });
                    break;

                case 'dat':
                    // Sắp xếp sản phẩm theo giá giảm dần
                    usort($listSanPham, function ($a, $b) {
                        $giaA = !$a['gia_khuyen_mai'] ? $a['gia_san_pham'] : $a['gia_khuyen_mai'];
                        $giaB = !$b['gia_khuyen_mai'] ? $b['gia_san_pham'] : $b['gia_khuyen_mai'];
                        return $giaB <=> $giaA; // Giảm dần
                    });
                    break;


                case 'ngay_nhap':
                    $listSanPham = array_filter($listSanPham, function ($sanPham) {
                        return $this->modelSanPham->getLatestSanPham();
                    });
                    break;
            }
        }

        // Trả về view với danh sách sản phẩm đã được lọc
        require_once './views/sanPham/shop.php';
    }

    public function loadSanPhamTheoDanhMuc()
    {
        // Lấy id danh mục từ URL
        $danhMucId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        $listSanPham = $this->modelSanPham->getAllSanPham();
        if ($danhMucId > 0) {
            // Lấy danh sách sản phẩm theo danh mục
            $listSanPham = $this->modelSanPham->getListSanPhamDanhMuc($danhMucId);
        } else {
            $listSanPham = []; // Nếu không có danh mục, khởi tạo danh sách sản phẩm rỗng
        }

        require_once './views/sanPham/danhMucSanPham.php';
    }


    // 

    public function chiTietSanPham()
    {
        if (isset($_GET['id_san_pham'])) {
            $id = intval($_GET['id_san_pham']); // Sanitize input
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
            $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
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

    public function postBinhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'];
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_dang = date('Y-m-d H:i:s');
            $trang_thai = 0;
            $error = [];
            if (empty($noi_dung)) {
                $error['noi_dung'] = 'Nội dung không được bỏ trống';
                $_SESSION['cmt_err'] = $error['noi_dung'];
            }
            if (empty($error)) {
                $this->modelSanPham->insertBinhBluanByIDSP($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang, $trang_thai);
                header("Location: " . BASE_URL . "?act=chi-tiet-san-pham&id_san_pham=" . $san_pham_id);
                exit();
            } else {
                header("Location: " . BASE_URL . "?act=chi-tiet-san-pham&id_san_pham=" . $san_pham_id);
            }
        }
    }






    //   auth 
    public function formLogin()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->getUserLogin($email, $password);

            if (is_array($user)) {
                // Đăng nhập thành công
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                header("location:" . BASE_URL);
                exit();
            } else {
                // Đăng nhập thất bại, lưu lỗi vào session
                $_SESSION['error'] = $user; // Lưu thông báo lỗi từ model
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


    public function formDangKy()
    {
        require_once './views/auth/formDangKy.php';
        deleteSessionError();
    }
    public function postDangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $confirm_mat_khau = $_POST['confirm_mat_khau'];

            // Kiểm tra mật khẩu và mật khẩu xác nhận có khớp không
            if ($mat_khau !== $confirm_mat_khau) {
                $_SESSION['error'] = 'Mật khẩu và mật khẩu xác nhận không khớp!';
                header("location: " . BASE_URL . '?act=dang-ky');
                exit();
            }

            // Nếu khớp, tiến hành đăng ký
            $isRegistered = $this->modelTaiKhoan->dangKy($ho_ten, $email, $mat_khau);

            if ($isRegistered) {
                header("location: " . BASE_URL . '?act=login');
            } else {
                $_SESSION['error'] = 'Đăng ký thất bại, vui lòng thử lại!';
                header("location: " . BASE_URL . '?act=dang-ky');
            }
        }
    }



    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['email'])) {
                // Lấy thông tin tài khoản từ email người dùng
                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['email']);

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
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        if (isset($_SESSION['email'])) {
            // Lấy thông tin tài khoản từ email người dùng
            $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['email']);
            $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
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
        // var_dump($_SESSION['email']);
        // die();
        if (isset($_SESSION['email'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['email']);
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
            // Lấy dữ liệu từ form
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1; // Trạng thái mặc định
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['email']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH-' . rand(1000, 9999);

            $product_ids = $_POST['product_id'];
            $quantities = $_POST['quantity'];
            $prices = $_POST['price'];
            $total_prices = $_POST['total_price'];
            // var_dump($prices);
            // var_dump($total_prices);
            // var_dump($quantities);
            // die();
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

            // Kiểm tra DonHangId
            if ($donHangId) {
                foreach ($product_ids as $index => $product_id) {
                    $this->modelDonHang->addChiTietDonHang(
                        $donHangId,
                        $product_id,
                        $prices[$index],
                        $quantities[$index],
                        $total_prices[$index]
                    );
                }
                // Xóa giỏ hàng
                $this->modelGioHang->clearGioHang($tai_khoan_id);
                echo    "<script>
                            alert('Mua hàng thành công! Bạn sẽ được chuyển đến trang đơn hàng.');
                            setTimeout(function() {
                            window.location.href = '" . BASE_URL . "?act=don-hang';
                            }, 1000); // Chuyển hướng sau 1 giây
                        </script>";
                exit;
            } else {
                die('Không thể tạo đơn hàng');
            }
        }
    }





    // Đơn hàng

    public function danhSachDonHang()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        // Lấy tài khoản từ session
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['email']);
        $tai_khoan_id = $user['id']; // Lấy ID tài khoản
        // $donHang = $this->modelDonHang->getDetailDonHang($_GET['id_don_hang']);
        // Lấy danh sách đơn hàng của tài khoản hiện tại
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        $listDonHang = $this->modelDonHang->getDonHangByTaiKhoan($tai_khoan_id);

        // Gọi view để hiển thị
        require_once './views/donhang/listDonHang.php';
    }


    public function detailDonHang()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        $don_hang_id = $_GET['id_don_hang'];
        // lấy thông tin dơn hàng ở bảng 
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // lấy danh sách sản phẩm  đã đặt của đơn hàng ở bảng chi tiết
        $sanPhamDonHang = $this->modelDonHang->getListSPDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/detailDonHang.php';
    }
    public function updateDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $don_hang_id = $_POST['id_don_hang'] ?? '';  // Lấy id đơn hàng
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';  // Lấy trạng thái hủy (11)

            // Kiểm tra và cập nhật trạng thái
            if (!empty($don_hang_id) && !empty($trang_thai_id)) {
                $result = $this->modelDonHang->updateDonHangClient(
                    $don_hang_id,
                    $trang_thai_id
                );
                if ($result) {
                    header('Location: ' . BASE_URL . '?act=don-hang');  // Chuyển hướng nếu thành công
                    exit();
                }
            }

            // Xử lý lỗi
            $_SESSION['error'] = "Hủy đơn hàng không thành công!";
            header('Location: ' . BASE_URL . '?act=don-hang');
            exit();
        }
    }





    // tìm kiếm
    public function timKiemSP()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMucClient();
        $search_input = isset($_POST['search_input']) ? $_POST['search_input'] : '';
        $tiemKiemSP = $this->modelSanPham->timKiemTheoTen($search_input);
        require_once './views/sanPham/keySanPham.php';
    }
}
