<?php
require_once '../admin/config.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!$isLoggedIn) {
    echo "
   <script>
       Swal.fire('Vui lòng đăng nhập!');
   </script>;      
   ";
    exit;
}

// Kiểm tra khi form yêu thích được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // Kiểm tra sản phẩm đã có trong danh sách yêu thích chưa
    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Thêm sản phẩm vào danh sách yêu thích
        $insert_sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
           
        } else {
            echo "<script>alert('Lỗi khi thêm sản phẩm vào cơ sở dữ liệu.');</script>";
        }
    } else {
        // Xóa sản phẩm khỏi danh sách yêu thích
        $delete_sql = "DELETE FROM favorites WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
            
        } else {
            echo "<script>alert('Lỗi khi xóa sản phẩm khỏi danh sách yêu thích.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 


</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Sản Phẩm</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Lấy danh sách sản phẩm từ cơ sở dữ liệu
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Kiểm tra xem sản phẩm có trong danh sách yêu thích của người dùng không
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
                            <a href="details.php?id=<?php echo $row['product_id']; ?>">
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

                            <button
                                class="flex items-center bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200">Mua
                                Ngay</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='col-span-full text-center'>Không có sản phẩm nào</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>