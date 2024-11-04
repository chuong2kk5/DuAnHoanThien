<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<?php include '../include/navbar.php' ?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Giỏ Hàng</h1>
        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Sản phẩm</th>
                        <th class="py-2 text-left">Giá</th>
                        <th class="py-2 text-left">Số lượng</th>
                        <th class="py-2 text-left">Tổng</th>
                        <th class="py-2 text-left">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-4 flex items-center">
                            <img class="w-20 h-20 rounded mr-4" src="link_hinh_san_pham_1" alt="Sản phẩm 1">
                            <span>Tên Sản Phẩm 1</span>
                        </td>
                        <td class="py-4">200.000đ</td>
                        <td class="py-4">
                            <input type="number" min="1" value="1" class="border rounded w-16 text-center">
                        </td>
                        <td class="py-4">200.000đ</td>
                        <td class="py-4">
                            <button class="text-red-500 hover:text-red-700">Xóa</button>
                        </td>
                    </tr>
                  
                </tbody>
            </table>

            <div class="mt-6 flex justify-between">
                <span class="font-bold text-xl">Tổng Giá Trị Đơn Hàng: <span class="text-blue-500">500.000đ</span></span>
                <div>
                    <button class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                        Tiếp Tục Mua Sắm
                    </button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 ml-2">
                        Thanh Toán
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php include '../include/footer.php' ?>

</body>

</html>