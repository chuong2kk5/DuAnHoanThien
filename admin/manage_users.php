<?php
include 'config.php';
session_start();

$sql = "SELECT * FROM users";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h1>Quản lý người dùng</h1>
        <!-- Modal Thêm người dùng -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Thêm người dùng mới</h5>
                <!-- Message thông báo -->
                <?php if (isset($_GET['message'])): ?>
                    <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="add_user.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Vai trò</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="user">custumer</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal sửa người dùng -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Sửa người dùng</h5>
                <!-- Message thông báo -->
                <?php if (isset($_GET['message'])): ?>
                    <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" action="edit_user.php" method="POST">
                    <!-- ID người dùng (ẩn) -->
                    <input type="hidden" name="user_id" id="edit_user_id">

                    <!-- Trường tên người dùng -->
                    <div class="form-group">
                        <label for="edit_username">Tên người dùng</label>
                        <input type="text" class="form-control" id="edit_username" name="username" readonly required>
                    </div>

                    <!-- Trường email -->
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" readonly required>
                    </div>

                    <!-- Trường vai trò -->
                    <div class="form-group">
                        <label for="edit_role">Vai trò</label>
                        <select class="form-control" id="edit_role" name="role" required>
                            <option value="customer">customer</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <table class="table table-striped">
           <div class="message"></div>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Ngày đăng ký</th>
                    <th>Chức Vụ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <?php echo "<td>
                                <button type='button' class='btn btn-warning btn-sm' onclick='openEditModal(" . $row['user_id'] . ")'>Sửa</button>
                                <form action='delete_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa người dùng này không?\");'>Xóa</button>
                                </form>
                            </td>";
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
    function openEditModal(userId) {
        fetch('get_user_details.php?user_id=' + userId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('edit_user_id').value = data.data.user_id;
                    document.getElementById('edit_username').value = data.data.username;
                    document.getElementById('edit_email').value = data.data.email;
                    document.getElementById('edit_role').value = data.data.role;
                    $('#editUserModal').modal('show');
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
                    text: 'Không thể lấy thông tin người dùng.',
                    icon: 'error'
                });
            });
    }
</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>