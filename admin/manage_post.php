<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Xử lý upload ảnh
    $image_path = null;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/"; // Thư mục lưu ảnh
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $upload_ok = 1;

        // Kiểm tra loại file
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($image_file_type, $allowed_types)) {
            echo "Chỉ chấp nhận các định dạng JPG, JPEG, PNG, GIF!";
            $upload_ok = 0;
        }

        // Kiểm tra upload
        if ($upload_ok && move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Có lỗi xảy ra khi tải lên ảnh.";
        }
    }

    

    $stmt = $conn->prepare("INSERT INTO posts (title, content, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $image_path);
    if ($stmt->execute()) {
        echo "Bài viết đã được thêm thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viết Bài</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Viết Bài Mới</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội Dung</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh (Tùy chọn)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Đăng Bài</button>
    </form>
</div>
</body>
</html>
