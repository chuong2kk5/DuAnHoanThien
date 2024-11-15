<?php
include '../admin/config.php';
$category_id = $_GET['category_id'];

// query caảte
$stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

// Hiển thị sản phẩm
while($row = $result->fetch_assoc()) {
    echo "<div class='product'>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>Giá: " . $row['price'] . "</p>";
    echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "'>";
    echo "</div>";
}
