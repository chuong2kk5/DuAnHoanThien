<?php
session_start();
require_once "config.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
} else {
    echo "<script>alert('bạn không có quyền truy cập trang này, vui lòng đăng nhập')</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

// Truy vấn tổng số sản phẩm, đơn hàng, người dùng
$sql_products = "SELECT COUNT(*) AS total_products FROM products";
$result_products = $conn->query($sql_products);
$row_products = $result_products->fetch_assoc();
$total_products = $row_products['total_products'];

$sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
$result_orders = $conn->query($sql_orders);
$row_orders = $result_orders->fetch_assoc();
$total_orders = $row_orders['total_orders'];

$sql_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$total_users = $row_users['total_users'];


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

    <div class="content">
        <h1>Chào mừng đến với bảng điều khiển quản trị</h1>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Tổng sản phẩm</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $total_products; ?></h5>
                            <p class="card-text">Số lượng sản phẩm hiện có trong kho.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Tổng đơn hàng</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $total_orders; ?></h5>
                            <p class="card-text">Số lượng đơn hàng đã đặt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Tổng người dùng</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $total_users; ?></h5>
                            <p class="card-text">Số lượng người dùng đã đăng ký.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>