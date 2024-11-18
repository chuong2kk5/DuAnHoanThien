<?php
session_start();

// Kiểm tra xem có thông tin tổng tiền từ trước khi chuyển hướng
if (!isset($_GET['total']) || $_GET['total'] <= 0) {
    die("Lỗi: Không có thông tin thanh toán.");
}

// Các thông tin nhận được từ form thanh toán
$total = $_GET['total'];
$order_id = time(); // Sử dụng thời gian hiện tại làm mã đơn hàng
$order_desc = 'Thanh toán đơn hàng qua VNPAY'; // Mô tả đơn hàng

// Các thông tin kết nối với VNPAY (nhớ thay thế các giá trị này bằng thông tin của bạn)
$vnp_TmnCode = 'Your_TMN_Code'; // Mã thương nhân
$vnp_HashSecret = 'Your_Hash_Secret'; // Chìa khóa bí mật
$vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vnpay.zalopay.vn'; // Địa chỉ URL VNPAY

// URL trả kết quả sau khi thanh toán
$vnp_Returnurl = 'https://yourwebsite.com/vnpay_return.php'; // Địa chỉ để nhận kết quả từ VNPAY

// Thông tin gửi lên VNPAY
$vnp_TxnRef = $order_id; // Mã đơn hàng
$vnp_OrderInfo = $order_desc; // Mô tả đơn hàng
$vnp_Amount = $total * 100; // Tổng tiền cần thanh toán, VNPAY yêu cầu phải nhân với 100 (VND)
$vnp_Locale = 'vn'; // Ngôn ngữ giao diện, có thể là 'vn' (Tiếng Việt) hoặc 'en' (Tiếng Anh)
$vnp_Currency = 'VND'; // Đơn vị tiền tệ
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của người thanh toán

// Tạo dữ liệu gửi lên VNPAY (các tham số yêu cầu)
$vnp_Params = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_Currency" => $vnp_Currency,
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_Returnurl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_SecureHashType" => "SHA256",
);

// Tạo chuỗi tham số để hash
$hash_data = http_build_query($vnp_Params);
$secure_hash = hash_hmac('sha256', $hash_data, $vnp_HashSecret);

// Thêm tham số hash vào mảng
$vnp_Params['vnp_SecureHash'] = $secure_hash;

// Chuyển hướng người dùng đến URL thanh toán VNPAY
$vnp_Url .= "?" . http_build_query($vnp_Params);

header("Location: $vnp_Url");
exit;
?>
