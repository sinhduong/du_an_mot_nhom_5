<?php
class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }
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
    public function formEditDonhang()
    {
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("location:" . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }
    public function postEditDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';
        }

        $errors = [];

        if (empty($ten_nguoi_nhan)) {
            $errors['ten_nguoi_nhan'] = 'Tên người nhận không được bỏ trống';
        }
        if (empty($sdt_nguoi_nhan)) {
            $errors['sdt_nguoi_nhan'] = 'Số điện thoại người nhận không được bỏ trống';
        } elseif (!preg_match('/^\d{10}$/', $sdt_nguoi_nhan)) {
            $errors['sdt_nguoi_nhan'] = 'Số điện thoại không hợp lệ';
        }
        if (empty($email_nguoi_nhan)) {
            $errors['email_nguoi_nhan'] = 'Email người nhận không được bỏ trống';
        } elseif (!filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
            $errors['email_nguoi_nhan'] = 'Email không hợp lệ';
        }
        if (empty($dia_chi_nguoi_nhan)) {
            $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ người nhận không được bỏ trống';
        }
        if (empty($trang_thai_id)) {
            $errors['trang_thai_id'] = 'Trạng thái phải chọn';
        }

        $_SESSION['error'] = $errors;
        // var_dump($don_hang_id);die;

        if (empty($errors)) {
            // Call your model function to update the order
            $abc =  $this->modelDonHang->updateDonHang(
                $don_hang_id, // assuming you need to pass the order ID
                $ten_nguoi_nhan,
                $sdt_nguoi_nhan,
                $email_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $trang_thai_id
            );

            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        } else {
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
            exit();
        }
    }
}
