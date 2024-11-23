<?php
// Kết nối tới cơ sở dữ liệu
include_once '../admin/config.php';

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Thêm đánh giá vào bảng `reviews`
    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "<script>
                alert('Đánh giá của bạn đã được thêm thành công!');
                window.location.href = 'product_page.php?id=$product_id';
              </script>";
    } else {
        echo "<script>
                alert('Có lỗi xảy ra khi thêm đánh giá.');
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>