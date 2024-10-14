<?php
class TaiKhoan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function dangKy($ho_ten, $email, $mat_khau)
    {
        try {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashPassword = password_hash($mat_khau, PASSWORD_DEFAULT);

            $sql = "INSERT INTO tai_khoans (ho_ten, email, mat_khau) VALUES (:ho_ten, :email, :mat_khau)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'ho_ten' => $ho_ten,
                'email' => $email,
                'mat_khau' => $hashPassword,  // Lưu mật khẩu đã mã hóa
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }


    public function getUserLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * from tai_khoans where email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if ($user['chuc_vu_id'] == 2) {
                    if ($user['trang_thai'] == 1) {
                        return $user;
                    } else {
                        return "tài khoản bị cấm";
                    }
                } else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu tài khoản";
            }
        } catch (\Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
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
}
