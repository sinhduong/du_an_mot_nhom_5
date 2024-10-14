<?php
// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng hằng số để không phải dùng $GLOBALS

// Đường dẫn vào client
define('BASE_URL', 'http://localhost/du-an/du_an_mot_nhom_5/'); 

// Đường dẫn vào admin
define('BASE_URL_ADMIN', 'http://localhost/du-an/du_an_mot_nhom_5/admin/'); 

// Database connection constants
define('DB_HOST', 'localhost');
define('DB_PORT', 3306); // Changed port to the default MySQL port
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Ensure this matches your DB settings
define('DB_NAME', 'duan1_nhom5');

// Define the path to the parent directory
define('PATH_PORT', __DIR__ . '/../');
define('PATH_ROOT', __DIR__ . '/../');