<?php require_once './views/layout/header.php' ?>
<div class="wrapper bg--shaft">
    <?php require_once './views/layout/menu.php' ?>
    <div class="main-content-wrapper">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Sản phẩm theo tìm kiếm</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content product-tab__content" id="product-tabContent">
            <div class="tab-pane fade show active" id="nav-featured" role="tabpanel">
                <div class="product-carousel js-product-carousel">
                    <?php if (empty($tiemKiemSP)): ?>
                        <h3>không tìm thấy sản phẩm</h3>
                    <?php else: ?>
                        <?php foreach ($tiemKiemSP as $key => $sanPham): ?>
                            <div class="product-carousel-group">
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="<?= BASE_URL .  $sanPham['hinh_anh'] ?>" alt="Product" class="primary-image" />
                                        <img src="<?= BASE_URL .  $sanPham['hinh_anh'] ?>" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <?php
                                            $ngay_nhap = new DateTime($sanPham['ngay_nhap']);
                                            $ngayHienTai = new DateTime();
                                            $tinhNgay = $ngayHienTai->diff($ngay_nhap);
                                            if ($tinhNgay->days <= 7) {
                                            ?>
                                                <span class="product-label ">
                                                    Mới
                                                </span>
                                            <?php
                                            }
                                            ?>
                                            <?php if ($sanPham['gia_khuyen_mai']) {
                                            ?>
                                                <span class="product-label discount">
                                                    Giảm giá
                                                </span>
                                            <?php } ?>
                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Chi tiết</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a></h4>
                                        <div class="product-price-wrapper">
                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                <span class="money"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?></span>
                                                <span class="product-price-old">
                                                    <span class="money"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                                </span>
                                            <?php } else { ?>
                                                <span class="money"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="mirora_product_action text-center position-absolute">
                                        <div class="product-rating">
                                            <span>
                                                <i class="fa fa-star theme-star"></i>
                                                <i class="fa fa-star theme-star"></i>
                                                <i class="fa fa-star theme-star"></i>
                                                <i class="fa fa-star theme-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content...
                                        </p>
                                        <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST">
                                            <div class="product-action">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                <input type="hidden" name="so_luong" value="1">
                                                <button type="submit" class="add_cart cart-item action-cart" title="wishlist">
                                                    <span>Thêm giỏ</span>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <?php include_once './views/layout/footer.php' ?>