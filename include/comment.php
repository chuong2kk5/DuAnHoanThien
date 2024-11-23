<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Đánh giá sản phẩm</h3>
        <form method="POST" action="add_review.php">
            <input type="hidden" name="user_id" value="1"> 
            <input type="hidden" name="product_id" value="1">  
            
            <div class="mb-3">
                <label for="rating" class="form-label">Chọn đánh giá:</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="" disabled selected>Chọn số sao</option>
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select>
            </div>
            
            <div class="mb-3">
                <textarea class="form-control" name="comment" rows="3" placeholder="Nhập đánh giá của bạn..." required></textarea>
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
            </div>
        </form>
        <hr>
        <div id="reviewsList">
            <h5 class="mb-4">Các đánh giá của khách hàng</h5>
            <?php include 'display_reviews.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
