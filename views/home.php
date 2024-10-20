    <?php require_once 'layout/header.php' ?>


    <!-- Main Wrapper Start -->
    <div class="wrapper bg--shaft">
        <!-- Header Area Start -->
        <?php require_once 'layout/menu.php' ?>
        <!-- Header Area End -->

        <!-- Main Content Wrapper Start -->
        <div class="main-content-wrapper">
            <!-- Slider area Start -->

            <?php require_once 'layout/slider.php' ?>
            <!-- Slider area End -->


            <!-- Products Tab area Start -->

            <div class="product-tab pt--80 pb--60 pt-md--60 pb-md--45">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <ul class="nav nav-tabs product-tab__head" id="product-tab" role="tablist">
                                <li class="product-tab__item nav-item active">
                                    <a class="product-tab__link nav-link active" id="nav-featured-tab" data-bs-toggle="tab" href="#nav-featured" role="tab" aria-selected="true">Sản phẩm của chúng tôi</a>
                                </li>
                                <!-- <li class="product-tab__item nav-item">
                                    <a class="product-tab__link nav-link" id="nav-new-tab" data-bs-toggle="tab" href="#nav-new" role="tab" aria-selected="false">Sản Phẩm Mới</a>
                                </li>
                                <li class="product-tab__item nav-item">
                                    <a class="product-tab__link nav-link" id="nav-bestseller-tab" data-bs-toggle="tab" href="#nav-bestseller" role="tab" aria-selected="false">Bán Chạy</a>
                                </li>
                                <li class="product-tab__item nav-item">
                                    <a class="product-tab__link nav-link" id="nav-onsale-tab" data-bs-toggle="tab" href="#nav-onsale" role="tab" aria-selected="false">Giảm Giá</a>
                                </li> -->
                            </ul>
                            <div class="tab-content product-tab__content" id="product-tabContent">
                                <div class="tab-pane fade show active" id="nav-featured" role="tabpanel">
                                    <div class="product-carousel js-product-carousel">
                                        <?php foreach ($listSanPham as $key => $sanPham): ?>
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
                                                            <?php if ($sanPham['gia_khuyen_mai'] > 0) { ?>
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


                                                <!-- <div class="mirora-product">
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
                                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"  data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Chi tiết</a>

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
                                                        <div class="product-action">
                                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                                <i class="fa fa-heart-o"></i>
                                                            </a>
                                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> -->

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Tab area End -->

            <!-- Banner area Start -->

            <section class="banner-area banner-bg-1 ptb--80 ptb-md--60">
                <div class="banner-box text-center">
                    <h5 class="banner__label">Giảm giá 20% tất cả sản phẩm</h5>
                    <h2 class="banner__name">Bộ sưu tập xu hướng mới</h2>
                    <p class="banner__text mb--50 mb-md--20">Chúng tôi tin rằng thiết kế tốt luôn theo mùa</p>
                    <a href="shop.html" class="btn btn-bordered btn-style-1">Mua ngay</a>
                </div>
            </section>

            <!-- Banner area End -->

            <!-- Most Viewed Product area Start -->

            <!-- <section class="mostviewed-product-area border-bottom pt--80 pb--60 pt-md--60 pb-md--50">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title mb--15">
                                <h2 class="color--white">Sản phẩm được xem nhiều nhất</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="product-carousel nav-top js-product-carousel-2">
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/2-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/2-2-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/4-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/4-4-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/6-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/6-6-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/8-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/8-8-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/10-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/10-10-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/12-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/12-12-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mirora-product">
                                    <div class="product-img">
                                        <img src="assets/img/products/14-450x450.jpg" alt="Product" class="primary-image" />
                                        <img src="assets/img/products/14-14-450x450.jpg" alt="Product" class="secondary-image" />
                                        <div class="product-img-overlay">
                                            <span class="product-label discount">
                                                -7%
                                            </span>
                                            <a data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <span>Cartier</span>
                                        <h4><a href="product-details.html">Acer Aspire E 15</a></h4>
                                        <div class="product-price-wrapper">
                                            <span class="money">$550.00</span>
                                            <span class="product-price-old">
                                                <span class="money">$700.00</span>
                                            </span>
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
                                        <div class="product-action">
                                            <a class="same-action" href="wishlist.html" title="wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                            <a class="add_cart cart-item action-cart" href="cart.html" title="wishlist"><span>Add to cart</span></a>
                                            <a class="same-action compare-mrg" data-bs-toggle="modal" data-bs-target="#productModal" href="compare.html">
                                                <i class="fa fa-sliders fa-rotate-90"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- Most Viewed Product area End -->

            <!-- Blog area Start -->

            <!-- <section class="blog-area pt--80 pb--40 pt-md--60 pb-md--30">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title mb--30">
                                <h2>Mẫu Blog của chúng tôi</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-carousel nav-top slick-item-gutter">
                                <article class="blog">
                                    <a href="blog-details-image.html" class="blog__thumb">
                                        <img src="assets/img/blog/post1-370x230.jpg" alt="Blog">
                                    </a>
                                    <div class="blog__content">
                                        <div class="blog__meta">
                                            <p class="blog__author">Post By: <a href="blog.html"></a></p>
                                            <p class="blog__date"><a href="blog.html">20 Oct 2024</a></p>
                                        </div>

                                        <h3 class="blog__title"><a href="blog-details-image.html"></a></h3>
                                        <div class="blog__text">
                                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula.</p>
                                            <a class="read-more" href="blog-details-image.html">Read More</a>
                                        </div>

                                    </div>
                                </article>
                                <article class="blog">
                                    <a href="blog-details-image.html" class="blog__thumb">
                                        <img src="assets/img/blog/post2-370x230.jpg" alt="Blog">
                                    </a>
                                    <div class="blog__content">
                                        <div class="blog__meta">
                                            <p class="blog__author">Post By: <a href="blog.html">HasTech</a></p>
                                            <p class="blog__date"><a href="blog.html">20 Oct 2024</a></p>
                                        </div>

                                        <h3 class="blog__title"><a href="blog-details-image.html">Mollis aliquet ante, suscipit non eget nulla libero, vestibulum condimentum.</a></h3>
                                        <div class="blog__text">
                                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula.</p>
                                            <a class="read-more" href="blog-details-image.html">Read More</a>
                                        </div>

                                    </div>
                                </article>
                                <article class="blog">
                                    <a href="blog-details-image.html" class="blog__thumb">
                                        <img src="assets/img/blog/post3-370x230.jpg" alt="Blog">
                                    </a>
                                    <div class="blog__content">
                                        <div class="blog__meta">
                                            <p class="blog__author">Post By: <a href="blog.html">HasTech</a></p>
                                            <p class="blog__date"><a href="blog.html">20 Oct 2024</a></p>
                                        </div>

                                        <h3 class="blog__title"><a href="blog-details-image.html">Mollis aliquet ante, suscipit non eget nulla libero, vestibulum condimentum.</a></h3>
                                        <div class="blog__text">
                                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula.</p>
                                            <a class="read-more" href="blog-details-image.html">Read More</a>
                                        </div>

                                    </div>
                                </article>
                                <article class="blog">
                                    <a href="blog-details-image.html" class="blog__thumb">
                                        <img src="assets/img/blog/post4-370x230.jpg" alt="Blog">
                                    </a>
                                    <div class="blog__content">
                                        <div class="blog__meta">
                                            <p class="blog__author">Post By: <a href="blog.html">HasTech</a></p>
                                            <p class="blog__date"><a href="blog.html">20 Oct 2024</a></p>
                                        </div>

                                        <h3 class="blog__title"><a href="blog-details-image.html">Mollis aliquet ante, suscipit non eget nulla libero, vestibulum condimentum.</a></h3>
                                        <div class="blog__text">
                                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula.</p>
                                            <a class="read-more" href="blog-details-image.html">Read More</a>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--35 mt-md--25">
                        <div class="col-12 text-center">
                            <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" class="btn btn-medium btn-style-2"><i class="fa fa-instagram"></i>Instagram</a>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- Blog area End -->

            <!-- Newsletter area End -->

            <div class="newsletter-area pt--40 pb--80 pt-md--30 pb-md--60">
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- <div class="col-xl-9 col-lg-10">
                            <div class="newsletter text-center">
                                <h3 class="color--white">Tham gia bản tin của chúng tôi ngay bây giờ!</h3>
                                <p>Typi non habent claritatem insitam est usus legentis in qui facit eorum claritatem, investigationes demonstraverunt lectores legere me lius quod legunt saepius.</p>

                                <form class="newsletter-form validate mt--40" action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-newsletter-form" name="mc-embedded-newsletter-form" target="_blank" novalidate="">
                                    <input type="email" name="email" id="sub_email" placeholder="Enter your email address here.." class="newsletter-form__input">
                                    <input type="submit" value="Subscribe" class="btn newsletter-btn btn-style-1">
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Newsletter area End -->

            <!-- Promo Box area Start -->

            <div class="promo-box-area">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-md-6 mb-sm--20">
                            <div class="promo">
                                <a href="shop.html" class="promo__box promo__box-2">
                                    <img src="assets/img/banner/img1-bottom-mirora1.jpg" alt="Product Category">
                                    <span class="promo__content promo__content-2">
                                        <span class="promo__label">New Arrivals 2024</span>
                                        <span class="promo__name">Luxury Perfume 2024</span>
                                        <span class="promo__price">Men's and Woman's Accessories</span>
                                        <span class="promo__link">Discover Now</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="promo">
                                <a href="shop.html" class="promo__box promo__box-2">
                                    <img src="assets/img/banner/img2-bottom-mirora1.jpg" alt="Product Category">
                                    <span class="promo__content promo__content-2">
                                        <span class="promo__label">Trending Products 2024</span>
                                        <span class="promo__name">Maurice Lacroix Watch</span>
                                        <span class="promo__price">Only from $162.00 - Sale 20% Off</span>
                                        <span class="promo__link">Discover Now</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promo Box area End -->
        </div>
        <!-- Main Content Wrapper Start -->

        <?php include_once 'layout/footer.php' ?>