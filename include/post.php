<?php
    include('../admin/config.php'); // Thêm dấu chấm phẩy ở cuối dòng này

// Lấy danh sách bài viết
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
           
        }

        .container {
            width: 55%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #343a40;
            font-size: 2rem;
        }

        .post-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .post {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 30%;  
            padding: 20px;
        }

        .post img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .post h2 {
            color: #333;
            font-size: 1.6rem;
        }

        .post h2 a {
            text-decoration: none;
            color: inherit;
            font-size: 15px;
            font-weight: bold;
            text-decoration: underline;
            color: blue;
        }

        .meta-info {
            font-size: 0.9rem;
            color: #888;
        }
 

        .meta-info .category {
            background-color: #007bff;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            margin-top: 10px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .post-wrapper {
                flex-direction: column;
            }

            .post {
                width: 100%;  
            }
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container">
        <!-- Title -->
        <h1>Danh Sách Bài Viết</h1>

        <div class="post-wrapper">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <!-- Hình ảnh bài viết -->
                    <div class="meta-info">
                        <span class="date"><?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                    </div>
                    <a href="post_detail.php?id=<?= $row['id'] ?>">
                        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Blog Image">
                    </a>
                    <h2>
                        <a href="post_detail.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                    </h2>
                   
                    <p><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                    <a href="post_detail.php?id=<?= $row['id'] ?>" class="btn-primary">Read More</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>
