<?php
session_start();
include "../admin/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    if ($stmt->execute()) {
        echo "<script>
       
            alert('Xóa sản phẩm thành công!');
            window.location.href = 'account.php';
        </script>";
    } else {
        echo "<script>
            alert('Có lỗi xảy ra!');
        </script>";
    }
}
?>
