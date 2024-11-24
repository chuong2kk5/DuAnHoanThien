<?php
include 'config.php';
session_start();

   // phân trang
   $limit = 5;

   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
   $offset = ($page - 1) * $limit;

   $count_sql = "SELECT COUNT(*) AS total FROM orders";
   $count_result = mysqli_query($conn, $count_sql);
   $count_row = mysqli_fetch_assoc($count_result);
   $total_orders = $count_row['total'];

   $total_pages = ceil($total_orders / $limit);

$sql = "
    SELECT 
        o.user_id,
        u.username AS user_name,
        p.name AS product_name,
        o.phone,
        o.address,
        o.total,
        o.order_date,
        o.status,
        o.order_id
    FROM 
        orders o
    JOIN 
        users u ON o.user_id = u.user_id
    JOIN 
        order_items oi ON o.order_id = oi.order_id
    JOIN 
        products p ON oi.product_id = p.product_id
    ORDER BY 
        o.order_date DESC
        LIMIT $limit OFFSET $offset;
    ";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
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
        <h1>Quản lý đơn hàng</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID user</th>
                    <th>Tên</th>
                    <th>Tên sản phẩm</th>
                    <th>Số ĐT</th>
                    <th>Địa Chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo number_format($row['total'], 0, ',', '.') . ' VNĐ'; ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form action="" method="POST" id="updateStatusForm<?php echo $row['order_id']; ?>"
                                style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <select name="status" class="form-control"
                                    onchange="updateOrderStatus(<?php echo $row['order_id']; ?>)">
                                    <option value="pending" <?php if ($row['status'] == 'pending')
                                        echo 'selected'; ?>>Đang
                                        chờ</option>
                                    <option value="processing" <?php if ($row['status'] == 'processing')
                                        echo 'selected'; ?>>
                                        Đang xử lý</option>
                                    <option value="completed" <?php if ($row['status'] == 'completed')
                                        echo 'selected'; ?>>
                                        Hoàn thành</option>
                                    <option value="canceled" <?php if ($row['status'] == 'canceled')
                                        echo 'selected'; ?>>Hủy
                                        bỏ</option>
                                </select>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

<!-- phân trang -->
        <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">«</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

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
    function updateOrderStatus(orderId) {
        var form = document.getElementById('updateStatusForm' + orderId);
        var status = form.elements['status'].value;  

        var xhr = new XMLHttpRequest();     
        xhr.open("POST", "update_order_status.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status == 200) {
                alert("Cập nhật trạng thái thành công!");
            } else {
                alert("Có lỗi xảy ra. Vui lòng thử lại!");
            }
        };

        xhr.send("order_id=" + orderId + "&status=" + status);
    }
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>