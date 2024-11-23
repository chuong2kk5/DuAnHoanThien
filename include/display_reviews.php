<?php
include_once '../admin/config.php';

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


$sql = "SELECT r.rating, r.comment, r.review_date, u.username
        FROM reviews r
        JOIN users u ON r.user_id = u.user_id
        WHERE r.product_id = ?
        ORDER BY r.review_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Hiển thị đánh giá
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='border p-3 mb-3'>";
        echo "<strong>" . htmlspecialchars($row['username']) . ":</strong> ";
        echo str_repeat("⭐", $row['rating']) . "<br>";
        echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
        echo "<small class='text-muted'>" . $row['review_date'] . "</small>";
        echo "</div>";
    }
} else {
    echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
}

$stmt->close();
$conn->close();
?>
