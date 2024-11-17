<?php
session_start();
include "cart.php";

// Kiểm tra xem có yêu cầu cập nhật số lượng không
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Cập nhật số lượng trong giỏ hàng
    $cart->updateQuantity($id, $quantity);

    // Chuyển hướng về cart_page.php
    header("Location: cart_page.php");
    exit;
} 

// ... (Xử lý các yêu cầu khác nếu cần)
?>