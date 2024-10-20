<?php require_once 'views/layout/header.php'; ?>

<!-- Main Wrapper Start -->
<div class="wrapper bg--shaft">
    <!-- Header Area Start -->
    <?php require_once 'views/layout/menu.php'; ?>
    <!-- Header Area End -->
    
    <!-- Main Content Wrapper Start -->
    <div class="main-content-wrapper">
        <div class="login-register-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 mb-md--40">
                        <center>
                            <h2 class="heading-secondary mb--30">Đăng ký</h2>
                        </center>
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <h3 style="color: red; text-align: center;"><?= htmlspecialchars($_SESSION['error']) ?></h3>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        
                        <div class="login-reg-box p-4 bg--2">
                            <form class="form" method="post" action="<?= htmlspecialchars(BASE_URL . '?act=xu-ly-dang-ky') ?>">
                                <div class="form__group mb--20">
                                    <label class="form__label" for="ho_ten">
                                        Họ tên <span>*</span>
                                    </label>
                                    <input type="text" name="ho_ten" id="ho_ten" class="form__input form__input--2" required>
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label" for="email">
                                        Email đăng nhập <span>*</span>
                                    </label>
                                    <input type="mail" name="email" id="email" class="form__input form__input--2" required>
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label" for="mat_khau">
                                        Mật khẩu <span>*</span>
                                    </label>
                                    <input type="pass" name="mat_khau" id="mat_khau" class="form__input form__input--2" required>
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label" for="confirm_mat_khau">
                                        Nhập lại mật khẩu <span>*</span>
                                    </label>
                                    <input type="pass" name="confirm_mat_khau" id="confirm_mat_khau" class="form__input form__input--2" required>
                                </div>
                                <div class="form__group mb--20">
                                    <button type="submit"  class="btn btn-5 btn-style-1 color-1">Đăng ký</button>
                                </div>
                                <!-- <a href="" class="forgot-pass">Quên mật khẩu?</a> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Wrapper End -->

    <?php include_once 'views/layout/footer.php'; ?>
</div>
<!-- Main Wrapper End -->