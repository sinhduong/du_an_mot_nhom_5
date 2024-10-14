<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/user/css/styler.css">
</head>
<style>

</style>

<body class="body">
    <main class="box">
        <!-- Login Form -->
        <form action="<?= BASE_URL_ADMIN . '?act=check-login-admin' ?>" class="form" id="loginForm" method="POST">
            <?php if (isset($_SESSION['error'])) { ?>
                                    <h3 style="color: red"><?= $_SESSION['error'] ?></h3>
                <?php unset($_SESSION['error']); ?>
            <?php } else { ?>
                <h3>Đăng nhập</h3>
            <?php } ?>

            <div class="input-group">
                <input type="text" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                <ion-icon class="icon" name="mail"></ion-icon>
            </div>
            <div class="input-group">
                <input type="pass" id="passwordField" name="password" placeholder="Mật khẩu">
                <ion-icon class="icon" id="togglePassword" name="lock-closed"></ion-icon>
            </div>
            <div class="button">
                <div class="remember">
                    <input type="checkbox" name="" id="" class="checkbox">
                    <p>Remember me</p>
                </div>
                <a href="#">
                    <p>Forgot password?</p>
                </a>
            </div>
            <div class="btn-box">
                <button class="button">Login</button>
            </div>
            <div class="switch-button">
                <p>Don't have an account?</p>
                <a href="#" id="showRegisterForm">Register</a>
            </div>
        </form>


        <!-- Register Form -->
        <!-- <form action="" class="form hidden" id="registerForm">
            <h3>Register</h3>
            <div class="input-group">
                <input type="text" name="username" placeholder="Username">
                <ion-icon class="icon" name="person"></ion-icon>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email">
                <ion-icon class="icon" name="mail"></ion-icon>
            </div>
            <div class="input-group">
                <input type="password" id="registerPassword" name="password" placeholder="Password">
                <ion-icon class="icon" id="toggleRegisterPassword" name="lock-closed"></ion-icon>
            </div>
            <span id="passwordError" class="error-message"></span>
            <div class="input-group">
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password">
                <ion-icon class="icon" id="toggleConfirmPassword" name="lock-closed"></ion-icon>
            </div>
            <span id="confirmPasswordError" class="error-message"></span>
            <div class="btn-box">
                <button class="button">Register</button>
            </div>
            <div class="switch-button">
                <p>Already have an account?</p>
                <a href="#" id="showLoginForm">Login</a>
            </div>
        </form> -->
        <!-- Forgot Password Form -->
        <!-- <form action="" class="form hidden" id="forgotPasswordForm">
            <h3>Forgot Password</h3>
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email address">
                <ion-icon class="icon" name="mail"></ion-icon>
            </div>
            <div class="btn-box">
                <button class="button">Send Reset Link</button>
            </div>
            <div class="switch-button">
                <p>Remember your password?</p>
                <a href="#" id="showLoginFormFromForgot">Login</a>
            </div>
        </form> -->
    </main>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('passwordField');
    const toggleRegisterPassword = document.getElementById('toggleRegisterPassword');
    const registerPasswordField = document.getElementById('registerPassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordField = document.getElementById('confirmPassword');

    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.setAttribute('name', type === 'password' ? 'lock-closed' : 'lock-open');
    });

    toggleRegisterPassword.addEventListener('click', function() {
        const type = registerPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        registerPasswordField.setAttribute('type', type);
        this.setAttribute('name', type === 'password' ? 'lock-closed' : 'lock-open');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        this.setAttribute('name', type === 'password' ? 'lock-closed' : 'lock-open');
    });

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const showRegisterForm = document.getElementById('showRegisterForm');
    const showLoginForm = document.getElementById('showLoginForm');

    showRegisterForm.addEventListener('click', function(e) {
        e.preventDefault();
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
    });

    showLoginForm.addEventListener('click', function(e) {
        e.preventDefault();
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    });


    document.getElementById("registerForm").addEventListener("submit", function(event) {
        let password = document.getElementById("registerPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;

        let passwordError = document.getElementById("passwordError");
        let confirmPasswordError = document.getElementById("confirmPasswordError");

        // Reset thông báo lỗi
        passwordError.style.display = "none";
        confirmPasswordError.style.display = "none";

        let isValid = true;

        // Kiểm tra độ dài mật khẩu
        if (password.length < 8) {
            passwordError.textContent = "Mật khẩu phải trên 8 ký tự";
            passwordError.style.display = "block";
            isValid = false;
        } else if (password.length > 20) {
            passwordError.textContent = "Mật khẩu chỉ được dưới 20 ký tự";
            passwordError.style.display = "block";
            isValid = false;
        }

        // Kiểm tra khớp mật khẩu
        if (password !== confirmPassword) {
            confirmPasswordError.textContent = "Mật khẩu không khớp";
            confirmPasswordError.style.display = "block";
            isValid = false;
        }

        // Ngăn chặn gửi form nếu có lỗi
        if (!isValid) {
            event.preventDefault();
        }
    });



    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    const forgotPasswordLink = document.querySelector('a[href="#"]'); // Cập nhật selector nếu cần

    forgotPasswordLink.addEventListener('click', function(e) {
        e.preventDefault();
        loginForm.classList.add('hidden');
        registerForm.classList.add('hidden');
        forgotPasswordForm.classList.remove('hidden');
    });

    const showLoginFormFromForgot = document.getElementById('showLoginFormFromForgot');

    showLoginFormFromForgot.addEventListener('click', function(e) {
        e.preventDefault();
        forgotPasswordForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    });
</script>

</html>