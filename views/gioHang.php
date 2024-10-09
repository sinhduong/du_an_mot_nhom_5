<?php require_once 'layout/header.php' ?>


<!-- Main Wrapper Start -->
<div class="wrapper bg--shaft">
    <!-- Header Area Start -->
    <?php require_once 'layout/menu.php' ?>
    <!-- Header Area End -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Cart</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="cart.html">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-wrapper">
        <div class="cart-area pt--40 pb--80 pt-md--30 pb-md--60">
            <div class="container">
                <div class="cart-wrapper bg--2 mb--80 mb-md--60">
                    <div class="row">
                        <div class="col-12">
                            <!-- Cart Area Start -->
                            <form action="#" class="form cart-form">
                                <div class="cart-table table-content table-responsive">
                                    <table class="table mb--30 ">
                                        <thead>
                                            <tr>
                                                <th>Thao tác</th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá tiền</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tongGioHang = 0;
                                            foreach ($chiTietGioHang as $key => $sanPham):
                                            ?>

                                                <tr>
                                                    <td><a class="delete" href="#" data-id="<?= $sanPham['id'] ?>"><i class="fa fa-times"></i></a></td>
                                                    <td>
                                                        <a href="product-details.html">
                                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                        </a>
                                                    </td>
                                                    <td class="wide-column">
                                                        <h3><a href="product-details.html"><?= $sanPham['ten_san_pham'] ?></a></h3>
                                                    </td>
                                                    <td class="cart-product-price"><strong>
                                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                                <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?>
                                                            <?php } else { ?>
                                                                <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                                            <?php } ?>
                                                        </strong></td>
                                                    <td>
                                                        <div class="quantity d-flex mb-20">
                                                            <input type="number" class="quantity-input w-75" name="qty" id="pro_qty" value="<?= $sanPham['so_luong'] ?>" min="1">
                                                        </div>
                                                    </td>
                                                    <td class="cart-product-price"><strong>
                                                            <?php
                                                            $tongTien = 0;
                                                            if ($sanPham['gia_khuyen_mai']) {
                                                                $tongTien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                            } else {
                                                                $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                            }
                                                            $tongGioHang += $tongTien;
                                                            echo formatPrice($tongTien) . 'đ';
                                                            ?>
                                                        </strong></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-md-right">
                                        <div class="cart-btn-group">
                                            <a href=" " class="btn btn-medium btn-style-3">Cập nhật</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Cart Area End -->
                        </div>
                    </div>
                </div>
                <div class="cart-page-total-wrapper">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="cart-page-total bg--dark-3">
                                <h2>Cart Totals</h2>
                                <div class="cart-calculator-table table-content table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Tổng tiền sản phẩm</th>
                                                <td><span class="price-ammount"><?= formatPrice($tongGioHang) . 'đ' ?></span></td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Vận chuyển</th>
                                                <td>
                                                    <span class="price-ammount">30.000đ</span>
                                                </td>
                                            </tr>
                                            <tr class="cart-total">
                                                <th>Thanh toán</th>
                                                <td><span class="price-ammount"><?= formatPrice($tongGioHang + 30000) . 'đ' ?></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="checkout.html" class="btn btn-medium btn-style-3">Đặt hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hàm để cập nhật giá tổng cho một sản phẩm
            function updateTotalPrice($row) {
                var quantity = parseInt($row.find('.quantity-input').val());
                var price = $row.find('.cart-product-price strong').data('price');
                var totalPrice = quantity * price;
                $row.find('.cart-product-price strong').text(formatPrice(totalPrice) + 'đ');
                return totalPrice;
            }

            // Hàm định dạng giá
            function formatPrice(price) {
                return price.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).replace('₫', 'đ');
            }

            // Xử lý nhấp vào nút xóa
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var $row = $(this).closest('tr');

                $row.fadeOut(300, function() {
                    $(this).remove();
                    updateCartTotal(); // Cập nhật tổng giỏ hàng khi sản phẩm bị xóa
                });
            });

            // Xử lý thay đổi số lượng
            $('.quantity-input').on('input', function() {
                var $row = $(this).closest('tr');
                var quantity = parseInt($(this).val());

                // Nếu số lượng nhỏ hơn 1, đặt lại về 1
                if (quantity < 1) {
                    $(this).val(1);
                    quantity = 1;
                }

                var totalPrice = updateTotalPrice($row); // Cập nhật giá tổng cho sản phẩm
                updateCartTotal(); // Cập nhật tổng giỏ hàng
            });

            // Hàm để cập nhật tổng giỏ hàng
            function updateCartTotal() {
                var totalCart = 0;
                $('.cart-product-price strong').each(function() {
                    var price = parseFloat($(this).text().replace('đ', '').replace('.', '').trim());
                    totalCart += price;
                });

                // Cập nhật tổng tiền với phí vận chuyển
                var shippingCost = 30000; // phí vận chuyển
                var grandTotal = totalCart + shippingCost;
                $('.cart-page-total .price-ammount').text(formatPrice(grandTotal) + 'đ');
            }

            // Khởi tạo giá cho các sản phẩm
            $('.cart-product-price strong').each(function() {
                var price = parseFloat($(this).text().replace('đ', '').replace('.', '').trim());
                $(this).data('price', price); // Lưu giá sản phẩm vào data attribute
            });
        });
    </script>





    <?php include_once 'layout/footer.php' ?>