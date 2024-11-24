<?php 
include 'config.php';
session_start();

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Cập nhật trạng thái đơn hàng
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";

    // Chuẩn bị và thực thi câu lệnh
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $status, $order_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Cập nhật trạng thái thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
