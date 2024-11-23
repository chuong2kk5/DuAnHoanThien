<?php
require_once '../admin/config.php';

if (!$isLoggedIn) {
    echo json_encode(['message' => 'Vui lòng đăng nhập!']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
$user_id = $_SESSION['user_id'];

if (isset($product_id) && isset($user_id)) {
    $sql = "INSERT INTO view_history (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Lịch sử đã được lưu thành công!']);
    } else {
        echo json_encode(['message' => 'Lỗi khi lưu lịch sử.']);
    }
} else {
    echo json_encode(['message' => 'Thông tin không hợp lệ.']);
}
?>
