<?php
session_start();
require_once "config.php";

$limit = 3;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql_products = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$result_products = $conn->query($sql_products);

$sql_count_products = "SELECT COUNT(*) AS total FROM products";
$result_count = $conn->query($sql_count_products);
$count_row = $result_count->fetch_assoc();
$total_products = $count_row['total'];
$total_pages = ceil($total_products / $limit);

$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    </style>
</head>

<body>

    <div class="sidebar">
        <h2 class="text-center">Bảng điều khiển Admin</h2>
        <ul class="list-group">
            <li class="list-group-item bg-dark"><a href="index.php">Trang chủ</a></li>
            <li class="list-group-item bg-dark"><a href="manage_products.php">Quản lý sản phẩm</a></li>
            <li class="list-group-item bg-dark"><a href="manage_orders.php">Quản lý đơn hàng</a></li>
            <li class="list-group-item bg-dark"><a href="manage_users.php">Quản lý người dùng</a></li>
            <li class="list-group-item bg-dark"><a href="manage_categories.php">Quản lý danh mục</a></li>
            <li class="list-group-item bg-dark"><a href="manage_coupons.php">Mã giảm giá</a></li>
            <li class="list-group-item bg-dark"><a href="#">Đăng xuất</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Quản lý sản phẩm</h1>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>
        <!-- Modal Thêm sản phẩm -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                        <!-- messsage thong bao -->
                        <?php if (isset($_GET['message'])): ?>
                            <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
                        <?php endif; ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" action="add_product.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Danh mục</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <?php
                                    if ($result_categories->num_rows > 0) {
                                        while ($category = $result_categories->fetch_assoc()) {
                                            echo "<option value='" . $category['category_id'] . "'>" . $category['name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Tải lên hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

      

        <!-- Modal Sửa sản phẩm -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
                        <!-- Message thông báo -->
                        <?php if (isset($_GET['message'])): ?>
                            <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
                        <?php endif; ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm" action="edit_product.php" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="edit_product_id">

                            <!-- Các trường nhập liệu sản phẩm -->
                            <div class="form-group">
                                <label for="edit_name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_description">Mô tả</label>
                                <textarea class="form-control" id="edit_description" name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_price">Giá</label>
                                <input type="number" class="form-control" id="edit_price" name="price" step="0.01"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_quantity">Số lượng</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_category_id">Danh mục</label>
                                <select class="form-control" id="edit_category_id" name="category_id" required>
                                    <?php
                                    $result_categories_edit = mysqli_query($conn, "SELECT * FROM categories");

                                    if ($result_categories_edit->num_rows > 0) {
                                        while ($category = $result_categories_edit->fetch_assoc()) {
                                            echo "<option value='" . $category['category_id'] . "'>" . $category['name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_image">Thay đổi hình ảnh</label>
                                <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                <small>Nếu không chọn hình mới, ảnh cũ sẽ được giữ lại.</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h1>Danh sách sản phẩm</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kiểm tra xem có sản phẩm nào không
                    if ($result_products->num_rows > 0) {
                        while ($row = $result_products->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                            echo "<td>" . number_format($row["price"], 0) . " VNĐ</td>";
                            echo "<td>" . intval($row["quantity"]) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row["image_path"]) . "' alt='" . htmlspecialchars($row["name"]) . "' title='" . htmlspecialchars($row["name"]) . "' style='width: 100px;'></td>";
                            echo "<td>
                                <button type='button' class='btn btn-warning btn-sm' onclick='openEditModal(" . $row['product_id'] . ")'>Sửa</button>
                                <form action='delete_product.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này không?\");'>Xóa</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Không có sản phẩm nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <!-- Trang đầu và trang trước -->
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">«</a>
                        </li>
                    <?php endif; ?>

                    <!-- Hiển thị các số trang -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Trang tiếp theo và trang cuối -->
                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">»</a>
                        </li>
                        <li class="page-item">
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <script>
            function openEditModal(productId) {
                fetch('get_product_details.php?id=' + productId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('edit_product_id').value = data.data.product_id;
                            document.getElementById('edit_name').value = data.data.name;
                            document.getElementById('edit_description').value = data.data.description;
                            document.getElementById('edit_price').value = data.data.price;
                            document.getElementById('edit_quantity').value = data.data.quantity;
                            document.getElementById('edit_category_id').value = data.data.category_id;
                            $('#editProductModal').modal('show');
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Không thể lấy thông tin sản phẩm.',
                            icon: 'error'
                        });
                    });
            }


        </script>

        <!-- Bao gồm các thư viện JavaScript cần thiết -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>