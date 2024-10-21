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
                    <h1 class="page-title">Giỏ hàng</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="<?= BASE_URL ?>">trang chủ</a></li>
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
                            <div class="cart-table table-content table-responsive">
                                <table class="table mb--30">
                                    <thead>
                                        <tr>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá tiền</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tongGioHang = 0;
                                        foreach ($chiTietGioHang as $sanPham):
                                        ?>
                                            <tr data-id="<?= $sanPham['id'] ?>" class="cart-item">

                                                <td>
                                                    <a href="product-details.html">
                                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    </a>
                                                </td>
                                                <td class="wide-column">
                                                    <h3><a href="#"><?= $sanPham['ten_san_pham'] ?></a></h3>
                                                </td>
                                                <td class="cart-product-price"><strong>
                                                        <?= $sanPham['gia_khuyen_mai'] ? formatPrice($sanPham['gia_khuyen_mai']) . 'đ' : formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                                    </strong></td>
                                                <td>
                                                    <div class="quantity d-flex mb-20">
                                                        <button class="dec qtybutton"><i class="fa fa-angle-down"></i></button>
                                                        <input type="number" class="quantity-input w-75" name="quantity[<?= $sanPham['san_pham_id'] ?>]" data-id="<?= $sanPham['id'] ?>" data-price="<?= $sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham'] ?>" value="<?= $sanPham['so_luong'] ?>" min="1">
                                                        <button class="inc qtybutton"><i class="fa fa-angle-up"></i></button>
                                                    </div>
                                                </td>
                                                <td class="cart-product-price total-price"><strong>
                                                        <?php
                                                        $tongTien = $sanPham['gia_khuyen_mai'] ? $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'] : $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        $tongGioHang += $tongTien;
                                                        echo formatPrice($tongTien) . 'đ';
                                                        ?>
                                                    </strong></td>
                                                <td>
                                                    <form method="POST" action="<?= BASE_URL . '?act=delete-san-pham-gio-hang' ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="cart_detail_id" value="<?= $sanPham['id'] ?>">
                                                        <button type="submit"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="cart-page-total-wrapper">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-8 col-md-10">

                            <form action="<?= BASE_URL . '?act=thanh-toan' ?>" method="POST">
                                <div class="cart-page-total bg--dark-3">
                                    <h2>Cart Totals</h2>
                                    <div class="cart-calculator-table table-content table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Tổng tiền sản phẩm</th>
                                                    <td><span class="sub-total price-ammount"><?= formatPrice($tongGioHang) . 'đ' ?></span></td>
                                                </tr>
                                                <?php if (isset($chiTietGioHang) && count($chiTietGioHang) > 0) { ?>
                                                    <tr class="shipping">
                                                        <th>Vận chuyển</th>
                                                        <td>
                                                            <span class="price-ammount">30.000đ</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart-total">
                                                        <th>Thanh toán</th>
                                                        <td><span class="total-amount price-ammount"><?= formatPrice($tongGioHang + 30000) . 'đ' ?></span></td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr class="shipping">
                                                        <th>Vận chuyển</th>
                                                        <td>
                                                            <span class="price-ammount">0đ</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart-total">
                                                        <th>Thanh toán</th>
                                                        <td><span class="total-amount price-ammount">0đ</span></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (isset($chiTietGioHang) && count($chiTietGioHang) > 0) { ?>
                                        <button type="submit" class="btn btn-medium btn-style-3">Đặt hàng</button>
                                    <?php } else { ?>
                                        <a href="<?= BASE_URL ?>">
                                            <p class="btn btn-medium btn-style-3">Thêm sản phẩm vào giỏ nào</p>
                                        </a>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                // Lấy giá trị hiện tại của input
                let quantity = parseInt(this.value);

                // Kiểm tra nếu số lượng nhỏ hơn 1
                if (quantity < 1) {
                    // Hiển thị thông báo lỗi
                    alert('Số lượng phải lớn hơn hoặc bằng 1');

                    // Đặt lại giá trị thành 1
                    this.value = 1;
                }
            });
        });

        $(document).ready(function() {
            // Gán sự kiện chỉ một lần cho các nút tăng giảm
            $('.qtybutton').off('click').on('click', function() {
                var $button = $(this);
                var $input = $button.closest('.quantity').find('.quantity-input');
                var currentVal = parseInt($input.val());
                var price = parseFloat($input.data('price'));
                var cartId = parseInt($input.data('id'))
                // Kiểm tra nút nào đã được nhấp
                if ($button.hasClass('inc')) {
                    // Tăng thêm 1
                    $input.val(currentVal + 1);
                    return window.location.href = '<?= BASE_URL ?>' + "?act=incQty&id=" + cartId
                } else if ($button.hasClass('dec')) {
                    // Giảm đi 1, đảm bảo giá trị không giảm xuống dưới 1
                    if (currentVal > 1) {
                        $input.val(currentVal - 1);
                        return window.location.href = '<?= BASE_URL ?>' + "?act=decQty&id=" + cartId
                    }
                }

                // Cập nhật tổng sau khi thay đổi số lượng
                updateTotal();
            });

            $('.delete').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                $(this).closest('.cart-item').remove(); // Xóa sản phẩm khỏi giỏ hàng
                updateTotal();
            });

            function updateTotal() {
                var tongTien = 0;
                $('.cart-item').each(function() {
                    var $this = $(this);
                    var $input = $this.find('.quantity-input');
                    var price = parseFloat($input.data('price'));
                    var quantity = parseInt($input.val());
                    var totalPrice = price * quantity;
                    $this.find('.total-price').text(totalPrice.toLocaleString('vi-VN') + 'đ');
                    tongTien += totalPrice;
                });

                var vanChuyen = 30000; // Phí vận chuyển cố định
                $('.sub-total').text(tongTien.toLocaleString('vi-VN') + 'đ');
                $('.total-amount').text((tongTien + vanChuyen).toLocaleString('vi-VN') + 'đ');
            }
        });
    </script>



    <?php include_once 'layout/footer.php' ?>