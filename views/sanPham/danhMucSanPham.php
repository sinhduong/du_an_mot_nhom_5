<?php require_once './views/layout/header.php' ?>
<div class="wrapper bg--shaft">
    <?php require_once './views/layout/menu.php' ?>
    <div class="main-content-wrapper">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">danh mục</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content-wrapper">
            <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-2 mb-md--30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shop-toolbar">
                                        <div class="product-view-mode" data-default="3">
                                            <a class="grid-2" data-target="gridview-2" data-bs-toggle="tooltip" data-bs-placement="top" title="2">2</a>
                                            <a class="active grid-3" data-target="gridview-3" data-bs-toggle="tooltip" data-bs-placement="top" title="3">3</a>
                                            <a class="grid-4" data-target="gridview-4" data-bs-toggle="tooltip" data-bs-placement="top" title="4">4</a>
                                            <a class="grid-5" data-target="gridview-5" data-bs-toggle="tooltip" data-bs-placement="top" title="5">5</a>
                                            <a class="list" data-target="listview" data-bs-toggle="tooltip" data-bs-placement="top" title="5">List</a>
                                        </div>
                                        <div class="product-short">

                                            <!-- <?php $filter = isset($_GET['filter']) ? $_GET['filter'] : ''; ?> -->

                                            <select class="short-select nice-select" onchange="location = this.value;">
                                                <option value="<?= BASE_URL . '?act=san-pham&filter=re'; ?>" <?= $filter == 're' ? 'selected' : ''; ?>>Sản phẩm giá rẻ</option>
                                                <option value="<?= BASE_URL . '?act=san-pham&filter=dat'; ?>" <?= $filter == 'dat' ? 'selected' : ''; ?>>Sản phẩm giá đắt</option>
                                                <option value="<?= BASE_URL . '?act=san-pham&filter=ngay_nhap'; ?>" <?= $filter == 'ngay_nhap' ? 'selected' : ''; ?>>Sản phẩm mới</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!-- Shop Toolbar End -->
                                </div>
                            </div>

                            <!-- Main Shop wrapper Start -->
                            <div class="shop-product-wrap grid gridview-3 row no-gutters">
                                <?php foreach ($listSanPham as $key => $sanPham): ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                        <div class="mirora-product mb-md--10">
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
                                        <div class="mirora-product-list">
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
                                            <div class="product-content">
                                                <span>Cartier</span>
                                                <h4><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a></h4>
                                                <div class="product-rating">
                                                    <span>
                                                        <i class="fa fa-star theme-star"></i>
                                                        <i class="fa fa-star theme-star"></i>
                                                        <i class="fa fa-star theme-star"></i>
                                                        <i class="fa fa-star theme-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </div>
                                                <p class="product-desc">
                                                    It is a long established fact that a reader will be distracted by the readable content...
                                                </p>
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
                            </div>
                            <!-- Main Shop wrapper End -->

                            <!-- Pagination Start -->
                            <div class="pagination-wrap mt--15 mt-md--10">
                                <p class="page-ammount">Showing 1 to 9 of 15 (2 Pages)</p>
                                <ul class="pagination">
                                    <li><a href="#" class="first">|&lt;</a></li>
                                    <li><a href="#" class="prev">&lt;</a></li>
                                    <li><a href="#" class="current">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#" class="next">&gt;</a></li>
                                    <li><a href="#" class="next">&gt;|</a></li>
                                </ul>
                            </div>
                            <!-- Pagination End -->
                        </div>
                        <div class="col-lg-3 order-lg-1">
                            <aside class="shop-sidebar">
                                <div class="search-filter">
                                    <div class="filter-layered">
                                        <h3 class="filter-heading">Danh mục sản phẩm</h3>
                                        <ul class="filter-list">
                                            <?php foreach ($listDanhMuc as $danhmuc): ?>
                                                <li class="menu has-children">
                                                <li>
                                                    <span><?= $danhmuc['ten_danh_muc'] ?></span><a href="#"><i class="fa fa-time"></i></a>
                                                </li>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    </div>
                                    <!-- <div class="filter-price">
                                        <h3 class="filter-heading">Price</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-1" checked>
                                                    <label for="pricerange-1">$55 - $100 (3)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-2">
                                                    <label for="pricerange-2">$55 - $200 (2)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-3">
                                                    <label for="pricerange-3">$300 - $500 (6)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-4">
                                                    <label for="pricerange-4">$700 - $1000 (2)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="filter-categories">
                                        <h3 class="filter-heading">Categories</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="category1" id="category1" checked>
                                                    <label for="category1">Category1</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="category2" id="category2">
                                                    <label for="category2">Category2</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="category3" id="category3">
                                                    <label for="category3">Category3</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="category4" id="category4">
                                                    <label for="category4">Category4</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="category5" id="category5">
                                                    <label for="category5">Category5</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="filter-color">
                                        <h3 class="filter-heading">Color</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="black" id="black">
                                                    <label for="black">black (3)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="blue" id="blue">
                                                    <label for="blue">blue (6)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="brown" id="brown">
                                                    <label for="brown">brown (7)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="white" id="white">
                                                    <label for="white">white (4)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="red" id="red">
                                                    <label for="red">red (1)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="filter-color">
                                        <h3 class="filter-heading">Manufacturer</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="ferragamo" id="ferragamo">
                                                    <label for="ferragamo">ferragamo (11)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="hermes" id="hermes">
                                                    <label for="hermes">hermes (9)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="louis" id="louis">
                                                    <label for="louis">louis vuitton (11)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="christian" id="christian">
                                                    <label for="christian">Christian Dior (8)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="banner-static">
                                    <a href="#">
                                        <img src="assets/img/banner/img-sidebar.jpg" alt="Banner">
                                    </a>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include_once './views/layout/footer.php' ?>