
<?php
session_start();
require_once 'config.php'; // Kết nối cơ sở dữ liệu


// kiem tra dang nhap

// Kiểm tra xem người dùng đã gửi form chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn cơ sở dữ liệu để kiểm tra tài khoản admin
    $sql = "SELECT * FROM users WHERE username = ? AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Nếu có tài khoản admin trùng khớp
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công, lưu thông tin vào session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php"); 
            exit();
        } else {
            $error = "Mật khẩu không chính xác.";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại hoặc không phải là admin.";
    }
}
?>

<!-- Nếu có lỗi, hiển thị thông báo -->
<?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Link đến Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Đăng Nhập Admin</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <span class="text-muted">Chào mừng đến với trang admin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link đến Bootstrap JS (cần thiết cho các tính năng như modal, dropdown...) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
