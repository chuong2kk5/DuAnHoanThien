<?php
session_start();
include "../admin/config.php";
include "cart.php";

if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để thực hiện thanh toán.");
}

// Lấy thông tin người dùng và giỏ hàng
$user_id = $_SESSION['user_id'];
$cart = new Cart($user_id, $conn);
$cartItems = $cart->getItems();

$total = $cart->getTotal();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address_select'];
    $payment_method = $_POST['payment_method'];

    if ($payment_method == 'VNPAY') {
        
        header('Location: vnpay_payment.php?total=' . $total);
        exit;
    }

    $sql = "INSERT INTO orders (user_id, name, phone, address, total, order_date, payment_method) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare(query: $sql);
    $stmt->bind_param("isssds", $user_id, $name, $phone, $address, $total, $payment_method);

    $cart = new Cart($user_id, $conn);
    $total = $cart->getTotal();

    if ($stmt->execute()) {
        $order_id = $conn->insert_id;

        foreach ($cart->getItems() as $item) {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }


        $cart->clearCart();

        header("Location: thankyou.php");
        exit;
    } else {
        echo "Đã xảy ra lỗi khi xử lý đơn hàng.";
    }
}
?>