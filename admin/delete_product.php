<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    // check id products
    if (isset($product_id) && !empty($product_id)) {
        // Thực hiện xóa sản phẩm
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);   
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            $message = "Sản phẩm đã được xóa thành công!";
        } else {
            $message = "Xóa sản phẩm không thành công. Vui lòng thử lại!";
        }
        $stmt->close();
    } else {
        $message = "Không tìm thấy sản phẩm";
    }
    
    // 
    header("Location: manage_products.php?message=" . urlencode($message));
    exit();
}

$conn->close();
