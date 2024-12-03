    <?php
    require 'mail_config.php';
    
    if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00' && $_GET['payment_method'] == 'COD') {
        $to = "zeisc2@gmail.com";
        $subject = "Xác nhận thanh toán đơn hàng #" . $_GET['vnp_TxnRef'];
        $body = "
           <div class='email-container'>
        <div class='email-header'>
            <h1>Cảm ơn anh/chị đã mua hàng!</h1>
        </div>
        <div class='email-body'>
            <h2>Thông tin đơn hàng</h2>
            <ul>
                <li><strong>Mã giao dịch:</strong> {$_GET['vnp_TxnRef']}</li>
                <li><strong>Số tiền:</strong> " . number_format($_GET['vnp_Amount'] / 100, 0, ',', '.') . " VNĐ</li>
                <li><strong>Nội dung:</strong> {$_GET['vnp_OrderInfo']}</li>
            </ul>
            <p>Chúng tôi đã nhận được thanh toán của anh/chị và sẽ xử lý đơn hàng trong thời gian sớm nhất. Nếu cần hỗ trợ, vui lòng liên hệ:</p>
            <p>Email: <a href='mailto:support@yourwebsite.com'>support@yourwebsite.com</a></p>
        </div>
        <div class='email-footer'>
            <p>&copy; 2024 YourWebsite. Tất cả các quyền được bảo lưu.</p>
            <p><a href='https://beautiful.com'>Trang chủ</a> | <a href='https://yourwebsite.com/contact'>Liên hệ</a></p>
        </div>
    </div>
        ";
    
        if (sendMail($to, $subject, $body)) {
            echo "<h2>Email xác nhận đã được gửi!</h2>";
        } else {
            echo "<h2>Gửi email thất bại.</h2>";
        }
    }
    ?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
   .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding: 20px 0;
            background: #007bff;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }
        .email-body h2 {
            color: #007bff;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777777;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }

    .thank-you-container {
        text-align: center;
        color: black;
        animation: fadeIn 2s ease-in-out;
    }

    .thank-you-text {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin: 0;
    }

    .message {
        font-size: 1.2rem;
        margin-top: 10px;
        opacity: 0.8;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .confetti {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .confetti span {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: white;
        opacity: 0.7;
        animation: fall 3s infinite;
        border-radius: 50%;
    }

    @keyframes fall {
        from {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }

        to {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
</style>

<body>
    <div class="header">
         <?php include('../include/navbar.php'); ?>
    </div>
   
    <br>
    <br>
    <br>
    <br>

    <div class="thank-you-container">
        <h1 class="thank-you-text">Cảm ơn bạn đã mua sắm với chúng tôi! 💖</h1>
        <p class="message">Đơn hàng của bạn đang được xử lý</p>
        <p class="message">Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
        <div class="confetti"></div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <?php include('../include/footer.php'); ?>

</body>



<script>
    const confettiContainer = document.querySelector('.confetti');
    for (let i = 0; i < 140; i++) {
        const confetti = document.createElement('span');
        confetti.style.left = `${Math.random() * 100}%`;
        confetti.style.animationDelay = `${Math.random() * 3}s`;
        confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 70%)`;
        confettiContainer.appendChild(confetti);
    }

</script>

</html>