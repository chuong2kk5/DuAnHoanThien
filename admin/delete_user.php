<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Kiểm tra ID người dùng
    if (isset($user_id) && !empty($user_id)) {
        // Kiểm tra xem người dùng có đơn hàng chưa thanh toán hay không
        $sql_check_order = "SELECT COUNT(*) FROM orders WHERE user_id = ? AND status = 'pending'"; // Giả sử 'pending' là trạng thái chưa thanh toán
        $stmt_check_order = $conn->prepare($sql_check_order);
        $stmt_check_order->bind_param("i", $user_id);
        $stmt_check_order->execute();
        $stmt_check_order->bind_result($order_count);
        $stmt_check_order->fetch();
        $stmt_check_order->close();

        if ($order_count > 0) {
            // Nếu có đơn hàng chưa thanh toán, không cho phép xóa
            $message = "Không thể xóa người dùng vì có đơn hàng chưa thanh toán!";
        } else {
            // Kiểm tra xem người dùng có địa chỉ trong bảng addresses không
            $sql_check_address = "SELECT COUNT(*) FROM addresses WHERE user_id = ?";
            $stmt_check_address = $conn->prepare($sql_check_address);
            $stmt_check_address->bind_param("i", $user_id);
            $stmt_check_address->execute();
            $stmt_check_address->bind_result($address_count);
            $stmt_check_address->fetch();
            $stmt_check_address->close();

            if ($address_count > 0) {
                // Nếu người dùng có địa chỉ, xóa các địa chỉ liên quan
                $sql_delete_address = "DELETE FROM addresses WHERE user_id = ?";
                $stmt_delete_address = $conn->prepare($sql_delete_address);
                $stmt_delete_address->bind_param("i", $user_id);
                $stmt_delete_address->execute();
                $stmt_delete_address->close();
            }

            // Kiểm tra xem người dùng có sản phẩm trong giỏ hàng không
            $sql_check_cart = "SELECT COUNT(*) FROM carts WHERE user_id = ?";
            $stmt_check_cart = $conn->prepare($sql_check_cart);
            $stmt_check_cart->bind_param("i", $user_id);
            $stmt_check_cart->execute();
            $stmt_check_cart->bind_result($cart_count);
            $stmt_check_cart->fetch();
            $stmt_check_cart->close();

            if ($cart_count > 0) {
                // Nếu người dùng có sản phẩm trong giỏ hàng, xóa các sản phẩm trong giỏ hàng
                $sql_delete_cart = "DELETE FROM carts WHERE user_id = ?";
                $stmt_delete_cart = $conn->prepare($sql_delete_cart);
                $stmt_delete_cart->bind_param("i", $user_id);
                $stmt_delete_cart->execute();
                $stmt_delete_cart->close();
            }

            
             $sql_check_cart_items = "SELECT COUNT(*) FROM cart_items WHERE user_id = ?";
            $stmt_check_cart_items = $conn->prepare($sql_check_cart_items);
            $stmt_check_cart_items->bind_param("i", $user_id);
            $stmt_check_cart_items->execute();
            $stmt_check_cart_items->bind_result($cart_items_count);
            $stmt_check_cart_items->fetch();
            $stmt_check_cart_items->close();

            if ($cart_items_count > 0) {
                // Nếu người dùng có sản phẩm trong giỏ hàng, xóa các sản phẩm trong giỏ hàng
                $sql_delete_cart_items = "DELETE FROM cart_items WHERE user_id = ?";
                $stmt_delete_cart_items = $conn->prepare($sql_delete_cart_items);
                $stmt_delete_cart_items->bind_param("i", $user_id);
                $stmt_delete_cart_items->execute();
                $stmt_delete_cart_items->close();
            }

            // Thực hiện xóa người dùng
            $sql = "DELETE FROM users WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);

            if ($stmt->execute()) {
                $message = "Người dùng và các dữ liệu liên quan (địa chỉ, giỏ hàng) đã được xóa thành công!";
            } else {
                $message = "Xóa người dùng không thành công. Vui lòng thử lại!";
            }
            $stmt->close();
        }
    } else {
        $message = "Không tìm thấy người dùng";
    }

    // Chuyển hướng với thông báo
    header("Location: manage_users.php?message=" . urlencode($message));
    exit();
}

$conn->close();
?>
