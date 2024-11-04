<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Sản Phẩm</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Product Card -->
            <div class="bg-white rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="relative">
                    <a href="details.php">
                    <img class="w-100 h-100 object-cover" src="../image/be-gai1.webp" alt="Sản phẩm">

                    </a>
                    <!-- Nút Yêu thích -->
                    <button class="absolute top-2 right-2 bg-white p-2 rounded-full hover:bg-gray-100 group transition duration-200">
                        <!-- Icon -->
                        <svg class="w-5 h-5 text-red-500 group-hover:hidden" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <!-- Text xuất hiện khi hover -->
                        <span class="hidden group-hover:inline-block text-red-500 text-sm font-semibold">Yêu thích</span>
                    </button>
                </div>
                <div class="p-3">
                    <h3 class="text-lg font-semibold text-gray-800">Tên Sản Phẩm</h3>
                    <p class="text-gray-600 mt-1 text-sm">Mô tả chi tiết sản phẩm...</p>
                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-500">500.000đ</span>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <div class="mt-3 flex space-x-2">
                            <!-- Nút Thêm vào Giỏ hàng -->
                            <button class="flex items-center bg-yellow-400 text-white px-2 py-1 rounded-lg hover:bg-yellow-500 transition-colors duration-100">
                                Thêm vào Giỏ
                            </button>
                            <!-- Nút Mua Ngay -->
                            <button class="flex items-center bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                Mua Ngay
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Thêm các Product Card khác ở đây -->
        </div>
    </div>
</body>

</html>