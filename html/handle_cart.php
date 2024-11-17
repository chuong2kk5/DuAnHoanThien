<?php
session_start(); // Khởi động session

// Kiểm tra nếu giỏ hàng chưa được khởi tạo trong session thì tạo một giỏ hàng rỗng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Kết nối cơ sở dữ liệu
include "../admin/config.php";  // Kết nối DB

// Xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];  // Lấy product_id từ form

    // Kết nối CSDL và lấy thông tin sản phẩm
    include "../admin/config.php";
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem sản phẩm có tồn tại không
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào giỏ
            $_SESSION['cart'][$productId] = array(
                'id' => $product['product_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,  // Số lượng ban đầu là 1
                'image' => $product['image_path']
            );
        }
    }

    // Sau khi thêm xong, chuyển hướng lại trang giỏ hàng
    header('Location: cart_page.php');
    exit();
}


// Xử lý xóa sản phẩm khỏi giỏ hàng
// Xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $productId = $_GET['id'];  // Lấy product_id từ URL

    // Kiểm tra và xóa sản phẩm khỏi giỏ hàng
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);  // Xóa sản phẩm khỏi giỏ
    }

    // Sau khi xóa, cập nhật lại giỏ hàng trong session
    header('Location: cart_page.php');  // Chuyển hướng lại trang giỏ hàng
    exit();
}


    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && isset($_GET['quantity'])) {
    $productId = $_GET['id'];  // Lấy product_id từ URL
    $quantity = $_GET['quantity'];  // Lấy số lượng từ URL

    if ($quantity > 0 && is_numeric($quantity) && isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;   
    }

    header('Location: cart_page.php');
    exit();
    }


?>