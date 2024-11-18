<?php
include_once '../admin/config.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM products";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card ">
        <?php var_dump($user_id); ?>
        <div class="card-header">
            Đơn Hàng
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th style="width: 150px;">Tổng đơn hàng</th>
                        <th style="width: 150px;">đánh giá nhanh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="../image/" alt="ảnh-sản-phẩm" style="height: 80px;">
                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                            <p class="text-dsc">Hoàn háo cho phái nam và phát nữ form áo gọn gàng thanh
                                lịch phù hợp
                                với mọi gu thời trang</p>
                        </td>
                        <td>
                            <h5 class="price"> 526.000 vnđ </h5>
                        </td>
                        <td>#####</td>
                        <td>
                            <button type="submit" class="btn btn-primary">Viết đánh giá</button>
                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            Đơn hàng đã mua của bạn!
        </div>
    </div>
</body>

</html>