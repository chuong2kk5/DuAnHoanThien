<?php
include 'config.php';

// Kiểm tra xem có yêu cầu POST không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];

    // Xử lý upload ảnh
    if ($_FILES['image']['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename(path: $_FILES["image"]["name"]);
        
        // Kiểm tra kích thước ảnh (tùy chọn)
        if ($_FILES['image']['size'] > 2000000) {
            die("Kích thước ảnh quá lớn. Vui lòng chọn ảnh khác.");
        }

        // Di chuyển file tới thư mục đã chỉ định
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;

            // Thêm sản phẩm vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, quantity, category_id, image_path) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdiis", $name, $description, $price, $quantity, $category_id, $image_path);
            $stmt->execute();
            $stmt->close();

            header("Location: manage_products.php");
            exit();
        } else {
            echo "Lỗi trong việc tải lên ảnh.";
        }
    } else {
        echo "Vui lòng chọn một ảnh.";
    }
}
