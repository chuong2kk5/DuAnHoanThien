<?php
// edit_product.php

session_start();
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    // Chuẩn bị truy vấn để cập nhật người dùng
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE user_id = ?");
    $stmt->bind_param("si", $role, $_POST['user_id']);
    
    
    if ($stmt->execute()) {
        // Cập nhật thành công
        header("Location: manage_users.php?message=Cập nhật người dùng thành công.");
        exit();
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Không thể cập nhật người dùng.',
                    icon: 'error'
                }).then(function() {
                    window.history.back();
                });
              </script>";
            $stmt->close();

        exit();
    }

}
