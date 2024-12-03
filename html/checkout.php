<?php
session_start();
include "cart.php";
ini_set('display_errors', '1');

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để thực hiện thanh toán.");
}

$user_id = $_SESSION['user_id'];
$cart = new Cart($user_id, $conn);
$cartItems = $cart->getItems();
$total = $cart->getTotal();

// Truy vấn lấy địa chỉ của người dùng
$sql = "SELECT address_line, city, state, country FROM addresses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có dữ liệu từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    // Lấy thông tin sản phẩm từ POST
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    // Tạo giỏ hàng và thêm sản phẩm vào giỏ hàng

    $cart = new Cart($user_id, $conn);
    $cart->addItem($product_id, $quantity, $price);   

    // Chuyển hướng người dùng tới trang thanh toán
    header("Location: checkout.php");
    exit();
}

foreach ($cartItems as $item) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];

    // Truy vấn giảm số lượng sản phẩm trong kho
    $updatequantitySql = "UPDATE products SET quantity = quantity - ? WHERE product_id = ?";
    $stmt = $conn->prepare($updatequantitySql);
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();
}

 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include '../include/navbar.php'; ?>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Thanh Toán</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Sản phẩm trong giỏ</h2>
            <?php if (empty($cartItems)) { ?>
                <p class="text-center text-gray-600">Giỏ hàng của bạn hiện đang trống. Hãy thêm sản phẩm vào giỏ!</p>
                <a href="newproduct.php" class="text-blue-500">Tiếp tục mua sắm</a>
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
                        <?php foreach ($cartItems as $item) { ?>
                            <tr class="border-b">
                                <td class="py-4"><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="py-4"><?php echo number_format($item['price'], 0, ',', '.') . 'đ'; ?></td>
                                <td class="py-4"><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td class="py-4">
                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="mt-6">
                    <span class="font-bold text-xl">Tổng Giá Trị Đơn Hàng:
                        <span class="text-blue-500"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></span>
                    </span>
                </div>
            <?php } ?>
        </div>

        <?php if (!empty($cartItems)) { ?>
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h2 class="text-2xl font-semibold mb-4">Thông tin khách hàng</h2>
                <form action="process_checkout.php" method="POST">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Họ và Tên</label>
                        <input type="text" name="name" id="name" required class="mt-1 p-2 border rounded w-full">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" required class="mt-1 p-2 border rounded w-full">
                    </div>
                    <div class="mb-4">
                        <label for="address_select" class="block text-sm font-medium text-gray-700">Chọn địa chỉ giao
                            hàng</label>
                        <select name="address_select" id="address_select" class="form-control w-full p-2 border rounded">
                            <option value="">Chọn địa chỉ giao hàng</option>
                            <?php
                            while ($address = $result->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($address['address_line']) . '">';
                                echo htmlspecialchars($address['address_line']) . ', ' . htmlspecialchars($address['city']) . ', ' . htmlspecialchars($address['state']) . ', ' . htmlspecialchars($address['country']);
                                echo '</option>';
                            }
                            ?>
                            <div class="mt-6">
                                <h3 class="text-xl font-semibold">Chọn phương thức thanh toán</h3>
                                <div class="mt-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="payment_method" value="COD" checked
                                            class="form-radio text-blue-500">
                                        <span class="ml-2">Thanh toán khi nhận hàng</span>
                                    </label>
                                </div>
                                <div class="mt-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="payment_method" value="VNPAY"
                                            class="form-radio text-blue-500">
                                        <span class="ml-2">Thanh toán qua chuyển khoản (VNPAY)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Thêm tổng tiền vào POST -->
                            <input type="hidden" name="total" value="<?php echo $total; ?>">

                            <div class="mt-6">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                    Xác nhận thanh toán
                                </button>
                            </div>
                </form>
            </div>
        <?php } ?>
    </div>

    <?php include '../include/footer.php'; ?>
</body>

</html>