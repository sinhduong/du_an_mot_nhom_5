<?php
function connectDB()
{
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        // Corrected variable name from $dbport to $port
        $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8";
        $username = "root"; // or your DB username
        $password = ""; // or your DB password

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo; // Return the PDO instance
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit; // Stop execution if connection fails
    }
}

function UploadFile($file, $folderUpload)
{
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null; // Handle the error as needed
    }

    // Sanitize file name
    $fileName = basename($file['name']);
    $fileName = preg_replace('/[^a-zA-Z0-9_-]/', '.', $fileName); // Only allow safe characters

    // Create a unique path
    $pathStorage = $folderUpload . time() . '.' . $fileName;
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    // Ensure the upload directory exists
    if (!is_dir(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }

    return null;
}
function DeleteFile($file)
{
    // Sanitize the file path to prevent directory traversal attacks
    $file = basename($file);
    $pathDelete = PATH_ROOT . $file;

    // Check if the file exists
    if (file_exists($pathDelete)) {
        // Attempt to delete the file
        if (unlink($pathDelete)) {
            return true; // Deletion successful
        } else {
            // Log an error or handle the failure
            error_log("Failed to delete file: " . $pathDelete);
            return false; // Deletion failed
        }
    }

    return false; // File does not exist
}

function   vgmh()
{
    if (isset($_SESSION['flash'])) {
        // hủy session sau khi tải trang
        unset($_SESSION['flash']);
        session_unset();
        session_destroy();
    }
}



function uploadFileAlbum($file, $folderUpload, $key)
{

    $pathStorage = $folderUpload . time() . $file['name'][$key];
    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;

    // Ensure the upload directory exists
    if (!is_dir(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }

    return null;
}

function deleteSessionError()
{
    if (isset($_SESSION['flash'])) {
        // hủy session sau khi tải trang
        unset($_SESSION['flash']);
        session_unset();
        // session_destroy();
    }
}

function formatDate($date)
{

    return date("d-m-Y", strtotime($date));
}

 function  formatPrice($price){
    return  number_format($price, 0 ,',','.');
}