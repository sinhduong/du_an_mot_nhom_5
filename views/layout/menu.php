<header class="header headery-style-1">
    <div class="header-top header-top-1">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-8 d-flex align-items-center flex-column flex-lg-row">
                    <ul class="social social-round mr--20">
                        <li class="social__item">
                            <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" class="social__link">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="https://plus.google.com/" target="_blank" rel="noopener noreferrer" class="social__link">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="https://facebook.com/" target="_blank" rel="noopener noreferrer" class="social__link">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="https://youtube.com/" target="_blank" rel="noopener noreferrer" class="social__link">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" class="social__link">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <p class="header-text">Miễn phí vận chuyển cho tất cả các đơn hàng nội địa với mã phiếu giảm giá. <span>“Watches2024”</span></p>
                </div>
                <div class="col-lg-4">
                    <div class="header-top-nav d-flex justify-content-lg-end justify-content-center">
                        <!-- <div class="language-selector header-top-nav__item">
                            <div class="dropdown header-top__dropdown">
                                <a class="dropdown-toggle" id="languageID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Việt Nam
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="languageID">
                                    <a class="dropdown-item" href="#"><img src="assets/img/header/1.jpg" alt="Vietnam"> Việt Nam</a>
                                    <a class="dropdown-item" href="#"><img src="assets/img/header/2.jpg" alt="Korea"> Korea</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="currency-selector header-top-nav__item">
                            <div class="dropdown header-top__dropdown">
                                <?php if (isset($_SESSION['user_client'])): ?>
                                    <a class="dropdown-toggle" id="currencyID" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $_SESSION['user_client']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="user-info header-top-nav__item">
                            <div class="dropdown header-top__dropdown">
                                <a class="dropdown-toggle" id="userID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tài Khoản
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="userID">
                                    <?php if (!isset($_SESSION['user_client'])) { ?>
                                        <a class="dropdown-item" href="<?=BASE_URL .'?act=login'?>">Đăng Nhập</a>
                                    <?php } else { ?>
                                        <a class="dropdown-item" href="<?=BASE_URL .'?act=login'?>">Tài khoản</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-top-1">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md-5 col-sm-6 order-lg-1 order-2">
                    <div class="contact-info">
                        <img src="assets/img/icons/icon_phone.png" alt="Phone Icon">
                        <p>Call us <br> Free Support: (012) 800 456 789</p>
                    </div>
                </div>
                <div class="col-lg-2 col-12 order-lg-2 order-1 text-center">
                    <a href="<?= BASE_URL ?>" class="logo-box mb-md--30">
                        <img src="assets/img/logo/logo.png" alt="logo">
                    </a>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-6 order-lg-3 order-3">
                    <div class="header-toolbar">
                        <div class="search-form-wrapper search-hide">
                            <form action="#" class="search-form">
                                <input type="text" name="search" id="search" class="search-form__input" placeholder="Nhập tên sản phẩm...">
                                <button type="submit" class="search-form__submit">
                                    <i class="icon_search"></i>
                                </button>
                            </form>
                        </div>
                        <ul class="header-toolbar-icons">
                            <li class="search-box">
                                <a href="#" class="bordered-icon search-btn" aria-expanded="false"><i class="icon_search"></i></a>
                            </li>
                            <li class="wishlist-icon">
                                <!-- <a href="wishlist.html" class="bordered-icon"><i class="fa fa-heart"></i></a> -->
                            </li>
                            
                            <?php include_once './views/layout/miniCart.php'?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-top-1 position-relative navigation-wrap fixed-header">
        <div class="container position-static">
            <div class="row">
                <div class="col-12 position-static text-center">
                    <nav class="main-navigation">
                        <ul class="mainmenu">
                            <li class="mainmenu__item active menu-item-has-children has-children">
                                <a href="<?= BASE_URL ?>" class="mainmenu__link">Trang Chủ</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= BASE_URL ?>">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                </ul>
                            </li>
                            <li class="mainmenu__item menu-item-has-children">
                                <a href="#" class="mainmenu__link">Cửa Hàng</a>
                                <ul class="megamenu five-column">
                                    <li>
                                        <a class="megamenu-title" href="#">Shop Grid</a>
                                        <ul>
                                            <li>
                                                <a href="shop.html">Left Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="shop-right-sidebar.html">Right Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="shop-fullwidth.html">Three Column</a>
                                            </li>
                                            <li>
                                                <a href="shop-fullwidth-4-column.html">Four Column</a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class="mainmenu__item menu-item-has-children has-children">
                                <a href="blog.html" class="mainmenu__link">Blog</a>
                                <ul class="sub-menu">
                                    <li class="menu-item-has-children has-children">
                                        <a href="#">Blog Grid</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Left Sidebar</a></li>
                                            <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="blog-3-column.html">Three Column</a></li>
                                            <li><a href="blog-4-column.html">Four Column</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children has-children">
                                        <a href="#">Blog List</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-list.html">Full Width</a></li>
                                            <li><a href="blog-list-left-sidebar.html">left Sidebar</a></li>
                                            <li><a href="blog-list-right-sidebar.html">Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children has-children">
                                        <a href="#">Blog Details</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-details-image.html">Standard Post</a></li>
                                            <li><a href="blog-details-image.html">Image Post</a></li>
                                            <li><a href="blog-details-audio.html">Audio Post</a></li>
                                            <li><a href="blog-details-video.html">Video Post</a></li>
                                            <li><a href="blog-details-gallery.html">Gallery Post</a></li>
                                            <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="mainmenu__item menu-item-has-children has-children">
                                <a href="#" class="mainmenu__link">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="compare.html">compare</a></li>
                                    <li><a href="wishlist.html">wishlist</a></li>
                                    <li><a href="my-account.html">my account</a></li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="faq.html">Faq</a></li>
                                    <li><a href="login-register.html">Login Register</a></li>
                                </ul>
                            </li>
                            <li class="mainmenu__item">
                                <a href="#" class="mainmenu__link">Giới thiệu</a>
                            </li>
                            <li class="mainmenu__item">
                                <a href="#" class="mainmenu__link">Địa chỉ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>