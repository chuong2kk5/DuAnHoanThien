<?php
session_start();
include_once '../admin/config.php';

// Kiểm tra kết nối cơ sở dữ liệu
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : '';

    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($phone) || empty($address) || empty($city)) {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin giao hàng");</script>';
    } else {
        // Kiểm tra xem user_id có trong session không
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Lấy user_id từ session

            // Chèn thông tin vào database
            $stmt = $conn->prepare("INSERT INTO user_addresses (user_id, name, phone, address, city, note) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $name, $phone, $address, $city, $note);

            // Thực thi câu lệnh SQL
            if ($stmt->execute()) {
                echo "<script>alert('Lưu thông tin thành công!');</script>";
            } else {
                echo "Có lỗi xảy ra: " . $stmt->error;
            }
        } else {
            echo '<script>alert("User chưa đăng nhập. Vui lòng đăng nhập trước khi nhập thông tin giao hàng.");</script>';
        }

        // Đóng kết nối
        $stmt->close();
    }
    // Đóng kết nối sau khi xử lý
    $conn->close();
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Thông tin giao hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php include '../include/navbar.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thông tin giao hàng</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <!-- Họ và tên -->
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ và tên" required>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required>
                        </div>

                        <!-- Tỉnh/Thành phố -->
                        <div class="form-group">
                            <label for="city">Tỉnh/Thành phố</label>
                            <select id="city" name="city" class="form-control" required>
                                <option value="">Chọn tỉnh/thành phố</option>
                                <option value="Hà Nội">Hà Nội</option>
                                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option value="Đà Nẵng">Đà Nẵng</option>
                                <option value="Buôn Ma Thuột">Buôn Ma Thuột</option>
                                <option value="An Giang">An Giang</option>
                                <option value="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option>
                                <option value="Bạc Liêu">Bạc Liêu</option>
                                <option value="Bắc Giang">Bắc Giang</option>
                                <option value="Bắc Kạn">Bắc Kạn</option>
                                <option value="Bến Tre">Bến Tre</option>
                                <option value="Bình Dương">Bình Dương</option>
                                <option value="Bình Phước">Bình Phước</option>
                                <option value="Bình Thuận">Bình Thuận</option>
                                <option value="Cà Mau">Cà Mau</option>
                                <option value="Cao Bằng">Cao Bằng</option>
                                <option value="Cần Thơ">Cần Thơ</option>
                                <option value="Đắk Lắk">Đắk Lắk</option>
                                <option value="Đắk Nông">Đắk Nông</option>
                                <option value="Điện Biên">Điện Biên</option>
                                <option value="Đồng Nai">Đồng Nai</option>
                                <option value="Đồng Tháp">Đồng Tháp</option>
                                <option value="Gia Lai">Gia Lai</option>
                                <option value="Hà Giang">Hà Giang</option>
                                <option value="Hà Nam">Hà Nam</option>
                                <option value="Hải Dương">Hải Dương</option>
                                <option value="Hải Phòng">Hải Phòng</option>
                                <option value="Hòa Bình">Hòa Bình</option>
                                <option value="Hưng Yên">Hưng Yên</option>
                                <option value="Khánh Hòa">Khánh Hòa</option>
                                <option value="Kiên Giang">Kiên Giang</option>
                                <option value="Kon Tum">Kon Tum</option>
                                <option value="Lai Châu">Lai Châu</option>
                                <option value="Lâm Đồng">Lâm Đồng</option>
                                <option value="Lạng Sơn">Lạng Sơn</option>
                                <option value="Lào Cai">Lào Cai</option>
                                <option value="Long An">Long An</option>
                                <option value="Nam Định">Nam Định</option>
                                <option value="Nghệ An">Nghệ An</option>
                                <option value="Ninh Bình">Ninh Bình</option>
                                <option value="Ninh Thuận">Ninh Thuận</option>
                                <option value="Phú Thọ">Phú Thọ</option>
                                <option value="Phú Yên">Phú Yên</option>
                                <option value="Quảng Bình">Quảng Bình</option>
                                <option value="Quảng Nam">Quảng Nam</option>
                                <option value="Quảng Ngãi">Quảng Ngãi</option>
                                <option value="Quảng Ninh">Quảng Ninh</option>
                                <option value="Quảng Trị">Quảng Trị</option>
                                <option value="Sóc Trăng">Sóc Trăng</option>
                                <option value="Sơn La">Sơn La</option>
                                <option value="Tây Ninh">Tây Ninh</option>
                                <option value="Thái Bình">Thái Bình</option>
                                <option value="Thái Nguyên">Thái Nguyên</option>
                                <option value="Thanh Hóa">Thanh Hóa</option>
                                <option value="Thừa Thiên-Huế">Thừa Thiên-Huế</option>
                                <option value="Tiền Giang">Tiền Giang</option>
                                <option value="Trà Vinh">Trà Vinh</option>
                                <option value="Tuyên Quang">Tuyên Quang</option>
                                <option value="Vĩnh Long">Vĩnh Long</option>
                                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                <option value="Yên Bái">Yên Bái</option>
                                <option value="Phú Quốc">Phú Quốc</option>
                            </select>

                        </div>

                        <!-- Ghi chú -->
                        <div class="form-group">
                            <label for="note">Ghi chú (tùy chọn)</label>
                            <textarea id="note" name="note" rows="4" class="form-control" placeholder="Thêm ghi chú nếu cần"></textarea>
                        </div>

                        <!-- Nút gửi -->
                        <button type="submit" class="btn btn-primary btn-block">Lưu thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>