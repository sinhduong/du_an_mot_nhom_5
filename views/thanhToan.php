<?php include_once 'layout/header.php' ?>
<div class="wrapper bg--shaft">

    <?php include_once 'layout/menu.php' ?>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Checkout</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-wrapper">
        <div class="checkout-area pt--40 pb--80 pt-md--30 pb-md--60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- User Action Start -->

                        <!-- User Action End -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Area Start -->
                        <div class="checkout-wrapper bg--2">
                            <form action="<?= BASE_URL . '?act=xu-ly-thanh-toan' ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout-title">
                                            <h2>THÔNG TIN NGƯỜI NHẬN</h2>
                                        </div>

                                        <div class="checkout-form">
                                            <div class="form-row mb--30">
                                                <div class="form__group col-md-12 mb-sm--30">
                                                    <label for="ten_nguoi_nhan" class="form__label">Họ Và Tên:
                                                        <span>*</span></label>
                                                    <input type="text" name="ten_nguoi_nhan"
                                                        value="<?= $user['ho_ten'] ?>"
                                                        class="form__input form__input--2" placeholder="Nhập họ và tên"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-row mb--30">
                                                <div class="form__group col-12">
                                                    <label for="dia_chi_nguoi_nhan" class="form__label">Địa Chỉ:
                                                        <span>*</span></label>
                                                    <input type="text" name="dia_chi_nguoi_nhan"
                                                        value="<?= $user['dia_chi'] ?>"
                                                        class="form__input form__input--2" placeholder="Nhập địa chỉ"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-row mb--30">
                                                <div class="form__group col-md-12 mb-sm--30">
                                                    <label for="sdt_nguoi_nhan" class="form__label">Số Điện Thoại:
                                                        <span>*</span></label>
                                                    <input type="text" name="sdt_nguoi_nhan"
                                                        value="<?= $user['so_dien_thoai'] ?>"
                                                        class="form__input form__input--2"
                                                        placeholder="Nhập số điện thoại" required>
                                                </div>
                                                <div class="form__group col-md-12">
                                                    <label for="email_nguoi_nhan" class="form__label">Email:
                                                        <span></span></label>
                                                    <input type="email" name="email_nguoi_nhan"
                                                        value="<?= $user['email'] ?>"
                                                        class="form__input form__input--2"
                                                        placeholder="Nhập địa chỉ email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form__group col-12">
                                                    <label for="ghi_chu" class="form__label">Ghi Chú:</label>
                                                    <textarea class="form__input form__input--2 form__input--textarea"
                                                        name="ghi_chu" placeholder="Ghi Chú..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-md--30">
                                        <div class="order-details">
                                            <h3 class="heading-tertiary">Thông tin Sản phẩm</h3>
                                            <div class="order-table table-content table-responsive mb--30">
                                                <table class="table">
                                                    <thead>

                                                        <tr>
                                                            <th>Sản Phẩm</th>

                                                            <th>Giá Tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $tongGioHang = 0; // Initialize total cart amount

                                                        foreach ($chiTietGioHang as $key => $sanPham): ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="product_id[]" value="<?= $sanPham['san_pham_id'] ?>">
                                                                    <input type="hidden" name="quantity[]" value="<?= $sanPham['so_luong'] ?>">
                                                                    <a href=""><?= htmlspecialchars($sanPham['ten_san_pham']) ?><strong> x <?= intval($sanPham['so_luong']) ?></strong></a>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $tongTien = 0; // Initialize total price for the current product

                                                                    // Calculate the total price based on promotional price or regular price
                                                                    if ($sanPham['gia_khuyen_mai']) {
                                                                        echo '<input type="hidden" name="price[]" value="' . $sanPham['gia_khuyen_mai'] . '">';
                                                                        $tongTien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                                        echo '<input type="hidden" name="total_price[]" value="' . $tongTien . '">';
                                                                    } else {
                                                                        echo '<input type="hidden" name="price[]" value="' . $sanPham['gia_san_pham'] . '">';
                                                                        $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                                        echo '<input type="hidden" name="total_price[]" value="' . $tongTien . '">';
                                                                    }

                                                                    // Add to the overall cart total
                                                                    $tongGioHang += $tongTien;

                                                                    // Display the formatted price
                                                                    echo formatPrice($tongTien) . ' vnd';
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>
                                                                Vận chuyển
                                                            </th>

                                                            <td><strong>
                                                                    30.000đ
                                                                </strong></td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Tổng tiền sản phẩm
                                                            </th>
                                                            <input type="hidden" name="tong_tien"
                                                                value="<?= $tongGioHang ?>">
                                                            <td><strong>
                                                                    <?= formatPrice($tongGioHang + 30000) . 'đ' ?>
                                                                </strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="checkout-payment">
                                                <div class="payment-btn-group">
                                                    <h5>Chọn phương thức thanh toán</h5> <br>
                                                    <div class="custom-radio payment-radio">
                                                        <input style="width: 20px;" id="option1" type="radio" value="1"
                                                            name="phuong_thuc_thanh_toan_id" required />
                                                        <label class="payment-label" for="option1">Thanh Toán Khi Nhận
                                                            Hàng</label>
                                                    </div> <br>
                                                    <div class="custom-radio payment-radio">
                                                        <input style="width: 20px;" id="option2" type="radio" value="2"
                                                            name="phuong_thuc_thanh_toan_id" required />
                                                        <label class="payment-label" for="option2">Thanh toán
                                                            VNPAY</label>
                                                    </div> <br>

                                                </div>

                                                <p class="alert alert-danger" style="display: none;" id="messageLogin">
                                                    Vui lòng đăng nhập để đặt hàng!</p>

                                                <div class="payment-btn-group">
                                                    <button type="submit" class="btn btn-style-3">Thanh toán</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Validate đăng nhập mới thanh toán được
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            if (!isLogIn) {
                // Ngăn chặn việc gửi form nếu người dùng chưa đăng nhập
                event.preventDefault();
                document.getElementById('messageLogin').style.display = 'block';
                document.getElementById('messageLogin').textContent = 'Bạn cần đăng nhập để thực hiện đặt hàng!';
            }
        });

        // input:radio Không cùng name vẫn chọn được
        const checkboxes = document.querySelectorAll('input[type="radio"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    checkboxes.forEach(function(otherCheckbox) {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });

        // Thiết lập input radio đầu tiên là đã chọn
        document.addEventListener('DOMContentLoaded', function() {
            var firstRadio = document.getElementById('option1'); // Lấy id input radio đầu tiên
            if (firstRadio) {
                firstRadio.checked = true;
            }
        });
    </script>
    <?php include_once 'layout/footer.php' ?>