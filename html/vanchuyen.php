<?php
session_start();
include_once '../admin/config.php';
include_once '../html/cart.php';

// Khởi tạo đối tượng Cart nếu có user_id trong session
if (isset($_SESSION['user_id'])) {
    $cart = new Cart($_SESSION['user_id'], $conn);
} else {
    echo "User is not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];  // Lấy user_id từ session

// Truy vấn thông tin địa chỉ của người dùng
$sql = "SELECT name, phone, address, city, note FROM user_addresses WHERE user_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // Bind tham số user_id (kiểu integer)
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem có kết quả từ cơ sở dữ liệu không
if ($result->num_rows > 0) {
    $address = $result->fetch_assoc();  // Lấy thông tin địa chỉ của người dùng
} else {
    echo "No address found.";
    exit;
}

$cartItems = $cart->getItems();  // Lấy tất cả sản phẩm trong giỏ
$total = $cart->getTotal();  // Tính tổng giá trị giỏ hàng
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bar.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Thông tin vận chuyển</title>
</head>
<body class="bg-gray-100">
    <?php include '../include/navbar.php'?>

    <div class="container mx-auto p-6">
        <!-- Hiển thị các bước -->
        <div class="arrow-steps clearfix mb-6">
            <div class="step" style="background-color:#0076CB; border-left-color:#0076CB"> <span><a href="cart_page.php">Giỏ hàng</a></span> </div>
            <div class="step" style="background-color:#008FD3;border-left-color:#008FD3"> <span><a href="vanchuyen.php">Vận chuyển</a></span> </div>
            <div class="step" style="background-color:#609A7E;border-left-color:#609A7E"> <span><a href="thongtinthanhtoan.php">Thanh toán</a></span> </div>
            <div class="step" style="background-color:#BEA42A;border-left-color:#BEA42A"> <span><a href="donhangdadat.php">Chi tiết đơn hàng</a></span> </div>
        </div>

        <h1 class="text-3xl font-bold text-center mb-8">Thông tin người nhận</h1>

            <!-- Hiển thị thông tin địa chỉ người nhận -->
            <?php if ($result->num_rows > 0) { ?>
                <div class="address-container">
                    <div class="address-item">
                        <strong>Họ và tên:</strong> <?php echo $address['name']; ?>
                    </div>
                    <div class="address-item">
                        <strong>Số điện thoại:</strong> <?php echo $address['phone']; ?>
                    </div>
                    <div class="address-item">
                        <strong>Địa chỉ:</strong> <?php echo $address['address']; ?>, <?php echo $address['city']; ?>
                    </div>
                    <?php if (!empty($address['note'])) { ?>
                        <div class="address-item">
                            <strong>Ghi chú:</strong> <?php echo $address['note']; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p class="no-info">Chưa có thông tin giao hàng.</p>
            <?php } ?>


        <h2 class="text-2xl font-semibold mt-8">Giỏ Hàng</h2>

        <!-- Hiển thị giỏ hàng -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <?php if (empty($cartItems)) { ?>
                <a href="newproduct.php" class="text-blue-500">Mua sản phẩm</a>
            <?php } else { ?>
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Sản phẩm</th>
                            <th class="py-2 text-left">Giá</th>
                            <th class="py-2 text-left">Số lượng</th>
                            <th class="py-2 text-left">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $productId => $product) { ?>
                            <tr class="border-b">
                                <td class="py-4"><?php echo $product['name']; ?></td>
                                <td class="py-4"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></td>
                                <td class="py-4"><?php echo $product['quantity']; ?></td>
                                <td class="py-4"><?php echo number_format($product['quantity'] * $product['price'], 0, ',', '.') . 'đ'; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-between">
                    <span class="font-bold text-xl">Tổng Giá Trị Đơn Hàng: <span class="text-blue-500"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></span></span>
                    <div>
                        <a href="newproduct.php" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-200">Tiếp Tục Mua Sắm</a>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 ml-2" onclick="window.location.href='thongtinthanhtoan.php'">Thanh Toán</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>