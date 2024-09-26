<?php
function connectDB() {
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