<?php
include 'config.php';

// Kiểm tra xem có yêu cầu POST không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $code = $_POST['code'];
    $discount_percentage = $_POST['discount_percentage'];
    $expiry_date = $_POST['expiry_date'];
    $is_active = isset($_POST['is_active']) ? 1 : 0; 
    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO coupons (code, discount_percentage, expiry_date, is_active) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $code, $discount_percentage, $expiry_date, $is_active);

    // Thực thi và kiểm tra
    if ($stmt->execute()) {
        header("Location: manage_coupons.php?message=Thêm mã giảm giá thành công!");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>
