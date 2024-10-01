<?php
class AdminDonHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
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
    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = "SELECT don_hangs .*, trang_thai_don_hangs.ten_trang_thai
            from don_hangs
            inner join trang_thai_don_hangs on don_hangs.trang_thai_id=trang_thai_don_hangs.id
            where don_hangs.tai_khoan_id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
 
    
}
