<?php
header('Content-Type: application/json');
include 'config.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
 
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy người dùng.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu ID người dùng.']);
}

$conn->close();
?>
