<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            Swal.fire({
                title: 'Oops...',
                text: 'Vui lòng đăng nhập trên trang đăng nhập',
                icon: 'error'
            }).then(function() {
                window.location.href = '../login/login.php'; // Đưa người dùng về trang đăng nhập
            });
          </script>";
    exit; // Dừng script PHP sau khi gửi JavaScript
}

$user_id = $_SESSION['user_id']; // Lấy user_id từ session

// Lấy tất cả thông tin từ bảng orders theo user_id
$sql_order = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC"; // Sắp xếp theo ngày đặt
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows == 0) {
    die("Lỗi: Bạn chưa có đơn hàng nào.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>USER</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="tab-pane fade show" id="tab1Id" role="tabpanel">
        <!-- Account Information Section -->
        <div class="card">
            <div class="card-header">
                Đơn Hàng
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Mã Đơn Hàng</th>
                            <th class="py-2 text-left">Ngày Đặt</th>
                            <th class="py-2 text-left">Trạng Thái</th>
                            <th class="py-2 text-left">Tổng Giá Trị</th>
                            <th class="py-2 text-left">Phương Thức Thanh Toán</th>
                            <th class="py-2 text-left">Địa Chỉ Giao Hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $order_result->fetch_assoc()): ?>
                        <tr class="border-b">
                            <td class="py-2"><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td class="py-2"><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td class="py-2"><?php echo htmlspecialchars($order['status']); ?></td>
                            <td class="py-2"><?php echo number_format($order['total'], 0, ',', '.') . 'đ'; ?></td>
                            <td class="py-2"><?php echo htmlspecialchars($order['payment_method']); ?></td>
                            <td class="py-2"><?php echo htmlspecialchars($order['address']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Đơn hàng đã mua của bạn!
            </div>
        </div>
    </div>
</body>
</html>
