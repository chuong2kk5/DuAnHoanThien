<?php
include('../admin/config.php');

$post_id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM posts WHERE id = $post_id");

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Bài viết không tồn tại!";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Main Content -->
 <?php include ('../include/navbar.php'); ?>
<div class="container my-5">
    <h1 class="text-center"><?= htmlspecialchars($post['title']) ?></h1>
    <p class="text-muted">Posted on <strong><?= $post['created_at'] ?></strong></p>
    
    <?php if (!empty($post['image_path'])): ?>
        <img src="<?= htmlspecialchars($post['image_path']) ?>" class="img-fluid rounded mb-3" alt="Blog Image">
    <?php endif; ?>
    
    <div class="mt-4">
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    </div>
    
    <a href="post.php" class="btn btn-secondary">Back to Blog</a>
</div>

<?php $conn->close(); ?>
<?php include ('../include/footer.php'); ?>

</body>
</html>
