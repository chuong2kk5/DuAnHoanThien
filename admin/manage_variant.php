<?php
include 'config.php';

// Lấy danh sách các biến thể
$sql = "SELECT v.variant_id, p.name AS product_name, v.size, v.color, v.price, v.stock 
        FROM product_variants v 
        JOIN products p ON v.product_id = p.product_id";
$result = $conn->query($sql);

$rows_per_page = 10;

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// Tính OFFSET
$offset = ($current_page - 1) * $rows_per_page;

// Lấy tổng số dòng
$sql_count = "SELECT COUNT(*) AS total FROM product_variants";
$total_result = $conn->query($sql_count);
$total_row = $total_result->fetch_assoc();
$total_variants = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_variants / $rows_per_page);

// Lấy danh sách biến thể theo phân trang
$sql = "SELECT v.variant_id, p.name AS product_name, v.size, v.color, v.price, v.stock 
        FROM product_variants v 
        JOIN products p ON v.product_id = p.product_id 
        LIMIT $rows_per_page OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <title>Thêm Biến Thể</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

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
                        <li class="list-group-item bg-dark"><a href="#">Đăng xuất</a></li>
                </ul>
        </div>
        <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Quản lý biến thể</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>Giá</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['product_name']) ?></td>
                                <td><?= htmlspecialchars($row['size']) ?></td>
                                <td><?= htmlspecialchars($row['color']) ?></td>
                                <td><?= htmlspecialchars($row['price']) ?></td>
                                <td><?= htmlspecialchars($row['stock']) ?></td>
                                <td>
                                    <a href="edit_variant.php?variant_id=<?= $row['variant_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="delete_variant.php?variant_id=<?= $row['variant_id'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Không có biến thể nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <nav>
                <ul class="pagination">
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <br>
            <a href="add_variant.php" class="btn btn-primary">Thêm Biến Thể Mới</a>
        </div>
    </div>
</div>


</body>

</html> 