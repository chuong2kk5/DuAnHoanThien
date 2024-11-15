<?php
$host = 'localhost';  
$db_name = 'beautiful';  
$username = 'root'; 
$password = '';  

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}else {
    // echo "Kết nối thanh cong."
} 

$conn->set_charset("utf8");

function closeConnection($conn) {
    $conn->close();
}


