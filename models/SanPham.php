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
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getLatestSanPham()
    {
        try {
            $sql = "SELECT * FROM san_phams ORDER BY ngay_nhap ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(); // Trả về sản phẩm mới nhất
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
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * from tai_khoans where email =:email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function insertBinhBluanByIDSP($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang, $trang_thai)
    {
        try {
            $sql = "INSERT INTO binh_luans (san_pham_id, tai_khoan_id, noi_dung, ngay_dang, trang_thai)
                VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_dang, :trang_thai)";
            // var_dump($this->conn);

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'san_pham_id' => $san_pham_id,
                'tai_khoan_id' => $tai_khoan_id,
                'noi_dung' => $noi_dung,
                'ngay_dang' => $ngay_dang,
                'trang_thai' => $trang_thai,
            ]);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
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


    // tìm kiếm
    public function timKiemTheoTen($search_input)
    {
        try {
            $sql = "SELECT * from san_phams where ten_san_pham like :search_input";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':search_input', $search_input, PDO::PARAM_STR);
            $search_input = '%' . $search_input . '%';  // Thêm dấu % để tìm kiếm chuỗi tương tự
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllDanhMucClient()
    {
        try {
            $sql = "SELECT * FROM danh_mucs limit 5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
