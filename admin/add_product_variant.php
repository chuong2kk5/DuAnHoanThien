<?php
include '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $variant_id = $_POST['variant_id'];

    $stmt = $conn->prepare("INSERT INTO product_variants (product_id, variant_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $product_id, $variant_id);

    if ($stmt->execute()) {
        echo "Product linked with variant successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Product with Variant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Link Product with Variant</h2>
        <form action="add_product_variant.php" method="POST">
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <?php
                    $product_result = $conn->query("SELECT product_id, name FROM products");
                    while ($product = $product_result->fetch_assoc()) {
                        echo "<option value='{$product['product_id']}'>{$product['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="variant_id" class="form-label">Variant</label>
                <select name="variant_id" id="variant_id" class="form-control" required>
                    <?php
                    // Lấy tất cả biến thể từ bảng `variants`
                    $variant_result = $conn->query("SELECT variant_id, size, color FROM variants");
                    while ($variant = $variant_result->fetch_assoc()) {
                        echo "<option value='{$variant['variant_id']}'>Size: {$variant['size']}, Color: {$variant['color']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Link Product with Variant</button>
        </form>
    </div>
</body>
</html>
