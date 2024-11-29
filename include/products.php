<?php
require_once '../admin/config.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!$isLoggedIn) {
    echo "
   <script>
       Swal.fire('Vui lòng đăng nhập!');
   </script>";
    exit;
}

// favorite 



// Cấu hình phân trang
$limit = 8; // Số sản phẩm mỗi trang
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
$offset = ($page - 1) * $limit; // Tính toán vị trí bắt đầu của dữ liệu

// Truy vấn lấy danh sách sản phẩm với phân trang
$sql = "SELECT * FROM products LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Truy vấn để lấy tổng số sản phẩm
$sql_count = "SELECT COUNT(*) AS total FROM products";
$count_result = $conn->query($sql_count);
$row_count = $count_result->fetch_assoc();
$total_products = $row_count['total'];
$total_pages = ceil($total_products / $limit); // Tổng số trang
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .pagination-link {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .pagination-link:hover {
            background-color: #0056b3;
        }

        .pagination-link.active {
            background-color: #0056b3;
            font-weight: bold;
        }

        .pagination-info {
            font-size: 16px;
            font-weight: bold;
        }

        .pagination-link:disabled {
            background-color: #ccc;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Sản Phẩm</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = $_SESSION['user_id'];
                    $check_fav_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
                    $stmt = $conn->prepare($check_fav_sql);
                    $stmt->bind_param("ii", $user_id, $row['product_id']);
                    $stmt->execute();
                    $fav_result = $stmt->get_result();
                    $is_favorite = $fav_result->num_rows > 0;
                    ?>

                    <div class="bg-white rounded-lg overflow-hidden">
                        <div class="relative">
                            <a href="details.php?product_id=<?php echo $row['product_id']; ?>">
                                <img class="w-full h-64 object-cover" src="<?php echo $row['image_path']; ?>"
                                    alt="<?php echo $row['name']; ?>">
                            </a>

                            <!-- Form yêu thích -->
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <button type="submit"
                                    class="absolute top-2 right-2 bg-white p-2 rounded-full hover:bg-gray-100">
                                    <svg class="w-5 h-5 <?php echo $is_favorite ? 'text-red-500' : 'text-gray-500'; ?>"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                        <div class="p-3">
                            <h3 class="text-lg font-semibold text-gray-800"><?php echo $row["name"]; ?></h3>
                            <span
                                class="text-lg font-bold text-blue-500"><?php echo number_format($row["price"], 0, ',', '.') . 'đ'; ?></span>
                        </div>
                        <div class="mt-3 flex space-x-2">
                            <form action="cart_page.php" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <button class="btn btn-success" type="submit">Thêm vào Giỏ</button>
                            </form>

                            <a href="details.php?product_id=<?php echo $row['product_id']; ?>" class="flex items-center bg-blue-500 text-white px-2 py-1 round
                            ed-lg hover:bg-blue-600 transition-colors duration-200">Mua Ngay</a>
                             
                                 
                        </div>
                    </div>

                <?php }
            } else {
                echo "<p class='col-span-full text-center'>Không có sản phẩm nào</p>";
            }
            ?>
        </div>

        <div class="pagination mt-8 text-center">
            <?php
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $page + 2);

            for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="pagination-link <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
            <!-- Nút "Trang tiếp theo" -->
        </div>



    </div>
</body>

</html>