<?php
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/duAn1/html/thankyou.php";
$vnp_TmnCode = "LZQZT9G8";
$vnp_HashSecret = "DWV1B2D4O4L3N6CWF2YKNHMBTMAIKZI4";

$vnp_TxnRef = rand(100000, 999999);
$vnp_OrderInfo = 'Thanh toán đơn hàng';
$vnp_OrderType = 'Mua hàng';
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';

$vnp_Amount = $_GET['total'] * 100;
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

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

ksort(array: $inputData);
$hashdata = "";
foreach ($inputData as $key => $value) {
    $hashdata .= urlencode($key) . "=" . urlencode($value) . "&";
}
$vnpSecureHash = hash_hmac('sha512', rtrim($hashdata, '&'), $vnp_HashSecret);

$vnp_Url .= "?" . http_build_query($inputData) . "&vnp_SecureHash=" . $vnpSecureHash;
header(header: 'Location: ' . $vnp_Url);
exit;
?>