<?php
include '../admin/config.php';

// Truy vấn danh sách hình ảnh
$sql = "SELECT * FROM slides";
$result = $conn->query($sql);

// Đóng kết nối
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Slider</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <style>
     img{
        height: 500px;
        width: 100%;
    }
  </style>
 

    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php if ($result->num_rows > 0): ?>
                <?php for ($i = 0; $i < $result->num_rows; $i++): ?>
                    <li data-target="#carouselId" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
                <?php endfor; ?>
            <?php endif; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php if ($result->num_rows > 0): ?>
                <?php $active = true; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="carousel-item <?= $active ? 'active' : '' ?>">
                        <img src="<?= $row['image_path'] ?>" alt="<?= $row['alt_text'] ?>">
                    </div>
                    <?php $active = false; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
