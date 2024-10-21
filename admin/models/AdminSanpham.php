<?php
class AdminSanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = "INSERT INTO  san_phams (ten_san_pham,gia_san_pham,gia_khuyen_mai,so_luong,ngay_nhap,danh_muc_id,trang_thai, mo_ta,hinh_anh)
                value (:ten_san_pham,:gia_san_pham,:gia_khuyen_mai,:so_luong,:ngay_nhap,:danh_muc_id,:trang_thai,:mo_ta,:hinh_anh)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,

                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);
            // lay id vua them
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    {

        try {
            $sql = "INSERT INTO hinh_anh_san_phams (san_pham_id,link_hinh_anh)
          VALUE(:san_pham_id,:link_hinh_anh)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,

            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
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
    public function updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = "UPDATE san_phams SET 
                ten_san_pham = :ten_san_pham,
                gia_san_pham = :gia_san_pham,
                gia_khuyen_mai = :gia_khuyen_mai,
                so_luong = :so_luong,
                ngay_nhap = :ngay_nhap,
                danh_muc_id = :danh_muc_id,
                trang_thai = :trang_thai,
                mo_ta = :mo_ta,
                hinh_anh = :hinh_anh
                WHERE id = :id"; 

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id
            ]);

            return true;
        } catch (Exception $e) {
            error_log("Lỗi: " . $e->getMessage());
            return false; 
        }
    }

    public function destroySanPham($id)
    {
        try {
            $sql = "DELETE FROM san_phams WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function getDetailAlbumSanPham($id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE id =:id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Trả về false để xử lý lỗi ở controller
        }
    }

    public function updateAlbunSanPham($id,$new_file)
    {
        try {
            $sql = "UPDATE hinh_anh_san_phams SET 
                link_hinh_anh = :new_file,
                WHERE id = :id"; 

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id,
               
            ]);

            return true;
        } catch (Exception $e) {
            error_log("Lỗi: " . $e->getMessage());
            return false; 
        }
    }


    public function destroyAnhSanPham($id)
    {
        try {
            $sql = "DELETE FROM hinh_anh_san_phams WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }







    // Bình luận
    public function getBinhLuanFromKhachHang($id)
    {
        try {
            $sql = 'SELECT binh_luans .*, san_phams.ten_san_pham
            from binh_luans
            inner join san_phams on binh_luans.san_pham_id=san_phams.id
            where binh_luans.tai_khoan_id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getDetailBinhLuan($id)
    {
        try {
            $sql = 'SELECT * FROM binh_luans where id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function updateTrangThaiBinhLuan($id, $trang_thai)
    {
        try {
            $sql = 'UPDATE binh_luans
                SET trang_thai = :trang_thai
                WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
