<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_id = $_POST['coupon_id'];
    $code = $_POST['code'];
    $discount_percentage = $_POST['discount_percentage'];
    $expiry_date = $_POST['expiry_date'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE coupons SET code = ?, discount_percentage = ?, expiry_date = ?, is_active = ? WHERE coupon_id = ?");
    $stmt->bind_param("sdsii", $code, $discount_percentage, $expiry_date, $is_active, $coupon_id);

    if ($stmt->execute()) {
        header("Location: manage_coupons.php?message=Cập nhật mã giảm giá thành công!");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
