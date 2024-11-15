<?php
include '../admin/config.php';

$product_id = $_GET['product_id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
$product = $product_result->fetch_assoc();

$variants_stmt = $conn->prepare("SELECT * FROM product_variants WHERE variant_id = ?");
$variants_stmt->bind_param("i", $product_id);
$variants_stmt->execute();
$variants_result = $variants_stmt->get_result();
$variants = [];
while ($variant = $variants_result->fetch_assoc()) { // Lưu tất cả biến thể vào mảng
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php include '../include/navbar.php'; ?>
    <!-- Hiển thị thông tin sản phẩm -->
    <div class="product-details container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-4"><?php echo $product['name']; ?></h1>
                <p class="lead"><?php echo $product['description']; ?></p>
                <img src="<?php echo $product['image_path']; ?>" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2 class="h4">Price: $<span class="price"><?php echo $product['price']; ?></span></h2>
                <p>Stock: <?php echo $product['quantity']; ?> items available</p>

                <h2 class="h4">Variants</h2>

                 <!-- Form chọn size và màu sắc -->
        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

            <div class="mb-3">
                <label for="size" class="form-label">Choose Size:</label>
                <select name="size" id="size" class="form-control" required>
                    <?php
                    // Lấy danh sách kích cỡ từ bảng variants
                    $sizes_result = $conn->query("SELECT DISTINCT size FROM variants");
                    while ($row = $sizes_result->fetch_assoc()) {
                        echo "<option value='{$row['size']}'>{$row['size']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Choose Color:</label>
                <select name="color" id="color" class="form-control" required>
                    <?php
                    // Lấy danh sách màu sắc từ bảng variants
                    $colors_result = $conn->query("SELECT DISTINCT color FROM variants");
                    while ($row = $colors_result->fetch_assoc()) {
                        echo "<option value='{$row['color']}'>{$row['color']}</option>";
                    }
                    ?>
                </select>
            </div>
            </div>
        </div>
    </div>

    <?php include '../include/footer.php'; ?>

</body>

</html>