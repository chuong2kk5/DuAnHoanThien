<?php
// Kết nối cơ sở dữ liệu
require '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Kiểm tra đơn hàng có tồn tại không
    $query = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $update_query = "UPDATE orders SET status = 'cancelled' WHERE order_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $order_id);

        if ($update_stmt->execute()) {
            echo "<script>alert('Đơn hàng đã được hủy thành công.'); window.location.href='account.php';</script>";
        } else {
            echo "<script>alert('Hủy đơn hàng thất bại. Vui lòng thử lại.'); window.location.href='account.php';</script>";
        }
    } else {
        echo "<script>alert('Đơn hàng không tồn tại.'); window.location.href='account.php';</script>";
    }
}
?>
