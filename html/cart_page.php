<?php
session_start(); // Khởi động session

// Kiểm tra nếu giỏ hàng chưa được khởi tạo trong session thì tạo một giỏ hàng rỗng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Lấy giỏ hàng từ session
$cartItems = $_SESSION['cart'];

// Tính tổng giá trị đơn hàng
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['quantity'] * $item['price'];  // Tính tổng cho từng sản phẩm
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Giỏ Hàng</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Sản phẩm</th>
                        <th class="py-2 text-left">Giá</th>
                        <th class="py-2 text-left">Số lượng</th>
                        <th class="py-2 text-left">Tổng</th>
                        <th class="py-2 text-left">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $productId => $product) { ?>
                        <tr class="border-b">
                            <td class="py-4 flex items-center">
                                <img class="w-20 h-20 rounded mr-4" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                <span><?php echo $product['name']; ?></span>
                            </td>
                            <td class="py-4"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></td>
                            <td class="py-4">
                                <form action="handle_cart.php" method="GET">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?php echo $productId; ?>" />
                                    <input type="number" name="quantity" min="1" value="<?php echo $product['quantity']; ?>" class="border rounded w-16 text-center" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="py-4"><?php echo number_format($product['quantity'] * $product['price'], 0, ',', '.') . 'đ'; ?></td>
                            <td class="py-4">
                                <a href="handle_cart.php?action=remove&id=<?php echo $productId; ?>" class="text-red-500 hover:text-red-700">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="mt-6 flex justify-between">
                <span class="font-bold text-xl">Tổng Giá Trị Đơn Hàng: <span class="text-blue-500"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></span></span>
                <div>
                    <a href="newProduct.php" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-200">Tiếp Tục Mua Sắm</a>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 ml-2">Thanh Toán</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>