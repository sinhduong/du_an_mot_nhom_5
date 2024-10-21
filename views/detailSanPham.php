<?php require_once 'layout/header.php' ?>
<div class="wrapper bg--shaft">
    <?php require_once 'layout/menu.php' ?>
    <div class="main-content-wrapper">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Chi tiết sản phẩm</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-wrapper">
            <div class="single-products-area section-padding section-md-padding">
                <div class="container">
                    <section class="mirora-single-product pb--80 pb-md--60">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="tab-content product-details-thumb-large" id="myTabContent-3">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham): ?>
                                        <div class="tab-pane fade <?= $key === 0 ? 'show active' : '' ?>" id="product-large-<?= $key ?>">
                                            <div class="product-details-img easyzoom">
                                                <a class="popup-btn" href="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>">
                                                    <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="product-details-thumbnail">
                                    <div class="thumb-menu product-details-thumb-menu nav-vertical-center" id="thumbmenu-horizontal">
                                        <?php foreach ($listAnhSanPham as $key => $anhSanPham): ?>
                                            <div class="thumb-menu-item">
                                                <a href="#product-large-<?= $key ?>" data-bs-toggle="tab" class="nav-link <?= $key === 0 ? 'active' : '' ?>">
                                                    <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product thumb">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-content">
                                    <div class="product-details-top">
                                        <h2 class="product-details-name"><?= $sanPham['ten_san_pham'] ?></h2>
                                        <div class="ratings-wrap">
                                            <div class="ratings">
                                                <i class="fa fa-star rated"></i>
                                                <i class="fa fa-star rated"></i>
                                                <i class="fa fa-star rated"></i>
                                                <i class="fa fa-star rated"></i>
                                                <i class="fa fa-star rated"></i>
                                            </div>
                                            <span>
                                                <?php $countComment = count($listBinhLuan); ?>
                                                <a class="review-btn" href="#singleProductTab"><?= $countComment . ' bình luận' ?></a>
                                            </span>
                                        </div>
                                        <ul class="product-details-list list-unstyled">
                                            <li>Danh mục: <a href="#"><?= $sanPham['ten_danh_muc'] ?></a></li>
                                            <li>Mô tả : <?= $sanPham['mo_ta'] ?></li>
                                        </ul>
                                        <div class="product-price-wrapper">
                                            <?php if ($sanPham['gia_khuyen_mai']>0) { ?>
                                                <span class="money"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?></span>
                                                <span class="product-price-old">
                                                    <span class="money"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                                </span>
                                            <?php } else { ?>
                                                <span class="money"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="product-details-bottom">

                                        <p class="product-details-availability"><i class="fa fa-check-circle"></i><?= $sanPham['so_luong'] . ' Trong kho' ?></p>
                                        <div class="product-details-action-wrapper mb--20">
                                            <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST">
                                                <div class="product-details-action-top d-flex align-items-center mb--20">
                                                    <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                    <div class="quantity mb-lg-2 w-25">
                                                        <span>Qty: </span>
                                                        <input type="number" class="quantity-input w-50" name="so_luong" id="pro_qty" value="1" min="1">
                                                    </div>
                                                    <button type="submit" class="btn btn-medium btn-style-2 add-to-cart">
                                                        Thêm
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="product-details-action-bottom">
                                            </div>
                                        </div>
                                        <p class="product-details-tags">
                                        </p>
                                        <div class="social-share">
                                            <a href="#" rel="noopener noreferrer" class="facebook share-button">
                                                <i class="fa fa-facebook"></i>
                                                <span>Like</span>
                                            </a>
                                            <a href="#" rel="noopener noreferrer" class="twitter share-button">
                                                <i class="fa fa-twitter"></i>
                                                <span>Tweet</span>
                                            </a>
                                            <a href="#" class="share share-button">
                                                <i class="fa fa-plus-square"></i>
                                                <span>Share</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="product-details-tab bg--dark-4 ptb--80 ptb-md--60">
                        <div class="row">
                            <div class="col-12">
                                <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                                    <li class="nav-item product-details-tab-item">
                                        <a class="nav-link product-details-tab-link" id="nav-review-tab" data-bs-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">Bình luận (<?= $countComment ?>)</a>
                                    </li>
                                </ul>
                                <div class="product-details-tab-content tab-content">
                                    <div class="tab-pane fade show active" role="tabpanel" id="nav-review" aria-labelledby="nav-review-tab">
                                        <div class="product-details-review-wrap">
                                            <div class="review mb--40">
                                                <?php foreach ($listBinhLuan as $binhLuan): ?>
                                                    <div class="review__single d-flex align-items-start">
                                                        <div class="review__avatar me-3">
                                                            <?php if (!$binhLuan['anh_dai_dien']) { ?>
                                                                <img src="https://lienquan.garena.vn/wp-content/uploads/2024/05/2225114632e2b46f7cf7b9fe6386f7db5a55d2269d2721.jpg" alt="Avatar" class="rounded-circle" style="width: 100px; height: 50px; object-fit: cover;">
                                                            <?php } else { ?>
                                                                <img src="<?= $binhLuan['anh_dai_dien'] ?>" alt="Avatar" class="rounded-circle" style="width: 100px; height: 50px; object-fit: cover;">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="review__content flex-grow-1" style="min-height: 100px;">
                                                            <div class="review__meta">
                                                                <p class="review__author"><?= $binhLuan['ho_ten'] ?></p>
                                                                <p class="review__date">Ngày đăng: <?= $binhLuan['ngay_dang'] ?></p>
                                                            </div>
                                                            <div class="review__text">
                                                                <?= $binhLuan['noi_dung'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (isset($_SESSION['id'])): ?>
                                                <?php if (isset($_SESSION['cmt_err'])) : ?>
                                                    <p class="text-danger fs-16 fw-300"><?= $_SESSION['cmt_err'] ?></p>
                                                <?php endif;
                                                unset($_SESSION['cmt_err']) ?>
                                                <form action="<?= BASE_URL . '?act=add-binh-luan' ?>" method="post" class="form form--review">
                                                    <div class="form__group clearfix mb--20">
                                                        <input type="hidden" name="san_pham_id" value="<?= $id ?>">
                                                        <input type="hidden" name="tai_khoan_id" value="<?= $_SESSION['id'] ?>">
                                                        <label class="form__label d-block" for="review">Nội dung bình luận <sup>*</sup></label>
                                                        <textarea id="review" name="noi_dung" class="form__input form__input--textarea"></textarea>
                                                        <?php if (isset($error['noi_dung'])) { ?>
                                                            <p class="text-danger"><?= $error['noi_dung'] ?></p>
                                                        <?php } ?>
                                                        <button type="submit" class="btn btn-medium btn-style-2 add-to-cart" style="float: right;">
                                                            Thêm
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php else: ?>
                                                <p class="text-danger">Bạn phải đăng nhập để bình luận</p>
                                                <a href="<?= BASE_URL . '?act=login' ?>" class="btn btn-medium btn-style-2">Login</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="related-products-area pt--80 pb--20 pb-md--15 pt-md--60">
                        <div class="row">
                            <div class="col-12 mb--20">
                                <div class="section-title">
                                    <h2>Sản phẩm liên quan</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product-carousel js-product-carousel-2">
                                    <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
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
                                                        <?php if ($sanPham['gia_khuyen_mai']>0) { ?>
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
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
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
    </script>
    <?php include_once 'layout/footer.php' ?>