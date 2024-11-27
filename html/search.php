<?php
include '../admin/config.php'; 

$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($searchQuery) {
    $sql = "
    SELECT image_path, name, description 
    FROM products 
    WHERE name LIKE ? OR description LIKE ?
    UNION
    SELECT NULL AS image_path, name, NULL AS description 
    FROM categories 
    WHERE name LIKE ?;
";

    $stmt = $conn->prepare($sql);

    $searchTerm = "%$searchQuery%";
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Tìm Kiếm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <?php include_once '../include/navbar.php'; ?>

    <div class="container mt-5">
    <?php if ($searchQuery): ?>
        <h1 class="text-center mb-4">Kết quả tìm kiếm cho: "<span class="text-primary"><?php echo htmlspecialchars($searchQuery); ?></span>"</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <img class="card-img-top" src="<?php echo $row['image_path']; ?>" alt="img-products">
                                <h5 class="card-title text-success"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['description'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                Không tìm thấy kết quả phù hợp.
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Hãy nhập từ khóa tìm kiếm.
        </div>
    <?php endif; ?>
</div>


    <?php include_once '../include/footer.php'; ?>

    <?php
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
