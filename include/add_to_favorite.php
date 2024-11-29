<?php
session_start();
include "../config.php"; // Kết nối database
 

 

    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm này đã có trong danh sách yêu thích.']);
    } else {
        // Thêm sản phẩm vào danh sách yêu thích
        $insert_sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $user_id, $product_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm vào danh sách yêu thích thành công.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    $stmt->close();
    $conn->close();
?>
