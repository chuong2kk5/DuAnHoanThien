<?php
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/duannhom/duAn1/html/thankyou.php";  // Địa chỉ trang sẽ nhận kết quả sau khi thanh toán
$vnp_TmnCode = "LZQZT9G8"; // Mã website tại VNPAY 
$vnp_HashSecret = "DWV1B2D4O4L3N6CWF2YKNHMBTMAIKZI4"; // Chuỗi bí mật

$vnp_TxnRef = rand(100000,999999); // Mã đơn hàng
$vnp_OrderInfo = 'Thanh toán đơn hàng'; // Nội dung thanh toán
$vnp_OrderType = 'Mua hàng'; // Loại đơn hàng
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB'; // Mã ngân hàng nếu cần

$vnp_Amount = $_GET['total'] * 100; // Tổng tiền, VNPAY yêu cầu tính theo đơn vị "sát" (1 VND = 100)
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date(format: 'YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

// Mã hóa các tham số và thêm mã bảo mật
ksort(array: $inputData);
$hashdata = "";
foreach ($inputData as $key => $value) {
    $hashdata .= urlencode($key) . "=" . urlencode($value) . "&";
}
$vnpSecureHash = hash_hmac('sha512', rtrim($hashdata, '&'), $vnp_HashSecret);

// Tạo URL và chuyển hướng
$vnp_Url .= "?" . http_build_query($inputData) . "&vnp_SecureHash=" . $vnpSecureHash;
header(header: 'Location: ' . $vnp_Url);
exit;
?>
