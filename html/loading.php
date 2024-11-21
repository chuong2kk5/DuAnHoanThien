<?php 
include_once '../admin/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* Style cho overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex; /* Hiển thị loading khi tải trang */
        justify-content: center;
        align-items: center;
        z-index: 9999; /* Đảm bảo overlay ở trên cùng */
        opacity: 1;
        pointer-events: none; /* Không làm gián đoạn các phần tử bên dưới */
    }

    /* Style cho spinner */
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin .4s linear infinite;
    }

    /* Animation quay */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<body>
<div class="overlay" id="loading">
    <div class="spinner"></div>
</div>


<script>
    // Sau khi DOM được tải xong, bắt đầu chạy hiệu ứng fade-out
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.getElementById('loading').style.opacity = '0'; // Làm mờ overlay
        }, 300); // Đợi 1 giây rồi bắt đầu mờ dần
    });
</script>
</body>
</html>