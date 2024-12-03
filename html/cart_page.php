<?php
session_start();
include "../admin/config.php";
include "cart.php"; 
ini_set('display_errors', '1'); 

// Kiểm tra người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']);

if(!$isLoggedIn) {
    header("Location: 404login.php");
    exit;
}

$cart = new Cart($_SESSION['user_id'], $conn); 

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id']; 

    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $cart->addItem($product_id, 1); 

        // Chuyển hướng về cart_page.php
        header("Location: cart_page.php");
        exit; 
    } else {    
        echo "Sản phẩm không tồn tại";
    }
}

// Kiểm tra xem có yêu cầu cập nhật số lượng không
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Cập nhật số lượng trong giỏ hàng
    $cart->updateQuantity($id, $quantity);

    // Chuyển hướng về cart_page.php
    header("Location: cart_page.php");
    exit;
}
// Xóa sản phẩm khỏi giỏ
if (isset($_POST['action']) && $_POST['action'] === 'remove') {
    $id = $_POST['id'];
    $cart->removeItem($id);
    header("Location: cart_page.php"); // Chuyển hướng về trang giỏ hàng.  Cân nhắc thêm thông báo thành công.
    exit();
}


// Lấy tất cả sản phẩm trong giỏ
$cartItems = $cart->getItems(); 

// Tính tổng giá trị giỏ hàng
$total = $cart->getTotal(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> </head>
<body class="bg-gray-100">

<?php include '../include/navbar.php' ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8">Giỏ Hàng</h1>
    <div class="bg-white rounded-lg shadow-md p-6">
        <?php if (empty($cartItems)) { ?>
            <p class="text-center text-gray-600">Giỏ hàng của bạn hiện đang trống. Hãy thêm sản phẩm vào giỏ!</p>
            <a href="newproduct.php">Mua sản phẩm</a>
        <?php } else { ?>
            <table class="min-w-full">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cartItems as $productId => $product) { ?>
                    <tr>
<td><?php echo $product['name']; ?></td>
                        <td>
                            <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>"
                                 class="w-20 h-20 rounded">
                        </td>
                        <td><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></td>
                        <td>
                            <form action="cart_page.php" method="post">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?php echo $productId; ?>">
                                <input type="number" name="quantity" min="1" max = "10"
                                       value="<?php echo $product['quantity']; ?>"
                                       class="border rounded w-16 text-center">
                                <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Cập
                                    nhật
                                </button>
                            </form>
                        </td>
                        <td><?php echo number_format($product['quantity'] * $product['price'], 0, ',', '.') . 'đ'; ?></td>
                        <td>
                            <button class="text-red-500 hover:text-red-700 delete-button"
                                    data-product-id="<?php echo $productId; ?>">Xóa
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <div class="mt-6 flex justify-between">
                <span class="font-bold text-xl">Tổng Giá Trị Đơn Hàng: <span
                            class="text-blue-500"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></span></span>
                <div>
                    <a href="newProduct.php"
                       class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500">Tiếp
                        Tục Mua Sắm</a>
                    <a href="checkout.php"
                       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Thanh
                        Toán</a>
                </div>
                <a href="../html/thongtindathang.php">Thông tin đặt hàng</a>
            </div>
        <?php } ?>

    </div>
</div>

<?php include '../include/footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', async function(event) {
                event.preventDefault();
const productId = this.dataset.productId;
                const result = await Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
                    text: 'Hành động này không thể hoàn tác!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy',
                    allowOutsideClick: false
                });

                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'cart_page.php';
                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'remove';
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'id';
                    idInput.value = productId;
                    form.appendChild(actionInput);
                    form.appendChild(idInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

</html>