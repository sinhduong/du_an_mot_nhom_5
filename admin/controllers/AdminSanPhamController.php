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
            $file_thumb = uploadFile($hinh_anh, './uploads/anhSanPham/');
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
            // if (empty($gia_khuyen_mai)) {
            //     $error['gia_khuyen_mai'] = 'giá khuyến mãi không được bỏ trống';
            // }
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
                        $link_hinh_anh = uploadFile($file, './uploads/AlbumSanPham/');
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

    public function formEditSanPham()
    {
        if (isset($_GET['id_san_pham'])) {
            $id = intval($_GET['id_san_pham']); // Sanitize input
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();


            if ($sanPham) {
                require_once './views/sanpham/editSanPham.php';
                deleteSessionError();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            }
        }
    }

    public function postEditSanPham()
    {
        // xử lý dữ liệu 
        // var_dump($_POST);
        // KIỂM  tra xem dữ liệu có được submit hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            // lấy ra dữ liệu cũ 
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            //truy vấn
            $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; // lấy ảnh cũ nếu sửa ảnh
            // var_dump($sanPhamOld);die;
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            // lưu hình ảnh


            // Tạo một mảng chống để chứa dữ liệu
            $error = [];
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = 'tên sản phẩm không được bỏ trống';
            }
            if (empty($gia_san_pham)) {
                $error['gia_san_pham'] = 'giá sản phẩm không được bỏ trống';
            }
            // if (empty($gia_khuyen_mai)) {
            //     $error['gia_khuyen_mai'] = 'giá khuyến mãi không được bỏ trống';
            // }
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
            $_SESSION['error'] = $error;
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // Upload ảnh mới
                $new_file = uploadFile($hinh_anh, './uploads/anhSanPham/');

                // Kiểm tra nếu việc upload file mới thành công
                if ($new_file) {
                    // Nếu có ảnh cũ thì xóa nó
                    if (empty($old_file) && file_exists($old_file)) {
                        deleteFile($old_file);
                    }
                } else {
                    // Nếu không upload được file mới, giữ lại ảnh cũ
                    $new_file = $old_file;
                }
            } else {
                // Không có ảnh mới, giữ lại ảnh cũ
                $new_file = $old_file;
            }
            if (empty($error)) {
                // nều không có lỗi thì tiến hành thêm dnah mục

                $this->modelSanPham->updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $new_file);
                // them album anh

                header("location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // Trả lỗi trả về form
                // đặt chỉ thị xóa session khi chuyển về form
                $_SESSION['flash'] = true;
                header("location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }


    public function postEditAlbumSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // lấy danh sách ablum ảnh hiện tại
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

            // xử lý các  ảnh được gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            // Khai báo mảng để lưu ảnh
            $upload_file = [];
            // upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_array, './uploads/AlbumSanPham/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }
            // Lưu ảnh mới vào DB và xóa ảnh cũ nếu có
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailAlbumSanPham($file_info['id'])['link_hinh_anh'];
                    // cập nhật ảnh cũ
                    $this->modelSanPham->updateAlbunSanPham($file_info['id'], $file_info['file']);
                    deleteFile($old_file);
                } else {
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }
            // xử lý xóa ảnh
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    $this->modelSanPham->destroyAnhSanPham($anh_id);
                    // xóa file 
                    DeleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
            exit();
            deleteSessionError();
        }
    }


    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        // Nếu sản phẩm tồn tại
        if ($sanPham) {
            // Xóa file hình ảnh chính của sản phẩm
            deleteFile($sanPham['hinh_anh']);

            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $this->modelSanPham->destroySanPham($id);
        }

        // Nếu có danh sách ảnh album sản phẩm
        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $anhSP) {
                // Xóa từng file hình ảnh trong album
                deleteFile($anhSP['link_hinh_anh']);

                // Xóa thông tin ảnh album khỏi cơ sở dữ liệu
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }

        // Chuyển hướng về trang quản lý sản phẩm sau khi xóa
        header("location:" . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }




    public function detailSanPham()
    {
        if (isset($_GET['id_san_pham'])) {
            $id = intval($_GET['id_san_pham']); // Sanitize input
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
            // var_dump($listAnhSanPham);die;

            if ($sanPham) {
                require_once './views/sanpham/detailSanPham.php';
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
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
