<?php
include('../admin/config.php');

// Số bài viết trên mỗi trang
$posts_per_page = 1;

// Lấy số trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $posts_per_page;

// Lấy dữ liệu từ cơ sở dữ liệu cho phân trang
$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $posts_per_page OFFSET $offset";
$result = $conn->query($sql);

// Lấy tổng số bài viết
$sql_total = "SELECT COUNT(*) AS total_posts FROM posts";
$total_result = $conn->query($sql_total);
$total_posts = $total_result->fetch_assoc()['total_posts'];
$total_pages = ceil($total_posts / $posts_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Cải thiện kiểu dáng bài viết */
        .col-md-8 {
            margin-top: 20px;
        }

        article {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        article:hover {
            transform: translateY(-5px);
        }

        h2.text-primary {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        p.text-muted {
            font-size: 0.9em;
            margin-bottom: 15px;
        }

        img.img-fluid {
            border-radius: 8px;
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }

        a.btn.btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1.1em;
            border-radius: 4px;
            text-decoration: none;
        }

        a.btn.btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Phân trang */
        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .pagination a {
            color: #007bff;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #ddd;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active a {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <?php include('../include/navbar.php'); ?>

    <div class="container my-5">
        <h1 class="text-center mb-5">Danh Sách Bài Viết</h1>

        <div class="row">
            <!-- Blog Posts -->
            <div class="col-md-8">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <article class="mb-4">
                        <h2 class="text-primary"><?= htmlspecialchars($row['title']) ?></h2>
                        <p class="text-muted">Posted on <strong><?= $row['created_at'] ?></strong></p>
                        <?php if (!empty($row['image_path'])): ?>
                            <img style="width: 30%; height: auto;" src="<?= htmlspecialchars($row['image_path']) ?>" class="img-fluid rounded mb-3" alt="Blog Image">
                        <?php endif; ?>
                        <p><?= nl2br(htmlspecialchars(substr($row['content'], 0, 200))) ?>...</p>
                        <a href="post_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Read More</a>

                    </article>
                    <hr>
                <?php endwhile; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">About Me</div>
                    <div class="card-body">
                        <p>Hi! We are beautiful, and this is my blog about clothes.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Categories</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#">Technology</a></li>
                        <li class="list-group-item"><a href="#">Life</a></li>
                        <li class="list-group-item"><a href="#">Travel</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>

    </div>

    <?php $conn->close(); ?>
    <?php include '../include/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
