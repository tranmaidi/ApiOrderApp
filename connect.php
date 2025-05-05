<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "orderappdb";

error_reporting(0);

$conn = mysqli_connect($host, $user, $pass, $database);

// Kiểm tra kết nối
if (!$conn) {
    die(json_encode([
        'success' => false,
        'message' => 'Không thể kết nối cơ sở dữ liệu'
    ]));
}

mysqli_set_charset($conn, "utf8");
