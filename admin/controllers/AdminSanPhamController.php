<?php
class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }

    public function formAddSanPham()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        require_once './views/sanpham/addSanPham.php';
        // xóa session khi load trang
        deleteSessionError();
    }

    public function postAddSanPham()
    {
        // xử lý dữ liệu 
        // var_dump($_POST);
        // KIỂM  tra xem dữ liệu có được submit hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            // lưu hình ảnh
            $file_thumb = uploadFile($hinh_anh, './uplaods');
            // album ảnh
            $img_array = $_FILES['img_array'] ?? null;

            // Tạo một mảng chống để chứa dữ liệu
            $error = [];
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = 'tên sản phẩm không được bỏ trống';
            }
            if (empty($gia_san_pham)) {
                $error['gia_san_pham'] = 'giá sản phẩm không được bỏ trống';
            }
            if (empty($gia_khuyen_mai)) {
                $error['gia_khuyen_mai'] = 'giá khuyến mãi không được bỏ trống';
            }
            if (empty($so_luong)) {
                $error['so_luong'] = 'số lượng sản phẩm không được bỏ trống';
            }
            if (empty($ngay_nhap)) {
                $error['ngay_nhap'] = 'ngày nhập sản phẩm không được bỏ trống';
            }
            if (empty($danh_muc_id)) {
                $error['danh_muc_id'] = 'danh mục sản phẩm không được bỏ trống';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'phải chọn trạng thái';
            }
            if ($hinh_anh['error'] !== 0) {
                $error['hinh_anh'] = 'phải chọn hình ảnh';
            }
            $_SESSION['error'] = $error;

            // nếu không có lỗi thì tiến hành thêm sản phẩm
            if (empty($error)) {
                // nều không có lỗi thì tiến hành thêm dnah mục
                $san_pham_id =  $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $file_thumb);
                // them album anh
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key],

                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }
                header("location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // Trả lỗi trả về form
                // đặt chỉ thị xóa session khi chuyển về form
                $_SESSION['flash'] = true;
                header("location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }













    public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $id_khach_hang =  $_POST['id_khach_hang'];
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
        // var_dump($binhLuan['trang_thai']);
        // die();
        if ($binhLuan) {
            $binhLuan['trang_thai'] = !$binhLuan['trang_thai'];
            // var_dump($binhLuan['trang_thai']);
            // die();
            $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $binhLuan['trang_thai']);
            header("location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $id_khach_hang);
        }
    }
}
