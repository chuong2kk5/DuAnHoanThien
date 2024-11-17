<?php
session_start();
 var_dump( $_SESSION['user_id']);
include "cart.php";  // Đảm bảo bạn đã bao gồm cart.php để sử dụng các hàm trong đó.
ini_set('display_errors', '1'); 
// Khởi tạo đối tượng Cart
$cart = new Cart($_SESSION['user_id'], $conn); 

// Kiểm tra xem có yêu cầu thêm sản phẩm không
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id']; 

    // Lấy thông tin sản phẩm từ database 
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Thêm sản phẩm vào giỏ hàng
        $cart->addItem($product_id, 1); 

        // Chuyển hướng về cart_page.php
        header("Location: cart_page.php");
        exit; 
    } else {
        echo "Sản phẩm không tồn tại";
    }
}

// Kiểm tra xem có yêu cầu cập nhật số lượng không
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Cập nhật số lượng trong giỏ hàng
    $cart->updateQuantity($id, $quantity);

    // Chuyển hướng về cart_page.php
    header("Location: cart_page.php");
    exit;
}
// Xóa sản phẩm khỏi giỏ
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $id = $_GET['id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $cart->removeItem($id);

    // Chuyển hướng về cart_page.php
    header("Location: cart_page.php");
    exit;
}



// Lấy tất cả sản phẩm trong giỏ
$cartItems = $cart->getItems(); 

// Tính tổng giá trị giỏ hàng
$total = $cart->getTotal(); 
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
  <?php include '../include/navbar.php'?>
    <div class="container mx-auto p-6">
      
        <h1 class="text-3xl font-bold text-center mb-8">Giỏ Hàng</h1>
        <div class="bg-white rounded-lg shadow-md p-6">
            <?php if (empty($cartItems)) { ?>
                <p class="text-center text-gray-600">Giỏ hàng của bạn hiện đang trống. Hãy thêm sản phẩm vào giỏ!</p>
                <a href="newproduct.php">Mua sản phẩm</a>
            <?php } else { ?>
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Sản phẩm</th>
                            <th class="py-2 text-left">Ảnh sản phẩm</th>
                            <th class="py-2 text-left">Giá</th>
                            <th class="py-2 text-left">Số lượng</th>
                            <th class="py-2 text-left">Tổng</th>
                            <th class="py-2 text-left">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $productId => $product) { ?>
                            <tr class="border-b">
                                <td class="py-4"><?php echo $product['name']; ?></td>
                                <td class="py-4 flex items-center">
                                    <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>" class="w-20 h-20 rounded">
                                </td>
                                <td class="py-4"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></td>
                                <td class="py-4">
                                    <form action="cart_page.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?php echo $productId; ?>">
                                        <input type="number" name="quantity" min="1" value="<?php echo $product['quantity']; ?>" class="border rounded w-16 text-center">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 ml-2">Cập nhật</button>
                                    </form>
                                </td>
                                </td>
                                <td class="py-4"><?php echo number_format($product['quantity'] * $product['price'], 0, ',', '.') . 'đ'; ?></td>
                                <td class="py-4">
                                    <a href="cart.php?action=remove&id=<?php echo $productId; ?>" class="text-red-500 hover:text-red-700">Xóa</a>
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
                    <a href="../html/thongtindathang.php">Thông tin đặt hàng</a>
                </div>
            <?php } ?>
       
        </div>
    </div>

</body>

</html>