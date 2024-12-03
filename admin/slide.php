<?php
include 'config.php';

// Xử lý xóa slide
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM slides WHERE id = $id";
    $conn->query($query);
    header("Location: slide.php");
}

// Xử lý thêm slide
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alt_text = $_POST['alt_text'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $query = "INSERT INTO slides (image_path, alt_text) VALUES ('$target_file', '$alt_text')";
    $conn->query($query);
    header("Location: slide.php");
}

// Lấy danh sách slide
$query = "SELECT * FROM slides";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slides</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
      body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar h2 {
            padding: 15px;
            font-size: 1.5rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .list-group-item {
            background-color: #343a40;
            border: none;
        }

        .list-group-item a {
            color: white;
        }

        .list-group-item a:hover {
            background-color: #495057;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
</style>
<body>

<div class="sidebar">
        <h2 class="text-center">Welcome admin</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php">Trang chủ</a></li>
            <li class="list-group-item"><a href="manage_products.php">Quản lý sản phẩm</a></li>
            <li class="list-group-item"><a href="manage_orders.php">Quản lý đơn hàng</a></li>
            <li class="list-group-item"><a href="manage_users.php">Quản lý người dùng</a></li>
            <li class="list-group-item"><a href="manage_categories.php">Quản lý danh mục</a></li>
            <li class="list-group-item"><a href="manage_variant.php">Quản lý Biến thể</a></li>
            <li class="list-group-item"><a href="manage_coupons.php">Mã giảm giá</a></li>
            <li class="list-group-item"><a href="slide.php">Thay đổi slide</a></li>
            <li class="list-group-item bg-dark"><a href="../login/logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    
<div class="container mt-5">
    <h2>Quản lý Slide</h2>

    <!-- Form Thêm Slide -->
    <form action="slide.php" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="form-group">
            <label for="alt_text">Mô tả ảnh (alt text):</label>
            <input type="text" name="alt_text" id="alt_text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Chọn ảnh:</label>
            <input type="file" name="image" id="image" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Slide</button>
    </form>

    <!-- Danh sách Slide -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><img src="<?= $row['image_path'] ?>" alt="<?= $row['alt_text'] ?>" width="150"></td>
                <td><?= $row['alt_text'] ?></td>
                <td>
                    <a href="slide.php?delete=<?= $row['id'] ?>" class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
