<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
<?php include '../include/navbar.php' ?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Chi Tiết Sản Phẩm</h1>
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row">
            <!-- Hình ảnh sản phẩm -->
            <div class="md:w-1/2">
                <img class="w-full h-auto rounded-lg" src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Sản phẩm">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="md:w-1/2 md:pl-6">
                <h2 class="text-2xl font-semibold mt-4 md:mt-0">Tên Sản Phẩm</h2>
                <span class="text-xl font-bold text-blue-500 mt-4 block">500.000đ</span>
                <p class="text-gray-600 mt-2">Mô tả chi tiết về sản phẩm. Nơi đây có thể chứa thông tin về tính năng, công dụng, và những điều đặc biệt của sản phẩm.</p>

                <h3 class="text-lg font-semibold mt-4">Thông số kỹ thuật:</h3>
                <ul class="list-disc list-inside text-gray-600 mt-2">
                    <li>Kích thước: 10 x 5 x 2 cm</li>
                    <li>Trọng lượng: 200g</li>
                    <li>Chất liệu: Nhựa cao cấp</li>
                    <li>Màu sắc: Đen, Trắng, Xanh</li>
                </ul>

                <h3 class="text-lg font-semibold mt-4">Đánh giá của khách hàng:</h3>
                <div class="mt-2">
                    <p class="text-gray-600">"Sản phẩm rất tốt, chất lượng tuyệt vời!" - <span class="font-semibold">Nguyễn Văn A</span></p>
                    <p class="text-gray-600">"Tôi rất hài lòng với dịch vụ và sản phẩm." - <span class="font-semibold">Trần Thị B</span></p>
                </div>

                <div class="mt-6 flex space-x-2">
                    <!-- Nút Yêu thích -->
                    <button class="flex items-center bg-white border border-gray-300 text-gray-800 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <svg class="w-5 h-5 text-red-500 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        Yêu thích
                    </button>
                    <!-- Nút Thêm vào Giỏ hàng -->
                    <button class="bg-yellow-400 text-white px-3 py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                        Thêm vào Giỏ
                    </button>
                    <!-- Nút Mua Ngay -->
                    <button class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                        Mua Ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../include/footer.php' ?>
</body>

</html>