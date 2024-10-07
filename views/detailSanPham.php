<?php require_once 'layout/header.php' ?>


<!-- Main Wrapper Start -->
<div class="wrapper bg--shaft">
    <!-- Header Area Start -->
    <?php require_once 'layout/menu.php' ?>
    <!-- Header Area End -->

    <!-- Main Content Wrapper Start -->
    <div class="main-content-wrapper">


        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Chi tiết sản phẩm</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                            <!-- <li class="current"><a href="product-details.html">Chi tiết sản phẩm</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-wrapper">
            <div class="single-products-area section-padding section-md-padding">
                <div class="container">
                    <!-- Single Product Start -->
                    <section class="mirora-single-product pb--80 pb-md--60">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Tab Content Start -->
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
                                <!-- Tab Content End -->

                                <!-- Product Thumbnail Carousel Start -->
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
                                <!-- Product Thumbnail Carousel End -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Single Product Content Start -->
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
                                                <!-- <a class="review-btn" href="#singleProductTab">write a review</a> -->
                                            </span>
                                        </div>
                                        <ul class="product-details-list list-unstyled">
                                            <li>Danh mục: <a href="#"><?= $sanPham['ten_danh_muc'] ?></a></li>
                                            <li>Mô tả : <?= $sanPham['mo_ta'] ?></li>
                                        </ul>
                                        <!-- product-details-price-wrapper -->
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

                                    <div class="product-details-bottom">

                                        <p class="product-details-availability"><i class="fa fa-check-circle"></i><?=$sanPham['so_luong'].' Trong kho'?></p>
                                        <div class="product-details-action-wrapper mb--20">
                                            <div class="product-details-action-top d-flex align-items-center mb--20">
                                                <div class="quantity">
                                                    <span>Qty: </span>
                                                    <input type="number" class="quantity-input" name="qty" id="pro_qty" value="1" min="1">
                                                </div>
                                                <button type="button" class="btn btn-medium btn-style-2 add-to-cart">
                                                    Add To Cart
                                                </button>
                                            </div>
                                            <div class="product-details-action-bottom">
                                                <a href="wishlist.html">+Add to wishlist</a>
                                                <a href="compare.html">+Add to compare</a>
                                            </div>
                                        </div>
                                        <p class="product-details-tags">
                                            Tags: <a href="shop.html">Sport</a>,
                                            <a href="shop.html">Luxury</a>
                                        </p>
                                        <div class="social-share">
                                            <a href="https://facebook.com/" target="_blank" rel="noopener noreferrer" class="facebook share-button">
                                                <i class="fa fa-facebook"></i>
                                                <span>Like</span>
                                            </a>
                                            <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" class="twitter share-button">
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
                                <!-- Single Product Content End -->
                            </div>
                        </div>
                    </section>
                    <!-- Single Product End -->

                    <!-- Single Product Tab Start -->
                    <section class="product-details-tab bg--dark-4 ptb--80 ptb-md--60">
                        <div class="row">
                            <div class="col-12">
                                <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                                    <li class="nav-item product-details-tab-item">
                                        <a class="nav-link product-details-tab-link active" id="nav-desc-tab" data-bs-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item product-details-tab-item">
                                        <a class="nav-link product-details-tab-link" id="nav-details-tab" data-bs-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Additional Information</a>
                                    </li>

                                    <li class="nav-item product-details-tab-item">
                                        <a class="nav-link product-details-tab-link" id="nav-review-tab" data-bs-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">review (2)</a>
                                    </li>
                                </ul>
                                <div class="product-details-tab-content tab-content">
                                    <div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
                                        <p class="product-details-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero.</p>
                                        <p class="product-details-description">
                                            Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi.
                                        </p>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="nav-details" aria-labelledby="nav-details-tab">
                                        <div class="product-details-additional-info">
                                            <h3>Additional Information</h3>
                                            <div class="table-content table-responsive">
                                                <table class="shop_attributes">
                                                    <tr>
                                                        <th>Color: </th>
                                                        <td>
                                                            <p>Black, Blue, Gold</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Size: </th>
                                                        <td>
                                                            <p>XXL, XL, L, M</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="nav-review" aria-labelledby="nav-review-tab">
                                        <div class="product-details-review-wrap">
                                            <h2 class="mb--20">2 REVIEWS FOR ALIQUAM LOBORTIS</h2>
                                            <div class="review mb--40">
                                                <div class="review__single">
                                                    <div class="review__meta">
                                                        <p class="review__author">HasTech</p>
                                                        <p class="review__date">October 12, 2014</p>
                                                    </div>
                                                    <div class="review__content">
                                                        <p class="review__text">
                                                            It’s both good and bad. If Nikon had achieved a high-quality wide lens camera with a 1 inch sensor, that would have been a very competitive product. So in that sense, it’s good for us. But actually, from the perspective of driving the 1 inch sensor market, we want to stimulate this market and that means multiple manufacturers.
                                                        </p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review__single">
                                                    <div class="review__meta">
                                                        <p class="review__author">HasTech</p>
                                                        <p class="review__date">October 12, 2014</p>
                                                    </div>
                                                    <div class="review__content">
                                                        <p class="review__text">
                                                            It’s both good and bad. If Nikon had achieved a high-quality wide lens camera with a 1 inch sensor, that would have been a very competitive product. So in that sense, it’s good for us. But actually, from the perspective of driving the 1 inch sensor market, we want to stimulate this market and that means multiple manufacturers.
                                                        </p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="mb--20">Add a Review</h2>
                                            <form class="form form--review">
                                                <div class="form__group clearfix mb--20">
                                                    <label class="form__label d-block">Your Ratings</label>
                                                    <div class="rating">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label class="full" for="star5" title="Awesome - 5 stars">
                                                        </label>
                                                        <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars">
                                                        </label>
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label class="full" for="star4" title="Pretty good - 4 stars">
                                                        </label>
                                                        <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                                        <label class="half" for="star3half" title="Meh - 3.5 stars">
                                                        </label>
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label class="full" for="star3" title="Meh - 3 stars">
                                                        </label>
                                                        <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars">
                                                        </label>
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label class="full" for="star2" title="Kinda bad - 2 stars">
                                                        </label>
                                                        <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                                        <label class="half" for="star1half" title="Meh - 1.5 stars">
                                                        </label>
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label class="full" for="star1" title="Sucks big time - 1 star">
                                                        </label>
                                                        <input type="radio" id="starhalf" name="rating" value="half" />
                                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form__group clearfix mb--20">
                                                    <label class="form__label d-block" for="review_name">Name <sup>*</sup></label>
                                                    <input id="review_name" name="review_name" class="form__input">
                                                </div>
                                                <div class="form__group clearfix mb--20">
                                                    <label class="form__label d-block" for="review_email">Email <sup>*</sup></label>
                                                    <input id="review_email" name="review_email" class="form__input">
                                                </div>
                                                <div class="form__group clearfix mb--20">
                                                    <label class="form__label d-block" for="review">Your Review <sup>*</sup></label>
                                                    <textarea id="review" name="review" class="form__input form__input--textarea"></textarea>
                                                    <div class="help-block">
                                                        <span>Note: </span>
                                                        HTML is not translated!
                                                    </div>
                                                </div>
                                                <div class="form__group text-right">
                                                    <button type="submit" class="btn btn-medium btn-style-1">Continue</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Single Product Tab End -->

                    <!-- Related Product Start -->
                    <section class="related-products-area pt--80 pb--20 pb-md--15 pt-md--60">
                        <div class="row">
                            <div class="col-12 mb--20">
                                <div class="section-title">
                                    <h2>Related Products</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                    </section>
                    <!-- Related Product End -->
                </div>
            </div>
        </div>



    </div>


    <?php include_once 'layout/footer.php' ?>