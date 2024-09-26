<?php

class Sanpham {
    public $conn;

    public function __construct() {
        $this->conn = connectDB(); // Ensure connectDB() is defined and accessible
    }

    public function GetAllProduct() {
        try {
            $sql = 'SELECT * FROM san_phams';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(); // Corrected from 'fecthAll' to 'fetchAll'

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage(); // Improved error message

            // Optionally, you might want to throw the exception
            // throw $e; // Uncomment if you want to propagate the error
        }
    }
}