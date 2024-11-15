<?php
session_start();
include('../admin/config.php');

$user_id = $_SESSION['user_id']; 

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);  
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();  

// Truy vấn thông tin địa chỉ từ bảng addresses
$stmt = $conn->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$address_result = $stmt->get_result();
$address = $address_result->fetch_assoc();  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="tab-content">
        <!-- Tab 0: Thông tin -->
        <div class="tab-pane fade show active" id="tab0Id" role="tabpanel">
            <div class="smg-text" style="border: 1px solid rgb(220, 217, 217); border-radius: 5px; box-shadow: 0px 2px 2px 0px rgb(220, 217, 217); padding: 30px;">
                <h2 class="card-title">Thông tin tài khoản</h2>
                <div class="control-information">
                    <div class="form-group active">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['username']); ?>" readonly class="form-control">
                    </div>

                    <div class="form-group active">
                        <label>Số điện thoại</label>
                        <input value="09712537112" disabled="disabled" type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group active">
                        <label>Email</label>
                        <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['email']); ?>" readonly class="form-control">
                    </div>

                    <div class="form-group active">
                        <label>Địa Chỉ</label>
                        <input type="text" name="address" class="form-control"
                        value="<?php echo isset($address['address_line']) && isset($address['city']) && isset($address['state']) && isset($address['country']) ? $address['address_line'] . ', ' . $address['city'] . ', ' . $address['state'] . ', ' . $address['country'] : ''; ?>"
                        placeholder="bạn chưa có địa chỉ. Vui lòng thêm địa chỉ">
                    </div>
                    <div class="form-button text-center">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
