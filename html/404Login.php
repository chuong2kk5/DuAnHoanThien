<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            text-align: center;
        }

        .number-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }

        .number {
            font-size: 7rem;
            font-weight: bold;
            color: #4A90E2;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .number:hover {
            transform: scale(1.2);
        }

        p {
            font-size: 1.5rem;
            color: #666;
            text-align: center;
        }

        a.back {
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4A90E2;
            color: whitesmoke;
            text-decoration: none;
            border-radius: 5px;
        }

        a.back:hover {
            background-color: #0056b3;
            color: #ffffff;
            text-decoration: none;

        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include '../include/navbar.php'; ?>
    <div class="container mx-auto text-center mt-20">
        <p class="text-xl mt-4">
        <div class="number-container">
            <h1 class="number">4</h1>
            <h1 class="number">0</h1>
            <h1 class="number">4</h1>
        </div>
        <p>Vui lòng đăng nhập trước khi xem giỏ hàng</p>

        <?php
        if (!$isLoggedIn) {
            echo " <script>
                     Swal.fire('Vui lòng đăng nhập!');

         </script>";
        }
        ?>

    </div>
    <?php include '../include/footer.php'; ?>

</body>

</html>