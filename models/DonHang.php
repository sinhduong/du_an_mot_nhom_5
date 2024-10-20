<?php

class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function addDonHang(
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
    ) {
        try {
            $sql = "INSERT INTO don_hangs (tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, phuong_thuc_thanh_toan_id, ngay_dat, ma_don_hang, trang_thai_id) 
            VALUES(:tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan_id, :ngay_dat, :ma_don_hang, :trang_thai_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id
            ]);

            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addChiTietDonHang($donHangId, $sanPhamId, $donGia, $soLuong, $thanhTien)
    {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien) 
            VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong, :thanh_tien)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':don_hang_id' => $donHangId,
                ':san_pham_id' => $sanPhamId,
                ':don_gia' => $donGia,
                ':so_luong' => $soLuong,
                ':thanh_tien' => $thanhTien,
            ]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new Exception('Không thể chèn chi tiết đơn hàng.');
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }



    // chi tiết đơn hàng
    public function getAllDonHang()
    {
        try {
            $sql = "SELECT don_hangs .*, trang_thai_don_hangs.ten_trang_thai
            from don_hangs
            inner join trang_thai_don_hangs on don_hangs.trang_thai_id=trang_thai_don_hangs.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function updateDonHangClient($id, $trang_thai_id)
    {
        try {
            $sql = 'UPDATE don_hangs
                SET trang_thai_id = :trang_thai_id
                WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            error_log('Error updating order: ' . $e->getMessage());
            return false;
        }
    }


    // Lấy đơn hàng của tài khoản
    public function getDonHangByTaiKhoan($tai_khoan_id)
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs 
                ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                WHERE don_hangs.tai_khoan_id = :tai_khoan_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }



    public function getDetailDonHang($id)
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai, tai_khoans.ho_ten, 
            tai_khoans.email,
             tai_khoans.so_dien_thoai,
             phuong_thuc_thanh_toans.ten_phuong_thuc
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
            INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
            WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            //throw $th;
        }
    }

    public function getListSPDonHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*,san_phams.ten_san_pham,san_phams.hinh_anh
            FROM chi_tiet_don_hangs
            INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id=san_phams.id
            WHERE chi_tiet_don_hangs.don_hang_id=:id;
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            //throw $th;
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
}
