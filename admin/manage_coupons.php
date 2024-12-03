<?php
session_start();
include_once 'config.php';

$sql = "SELECT * FROM coupons";
$result = $conn->query($sql);
$coupons = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coupons[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã giảm giá</title>
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

    <!-- modal edit coupon -->
    <div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCouponModalLabel">Chỉnh sửa mã giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCouponForm" action="edit_coupon.php" method="POST">
                        <input type="hidden" id="edit_coupon_id" name="coupon_id">
                        <div class="form-group">
                            <label for="edit_code">Mã giảm giá</label>
                            <input type="text" class="form-control" id="edit_code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_percentage">Giá trị</label>
                            <input type="text" class="form-control" id="edit_discount_percentage"
                                name="discount_percentage" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_expiry_date">Ngày hết hạn</label>
                            <input type="date" class="form-control" id="edit_expiry_date" name="expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_is_active">Hoạt động</label>
                            <input type="checkbox" class="form-control" id="edit_is_active" name="is_active">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- content -->
    <div class="content">
        <h1>Mã giảm giá</h1>
        <!--add coupon Modal -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCouponModal">
            Thêm mã giảm giá mới
        </button><br>
        <div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="addCouponModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCouponModalLabel">Thêm mã giảm giá mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Nội dung của Modal -->
                    <div class="modal-body">
                        <form id="addCouponForm" action="add_coupon.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="code">Mã giảm giá</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Nhập mã giảm giá" required>
                            </div>
                            <div class="form-group">
                                <label for="discount_percentage">Giá trị (%)</label>
                                <input type="number" class="form-control" id="discount_percentage"
                                    name="discount_percentage" placeholder="Nhập giá trị giảm giá" min="1" max="100"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Ngày hết hạn</label>
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                            </div>
                            <div class="form-group">
                                <label for="is_active">Hoạt động</label>
                                <input type="checkbox" id="is_active" name="is_active"> Kích hoạt
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã giảm giá</th>
                    <th>Giá trị</th>
                    <th>Ngày hết hạn</th>
                    <th>Hoạt động</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($coupons)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có mã giảm giá nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($coupons as $coupon): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($coupon['coupon_id']); ?></td>
                            <td><?php echo htmlspecialchars($coupon['code']); ?></td>
                            <td><?php echo htmlspecialchars($coupon['discount_percentage']); ?>%</td>
                            <td><?php echo htmlspecialchars($coupon['expiry_date']); ?></td>
                            <td><?php echo $coupon['is_active'] ? 'Có' : 'Không'; ?></td>
                            <td>
                                <!-- Nút Sửa -->
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(
                                    <?php echo $coupon['coupon_id']; ?>, 
                                    '<?php echo htmlspecialchars($coupon['code'], ENT_QUOTES); ?>', 
                                    <?php echo $coupon['discount_percentage']; ?>, 
                                    '<?php echo $coupon['expiry_date']; ?>', 
                                    <?php echo $coupon['is_active'] ? 'true' : 'false'; ?>
                                  )">
                                    Sửa
                                </button>
                                <!-- Nút Xóa -->
                                <a href="delete_coupon.php?coupon_id=<?php echo $coupon['coupon_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('bạn chắc chắn muốn xóa mã giảm giá này không?');">Xóa</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <script>
        function openEditModal(coupon_id, code, discount_percentage, expiry_date, is_active) {
            // Gán giá trị vào các trường trong modal
            document.getElementById('edit_coupon_id').value = coupon_id;
            document.getElementById('edit_code').value = code;
            document.getElementById('edit_discount_percentage').value = discount_percentage;
            document.getElementById('edit_expiry_date').value = expiry_date;
            document.getElementById('edit_is_active').checked = is_active;

            // Mở modal
            $('#editCouponModal').modal('show');
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>