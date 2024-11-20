<?php
session_start();
include('../admin/config.php');

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    die("Lỗi: Bạn cần đăng nhập để xem thông tin đơn hàng.");
}

$sql_order = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
 $stmt = $conn->prepare($sql_order); 
 $stmt->bind_param("i", $user_id); $stmt->execute();
  $order_result = $stmt->get_result(); 
  

//   sql user

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

//  addresses
$sql = "SELECT address_line, city, state, country FROM addresses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>USER</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        ul li {
            /* width: 100%; */
            text-align: left;
        }

        ul li a {
            color: black;
        }

        .data-v-ed45279a {
            margin-right: 5px;
        }

        .heading img {
            margin-top: 20px;
            height: 58px;
            cursor: pointer;
        }

        .phone {
            font-weight: bold;
            margin-top: 10px;
        }

        button.btn-primary {
            margin: 5px 10px;
            font-size: 16px;
        }

        .price {
            font-size: 16px;
        }

        a.card-link-product {
            font-size: 14px;
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        a.card-link-product:hover {
            color: red;
        }

        tbody .text-title {
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        tbody .text-dsc {
            width: 250px;
            font-size: 12px;
        }

        tbody .price {
            font-size: 14px;
        }

        tbody button.btn-primary {
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include '../include/navbar.php' ?>
    <br>
    <br>
    <br>

    <!-- Error -->
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<script>
            Swal.fire({
                title: "Bạn chưa đăng nhập ?",
                text: "",
                icon: "question"
            }).then(function() {
                window.location.href = "indexs.php";  // Redirect after closing the alert
            });
          </script>';
        exit();
    }
    ?>

    </div>


    <div class="container" style="display: flex;">
        <article class="text-center"
            style="background-color: rgb(255, 254, 254); border: 1px solid rgb(220, 217, 217);  padding: 0; margin-right: 50px; border-radius: 5px">
            <!-- User Profile -->
            <div class="heading text-center">
                <img src="https://static.vecteezy.com/system/resources/previews/024/183/535/original/male-avatar-portrait-of-a-young-man-with-glasses-illustration-of-male-character-in-modern-color-style-vector.jpg"
                    alt="avatar">
                <p id="phone" class="phone">Xin chào <?php echo htmlspecialchars($user['username']); ?></p>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="navId">
                <li class="nav-item">
                    <a href="#tab0Id" class="nav-link active" data-toggle="tab">Thông tin</a>
                </li>
                <li class="nav-item">
                    <a href="#tab1Id" class="nav-link" data-toggle="tab">Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="#tab2Id" class="nav-link" data-toggle="tab">Đã xem gần đây</a>
                </li>
                <li class="nav-item">
                    <a href="#tab3Id" class="nav-link" data-toggle="tab">Yêu thích</a>
                </li>
                <li class="nav-item">
                    <a href="#tab4Id" class="nav-link" data-toggle="tab">Thêm Địa Chỉ</a>
                </li>

            </ul>
        </article>

        <aside class="col-sm-9"
            style="background-color: rgb(255, 254, 254); border: 1px solid rgb(220, 217, 217);  padding: 0; margin-right: 50px; border-radius: 5px">
            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Tab 0: Thông tin -->
                <div class="tab-pane fade show active" id="tab0Id" role="tabpanel">
                    <div class="smg-text"
                        style="border: 1px solid rgb(220, 217, 217); border-radius: 5px; box-shadow: 0px 2px 2px 0px rgb(220, 217, 217); padding: 30px;">
                        <h2 class="card-title">Thông tin tài khoản</h2>
                        <div class="control-information">
                            <div class="form-group active">
                                <label>Tên đăng nhập</label>
                                <input type="text" name="firstName"
                                    value="<?php echo htmlspecialchars($user['username']); ?>" readonly
                                    class="form-control">
                            </div>

                            <div class="form-group active">
                                <label>Số điện thoại</label>
                                <input value="09712537112" disabled="disabled" type="text" name="phone"
                                    class="form-control">
                            </div>

                            <div class="form-group active">
                                <label>Email</label>
                                <input type="text" name="firstName"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" readonly
                                    class="form-control">
                            </div>

                            <div class="form-group active">
                                <label for="country">Địa Chỉ Của Bạn</label>
                                <select class="form-control">
                                    <?php
                                    while ($address = $result->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($address['address_line']) . '">';
                                        echo htmlspecialchars($address['address_line']) . ', ' . htmlspecialchars($address['city']) . ', ' . htmlspecialchars($address['state']) . ', ' . htmlspecialchars($address['country']);
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

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
                            <th style="font-size: 15px;" class="py-3 text-left">Mã Đơn Hàng</th>
                            <th style="font-size: 15px;" class="py-3 text-left">Ngày Đặt</th>
                            <th style="font-size: 15px;" class="py-3 text-left">Trạng Thái</th>
                            <th style="font-size: 15px;" class="py-3 text-left">Tổng Giá Trị</th>
                            <th style="font-size: 15px;" class="py-3 text-left">Phương Thức Thanh Toán</th>
                            <th style="font-size: 15px;" class="py-3 text-left">Địa Chỉ Giao Hàng</th>
                        </tr>
                    </thead>
      

                    <tbody>
                        <?php while ($order = $order_result->fetch_assoc()):  ?>
                        <tr class="border-b">
                            <td style="font-size: 15px;" class="py-3"><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td style="font-size: 15px;" class="py-3"><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td style="font-size: 15px;" class="py-3"><?php echo htmlspecialchars($order['status']); ?></td>
                            <td style="font-size: 15px;" class="py-3"><?php echo number_format($order['total'], 0, ',', '.') . 'đ'; ?></td>
                            <td style="font-size: 15px;" class="py-3"><?php echo htmlspecialchars($order['payment_method']); ?></td>
                            <td style="font-size: 15px;" class="py-3"><?php echo htmlspecialchars($order['address']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
             
        </div>
    </div>

                <div class="tab-pane fade show " id="tab2Id" role="tabpanel">
                    <!-- Account Information Section -->
                    <div class="card">
                        <div class="card-header">
                            Sản phẩm đã xem
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            Sảm phẩm đã xem của bạn
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show " id="tab3Id" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            Sản phẩm yêu thích
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá đơn hàng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc" style="width: 250px; font-size: 12px">Hoàn háo cho phái
                                                nam và phát nữ form áo gọn gàng thanh lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h6> 526.000 vnđ </h6>
                                        </td>
                                        <td>

                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc" style="width: 300px;">Hoàn háo cho phái nam và phát nữ
                                                form áo gọn gàng thanh lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h6> 526.000 vnđ </h6>
                                        </td>
                                        <td style="display: flex">

                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            Sản phẩm bãn đã yêu thích
                        </div>
                    </div>

                </div>
                <!-- Other Tabs (like tab1Id, tab2Id) -->
                <!-- Add content for each tab if needed -->
                <div style="margin-left: 20px;" class="tab-pane fade show " id="tab4Id" role="tabpanel">
                    <br>
                    <h2>Thêm Địa Chỉ</h2>
                    <form class="form-group" method="POST" action="add_adress.php">

                        <div class="form-group">
                            <label for="address_line">Địa chỉ:</label>
                            <input class="form-control" type="text" id="address_line" name="address_line" required>
                        </div>

                        <div class="form-group">
                            <label for="city">Thành phố:</label>
                            <input class="form-control" type="text" id="city" name="city" required>
                        </div>

                        <div class="form-group">
                            <label for="state">Tỉnh/Thành phố:</label>
                            <input class="form-control" type="text" id="state" name="state" required>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Mã bưu điện:</label>
                            <input class="form-control" type="text" id="postal_code" name="postal_code" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Quốc gia:</label>
                            <input class="form-control" type="text" id="country" name="country" required>
                        </div>

                        <br>
                        <input class="btn btn-primary" type="submit" value="Thêm Địa Chỉ">
                    </form>
                </div>
            </div>
        </aside>
    </div>



    <?php include '../include/footer.php'; ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>