<?php

class SanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllSanPhamBuy()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id order by id desc";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllSanPhamShort()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id order by id asc";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailSanPham($id)
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            
             WHERE san_phams.id =:id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Trả về false để xử lý lỗi ở controller
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = "SELECT *FROM hinh_anh_san_phams WHERE san_pham_id =:id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Trả về false để xử lý lỗi ở controller
        }
    }
    public function insertBinhBluanByIDSP($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang, $trang_thai)
    {
        try {
            $sql = "INSERT INTO binh_luan (san_pham_id, tai_khoan_id, noi_dung, ngay_dang, trang_thai)
                VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_dang, :trang_thai)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'san_pham_id' => $san_pham_id,
                'tai_khoan_id' => $tai_khoan_id,
                'noi_dung' => $noi_dung,
                'ngay_dang' => $ngay_dang,
                'trang_thai' => $trang_thai,
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }

    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten ,tai_khoans.anh_dai_dien
                    FROM binh_luans
                    INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
                    WHERE binh_luans.san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            // Lấy tất cả các bình luận liên quan đến sản phẩm
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getListSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id 
            where san_phams.danh_muc_id=" . $danh_muc_id;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
