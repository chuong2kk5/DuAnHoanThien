<?php
header('Content-Type: application/json');
include 'config.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $product]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu ID sản phẩm.']);
}

$conn->close();
?>
