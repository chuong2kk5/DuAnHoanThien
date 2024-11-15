<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        max-height: 100px;
        overflow: hidden;
    }
    p.card-text{
        max-height: 100px;  
    }
</style>


<body>
    <?php 
        var_dump($_SESSION);
    ?>

    <div class="container my-5">
        <h2 class="text-center mb-4">Danh Mục Sản Phẩm</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            <div class="col">
                <div class="card h-100">
                    <img src="../image/đồ-nam-2.png" class="card-img-top" alt="Đồ Nam">
                    <div class="card-body">
                        <h5 class="card-title">Đồ Nam</h5>
                        <p class="card-text">Các sản phẩm dành cho nam</p>
                    </div> 
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-122">
                    <img src="../image/đồ-nữ-1.png" class="card-img-top" alt="Đồ Nữ">
                    <div class="card-body">
                        <h5 class="card-title">Đồ Nữ</h5>
                        <p class="card-text">Các sản phẩm dành cho nữ</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="../image/bé-trai-1.png" class="card-img-top" alt="Bé Trai">
                    <div class="card-body">
                        <h5 class="card-title">Bé Trai</h5>
                        <p class="card-text">Sản phẩm cho bé trai</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="../image/bé-gái-2.png" class="card-img-top" alt="Bé Gái">
                    <div class="card-body">
                        <h5 class="card-title">Bé Gái</h5>
                        <p class="card-text">Sản phẩm cho bé gái</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>