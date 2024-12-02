<?php
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!doctype html>
<html lang="en">

<head>
    <title>nav bar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha384-xh6Fe+6IB0cZnOTmII2KN2II2RVaxVp5jyzsLl2zdGqQ5I+zpjsiW93htB7bHJBL" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>

</style>

<body>
<?php include '../html/loading.php' ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%; height: 80px; padding: 0 100px;">
        <a href="../html/index.php">
            <div class="image-logo" style="margin-right: 30px;">
                <img style="width: 70px; height: 70px;" src="../image/logoRemove.png" alt="logo">
            </div>
        </a>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link view-nav" href="../html/newproduct.php">SẢM PHẨM MỚI</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link view-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        NAM
                    </a>
                    <div class="dropdown-menu p-3" style="width: 600px;">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item"
                                            style="color: black; font-size: 18px; font-weight: 600;" href="#">Danh mục
                                            sản phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Áo phông/ Áo thun</a></li>
                                    <li><a class="dropdown-item" href="#">Áo nỉ & Áo Hoodie</a></li>
                                    <li><a class="dropdown-item" href="#">Áo khoác</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo/ Quần giữ nhiệt</a></li>
                                    <li><a class="dropdown-item" href="#">Áo len </a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo mặc nhà/ Đồ ngủ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="#"></a></li>
                                    <li><a class="dropdown-item" href="#">Quần dài & Quần Jean</a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo thể thao</a></li>
                                    <li><a class="dropdown-item" href="#">Áo polo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo sơ mi</a></li>
                                    <li><a class="dropdown-item" href="#">Áo chông nắng </a></li>
                                    <li><a class="dropdown-item" href="#">Đồ lót</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <a href="#"> <img style="width: 100%;" src="../image/đồ-nam-1.png"
                                            alt="anh-mau"></a>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <a href="#"> <img style="width: 100%; " src="../image/đồ-nam-2.png"
                                            alt="anh-mau"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link view-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        NỮ
                    </a>
                    <div class="dropdown-menu p-3" style="width: 600px;">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item"
                                            style="color: black; font-size: 18px; font-weight: 600;" href="#">Danh mục
                                            sản phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Áo phông/ Áo thun</a></li>
                                    <li><a class="dropdown-item" href="#">Áo nỉ & Áo Hoodie</a></li>
                                    <li><a class="dropdown-item" href="#">Áo khoác</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo/ Quần giữ nhiệt</a></li>
                                    <li><a class="dropdown-item" href="#">Áo len </a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo mặc nhà/ Đồ ngủ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="#">Váy</a></li>
                                    <li><a class="dropdown-item" href="#">Quần dài & Quần Jean</a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo thể thao</a></li>
                                    <li><a class="dropdown-item" href="#">Áo polo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo sơ mi</a></li>
                                    <li><a class="dropdown-item" href="#">Áo chông nắng </a></li>
                                    <li><a class="dropdown-item" href="#">Đồ lót</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <a href="#"> <img style="width: 100%;" src="../image/đồ-nữ-1.png" alt="anh-mau"></a>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <a href="#"> <img style="width: 100%; " src="../image/đồ-nữ-2.png"
                                            alt="anh-mau"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link view-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        BÉ GÁI
                    </a>
                    <div class="dropdown-menu p-3" style="width: 600px;">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item"
                                            style="color: black; font-size: 18px; font-weight: 600;" href="#">Danh mục
                                            sản phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Áo phông/ Áo thun</a></li>
                                    <li><a class="dropdown-item" href="#">Áo nỉ & Áo Hoodie</a></li>
                                    <li><a class="dropdown-item" href="#">Áo khoác</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo/ Quần giữ nhiệt</a></li>
                                    <li><a class="dropdown-item" href="#">Áo len </a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo mặc nhà/ Đồ ngủ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="#">Váy</a></li>
                                    <li><a class="dropdown-item" href="#">Quần dài & Quần Jean</a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo thể thao</a></li>
                                    <li><a class="dropdown-item" href="#">Áo polo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo sơ mi</a></li>
                                    <li><a class="dropdown-item" href="#">Áo chông nắng </a></li>
                                    <li><a class="dropdown-item" href="#">Đồ lót</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <a href="#"> <img style="width: 100%;" src="../image/bé-gai-1.png"
                                            alt="anh-mau"></a>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <a href="#"> <img style="width: 100%; " src="../image/bé-gái-2.png"
                                            alt="anh-mau"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link view-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        BÉ TRAI
                    </a>
                    <div class="dropdown-menu p-3" style="width: 600px;">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item"
                                            style="color: black; font-size: 18px; font-weight: 600;" href="#">Danh mục
                                            sản phẩm</a></li>
                                    <li><a class="dropdown-item" href="#">Áo phông/ Áo thun</a></li>
                                    <li><a class="dropdown-item" href="#">Áo nỉ & Áo Hoodie</a></li>
                                    <li><a class="dropdown-item" href="#">Áo khoác</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo/ Quần giữ nhiệt</a></li>
                                    <li><a class="dropdown-item" href="#">Áo len </a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo mặc nhà/ Đồ ngủ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <li><a class="dropdown-item" href="#"></a></li>
                                    <li><a class="dropdown-item" href="#">Quần dài & Quần Jean</a></li>
                                    <li><a class="dropdown-item" href="#">Quần áo thể thao</a></li>
                                    <li><a class="dropdown-item" href="#">Áo polo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Áo sơ mi</a></li>
                                    <li><a class="dropdown-item" href="#">Áo chông nắng </a></li>
                                    <li><a class="dropdown-item" href="#">Đồ lót</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled">
                                    <a href="#"> <img style="width: 100%;" src="../image/bé-trai-1.png"
                                            alt="anh-mau"></a>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <a href="#"> <img style="width: 100%;" src="../image/bé-trai-2.png"
                                            alt="anh-mau"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <form class="d-flex" style="margin-right: 30px;" action="../html/search.php" method="GET">
    <input class="form-control mr-2" type="search" name="query" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

        </div>

        <ul class="navbar-nav">
            <li class="nav-item" style="width: 100px; font-size: 15px;">
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> Cửa hàng</a>
            </li>

            <li class="nav-item dropdown" style="width: 100px; font-size: 15px;">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button">
                    <i class="bi bi-people"></i> Tài khoản
                </a>
                <ul class="dropdown-menu" id="dropdownMenu" aria-labelledby="accountDropdown" style="display: none;">
                    <li><a class="dropdown-item" id="accountLink"
                            href="../include/account.php?user_id=<?php echo $_SESSION['user_id']; ?>">Xem tài khoản</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../login/login.php" id="authLink">Đăng nhập</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" style="width: 100px;font-size: 15px;">
                <a class="nav-link" href="../html/cart_page.php"><i class="bi bi-cart4"></i> Giỏ hàng</a>
            </li>
        </ul>
    </nav>

    <script>

        //  drop down
        const dropdownToggle = document.getElementById('accountDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Thêm sự kiện click
        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        });

        // Đóng dropdown khi click ra ngoài
        document.addEventListener('click', function (e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });



        document.addEventListener('DOMContentLoaded', function () {
            const authLink = document.getElementById('authLink');
            const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
            if (isLoggedIn) {
                authLink.textContent = "Đăng xuất";
                authLink.href = "../login/logout.php";
            } else {
                authLink.textContent = "Đăng nhập";
                authLink.href = "../login/login.php";
                accountLink.textContent = "Đăng nhập để xem chức năng này";
            }
        });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>