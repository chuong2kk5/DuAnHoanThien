<?php
include 'config.php';

if (isset($_GET['coupon_id'])) {
    $coupon_id = intval($_GET['coupon_id']);

    $stmt = $conn->prepare("DELETE FROM coupons WHERE coupon_id = ?");
    $stmt->bind_param("i", $coupon_id);

    if ($stmt->execute()) {
        header("Location: manage_coupons.php?message=Xóa mã giảm giá thành công!");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Không tìm thấy mã giảm giá cần xóa.";
}
?>
