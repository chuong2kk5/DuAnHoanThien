<?php 
session_start();
require_once '../admin/config.php';

//  logic comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment_content = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = $_SESSION['user_id'];  
    $product_id = $_GET['product_id'] ?? $product_id; 

    if (!empty($comment_content)) {
        $insert_comment_sql = "INSERT INTO comments (product_id, user_id, content, created_at) 
                               VALUES ($product_id, $user_id, '$comment_content', NOW())";
        if (mysqli_query($conn, $insert_comment_sql)) {
            echo "
                <script> 
                    alert('Đã đăng đánh giá');
                    window.location.href = 'details.php?product_id=$product_id';
                </script>
            ";
            
            exit;
        } else {
            echo "<p class='error'>Có lỗi xảy ra khi thêm bình luận. Vui lòng thử lại.</p>";
        }
    } else {
        echo "<p class='error'>Nội dung bình luận không được để trống!</p>";
    }
}