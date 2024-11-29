<?php
include('config.php');  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $is_main = isset($_POST['is_main']) ? 1 : 0;  

    if (isset($_FILES['image']) && $_FILES['image']['error'][0] == 0) {
        foreach ($_FILES['image']['name'] as $key => $image_name) {
            $image_path = '../uploads/' . basename($image_name);  
            if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $image_path)) {
                $sql = "INSERT INTO products_image (product_id, image_path, is_main) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('isi', $product_id, $image_path, $is_main);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Hình ảnh " . $image_name . " đã được thêm thành công!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Lỗi khi thêm hình ảnh " . $image_name . "!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Lỗi khi tải lên hình ảnh " . $image_name . "!</div>";
            }
        }
    } else {
        echo "<div class='alert alert-warning'>Vui lòng chọn một hình ảnh!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hình Ảnh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Hình Ảnh Cho Sản Phẩm</h2>
        <form action="add_image.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_id" class="form-label">Chọn Sản Phẩm</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Chọn sản phẩm</option>
                    <?php
                    $sql = "SELECT product_id, name FROM products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['product_id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Không có sản phẩm</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Chọn Hình Ảnh</label>
                <input type="file" name="image[]" id="image" class="form-control" multiple required>
                <small class="form-text text-muted">Chọn nhiều hình ảnh (Ctrl + Click để chọn nhiều)</small>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_main" id="is_main" class="form-check-input">
                <label for="is_main" class="form-check-label">Ảnh Chính</label>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Hình Ảnh</button>
           <a href="manage_products.php" class="btn btn-secondary">Trở về</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
