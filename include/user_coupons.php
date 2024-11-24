<?php
include '../admin/config.php';

// Lấy danh sách mã giảm giá từ database
$sql = "SELECT * FROM coupons WHERE is_active = 1 AND expiry_date >= CURDATE()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã Giảm Giá - Khuyến Mãi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .coupon-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            overflow: hidden;
            margin-bottom: 20px;
            padding: 20px;
        }
        .coupon-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .coupon-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .coupon-content {
            padding-top: 15px;
        }
        .coupon-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .coupon-discount {
            font-size: 1.6rem;
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .expiry-date {
            font-size: 1rem;
            color: #dc3545;
            margin-bottom: 15px;
        }
        .coupon-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .coupon-btn:hover {
            background-color: #0056b3;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .col-md-4 {
            flex: 1 0 30%;
            max-width: 30%;
        }
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 1 0 48%;
                max-width: 48%;
            }
        }
        @media (max-width: 576px) {
            .col-md-4 {
                flex: 1 0 100%;
                max-width: 100%;
            }
        }
        .card-header {
            font-size: 1.4rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center my-4">Mã Giảm Giá - Khuyến Mãi</h1>

    <!-- Kiểm tra nếu có mã giảm giá -->
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($coupon = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="coupon-card">
                        <div class="coupon-content">
                            <p class="coupon-title"><?php echo htmlspecialchars($coupon['code']); ?></p>
                            <p class="coupon-discount"><?php echo htmlspecialchars($coupon['discount_percentage']); ?>% Giảm giá</p>
                            <p class="expiry-date">Hạn sử dụng: <?php echo htmlspecialchars($coupon['expiry_date']); ?></p>
                            <button class="coupon-btn" onclick="copyCode('<?php echo htmlspecialchars($coupon['code']); ?>')">Sao chép mã</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Hiện tại không có mã giảm giá nào khả dụng.</div>
    <?php endif; ?>
</div>

<script>
    function copyCode(code) {
        navigator.clipboard.writeText(code).then(function() {
            alert("Đã sao chép mã: " + code);
        }, function(err) {
            alert("Không thể sao chép mã. Vui lòng thử lại.");
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
