<?php 

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

$sql = "SELECT address_line, city, state, country FROM addresses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
                    <label for="address_select" class="block text-sm font-medium text-gray-700">Chọn địa chỉ giao hàng</label>
                    <select name="address_select" id="address_select" class="form-control w-full p-2 border rounded">
                        <option value="">Chọn địa chỉ giao hàng</option>
                        <?php
                        while ($address = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($address['address_line']) . '">';
                            echo htmlspecialchars($address['address_line']) . ', ' . htmlspecialchars($address['city']) . ', ' . htmlspecialchars($address['state']) . ', ' . htmlspecialchars($address['country']);
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold">Chọn phương thức thanh toán</h3>
                    <form action="process_checkout.php" method="POST">
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="COD" checked class="form-radio text-blue-500">
                                <span class="ml-2">Thanh toán khi nhận hàng</span>
                            </label>
                        </div>
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="VNPAY" class="form-radio text-blue-500">
                                <span class="ml-2">Thanh toán qua chuyển khoản (VNPAY)</span>
                            </label>
                        </div>
                        
                    </form>
                </div>
                            <br>

                            <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                Xác nhận thanh toán
                            </button>
                        </div>
        </form>
    </div>
</body>

</html>