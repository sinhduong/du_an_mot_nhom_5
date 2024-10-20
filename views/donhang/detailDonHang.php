<?php require_once './views/layout/header.php' ?>

<!-- Main Wrapper Start -->
<div class="wrapper bg--shaft">
    <!-- Header Area Start -->
    <?php require_once './views/layout/menu.php' ?>
    <!-- Header Area End -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Chi tiết đơn hàng</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="<?= BASE_URL ?>">trang chủ</a></li>
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
                        <div class="checkout-wrapper bg--2">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="checkout-title">
                                        <h2>
                                            Thông tin người đặt
                                        </h2>
                                    </div>
                                    <div class="checkout-form mb--30">
                                        <p><?= 'Họ tên : ' . $donHang['ho_ten'] ?> </p>
                                        <p><?= 'Email : ' . $donHang['email'] ?> </p>
                                        <p><?= 'Số điện thoại : ' . $donHang['so_dien_thoai'] ?> </p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="checkout-title">
                                        <h2>Thông tin nhận hàng</h2>
                                    </div>
                                    <div class="checkout-form mb--30">

                                        <p><?= 'Họ tên : ' . $donHang['ten_nguoi_nhan'] ?></p>
                                        <p><?= 'Email : ' . $donHang['email_nguoi_nhan'] ?></p>
                                        <p><?= 'Số điện thoại : ' . $donHang['sdt_nguoi_nhan'] ?></p>
                                        <p><?= 'Địa chỉ : ' . $donHang['dia_chi_nguoi_nhan'] ?></p>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="checkout-title">
                                        <h2><?= 'Mã đơn hàng : ' . $donHang['ma_don_hang'] ?></h2>
                                    </div>
                                    <div class="checkout-form mb--30">

                                        <p><?= 'Tổng tiền : ' . formatPrice($donHang['tong_tien']+30000) . ' đ'  ?></p>
                                        <p><?= 'Ghi chú : ' . $donHang['ghi_chu'] ?></p>
                                        <p><?= 'Phương thức thanh toán : ' . $donHang['ten_phuong_thuc'] ?></p>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="checkout-title">
                                        <h2>Trạng thái đơn hàng</h2>
                                    </div>
                                    <div class="checkout-form mb--30" style="text-align:center;">
                                        <p>
                                            <?php
                                            if ($donHang['trang_thai_id'] == 1) {
                                                $colorAlerts = 'primary';
                                            } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                                                $colorAlerts = 'warning';
                                            } elseif ($donHang['trang_thai_id'] == 10) {
                                                $colorAlerts = 'success';
                                            } else {
                                                $colorAlerts = 'danger';
                                            }
                                            ?>
                                        <div class="alert alert-<?= $colorAlerts ?>" role="alert">
                                            Đơn Hàng:<?= $donHang['ten_trang_thai'] ?>
                                        </div>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href=""><input name="dongydathang" type="submit" class="btn btn-style-3" value="Tiếp tục mua hàng"></a> -->

                <div class="row">
                    <div class="col-12">
                        <div class="cart-table table-content table-responsive">
                            <table class="table mb--30">
                                <thead>
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tong_tien = 0;  ?>
                                    <?php foreach ($sanPhamDonHang as $key => $sanPham): ?>
                                        <tr>
                                            <td class="wide-column"><?= $key + 1 ?></td>
                                            <td class="wide-column">
                                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px" class="product-image" alt="Product Image">
                                            </td>
                                            <td class="wide-column"><?= $sanPham['ten_san_pham'] ?></td>
                                            <td class="wide-column"><?= formatPrice($sanPham['don_gia']) . ' đ' ?></td>
                                            <td class="wide-column"><?= $sanPham['so_luong'] ?></td>
                                            <td class="wide-column"><?= formatPrice($sanPham['thanh_tien']) . ' đ'  ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>








    <?php include_once './views/layout/footer.php' ?>