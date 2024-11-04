<!doctype html>
<html lang="en">

<head>
    <title>USER</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        crossorigin="anonymous">
    <style>
        ul li{
            width: 100%;
            text-align: left;
        }
        ul li a{
           color: black;
           /* font-size: 16px; */
        }
   

        .data-v-ed45279a {
            margin-right: 5px;
        }

        /* Styling for horizontal navigation */
        /* Styling for avatar and phone number */
        .heading img {
            margin-top: 20px;
            height: 58px;
            cursor: pointer;
        }

        .phone {
            font-weight: bold;
            margin-top: 10px;
        }

        button.btn-primary {
            margin: 5px 10px;
            font-size: 16px;
        }

        .price {
            font-size: 16px;
        }

        a.card-link-product {
            font-size: 14px;
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        a.card-link-product:hover {
            color: red;
        }

        tbody .text-title {
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        tbody .text-dsc {
            width: 250px;
            font-size: 12px;
        }

        tbody .price {
            font-size: 14px;
        }

        tbody button.btn-primary {
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>

<body>
   <?php include '../include/navbar.php' ?>
   <br>
   <br>
   <br>
        
    <div class="container" style="display: flex;">
        <article class="text-center"
            style="background-color: rgb(255, 254, 254); border: 1px solid rgb(220, 217, 217);  padding: 0; margin-right: 50px; border-radius: 5px">
            <!-- User Profile -->
            <div class="heading text-center">
                <img src="http://pluspng.com/img-png/user-png-icon-big-image-png-2240.png" alt="avatar">
                <p id="phone" class="phone">03368451037</p>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="navId">
                <li class="nav-item">
                    <a href="#tab0Id" class="nav-link active" data-toggle="tab">Thông tin</a>
                </li>
                <li class="nav-item">
                    <a href="#tab1Id" class="nav-link" data-toggle="tab">Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="#tab2Id" class="nav-link" data-toggle="tab">Đã xem gần đây</a>
                </li>
                <li class="nav-item">
                    <a href="#tab3Id" class="nav-link" data-toggle="tab">Yêu thích</a>
                </li>
                <li class="nav-item">
                    <a href="#tab4Id" class="nav-link" data-toggle="tab">Đăng xuất</a>
                </li>
            </ul>
        </article>

        <aside class="col-sm-9"
            style="background-color: rgb(255, 254, 254); border: 1px solid rgb(220, 217, 217);  padding: 0; margin-right: 50px; border-radius: 5px">
            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Tab 0: Thông tin -->
                <div class="tab-pane fade show active" id="tab0Id" role="tabpanel">
                    <div class="smg-text "
                        style="border: 1px solid  rgb(220, 217, 217); border-radius: 5px;  box-shadow: 0px 2px 2px 0px  rgb(220, 217, 217); padding: 30px;">
                        <h2 class="card-title">Thông tin tài khoản</h2>
                        <div class="control-information">
                            <p>Giới tính</p>
                            <div class="control" style="display: flex; flex-wrap: 1;">
                                <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1"
                                    checked="checked">
                                <span class="data-v-ed45279a">Nam</span>
                                <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1"
                                    checked="checked">
                                <span class="data-v-ed45279a">Nữ</span>
                                <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1"
                                    checked="checked">
                                <span class="data-v-ed45279a">Khác</span>
                            </div>
                            <div class="form-group active"><label>Họ tên</label> <input type="text" name="firstName"
                                    class="form-control "></div>
                            <div class="form-group active"><label>Số điện thoại</label> <input disabled="disabled"
                                    type="text" name="phone" class="form-control "></div>
                            <div class="form-group active"><label>Email</label> <input type="text" name="email"
                                    class="form-control "></div>
                            <input type="date" data-date-format="DD MMMM YYYY" name="" min="01-01-1971" id="birthday"
                                class="form-control">
                            <br>
                            <div class="form-button text-center">
                                <button type="submit" class="btn btn-primary ">Lưu thay đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show " id="tab1Id" role="tabpanel">
                    <!-- Account Information Section -->
                    <div class="card ">
                        <div class="card-header">
                            Đơn Hàng
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th style="width: 150px;">Tổng đơn hàng</th>
                                        <th style="width: 150px;">đánh giá nhanh</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc">Hoàn háo cho phái nam và phát nữ form áo gọn gàng thanh
                                                lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h5 class="price"> 526.000 vnđ </h5>
                                        </td>
                                        <td>#####</td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Viết đánh giá</button>
                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc">Hoàn háo cho phái nam và phát nữ form áo gọn gàng thanh
                                                lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h5 class="price"> 526.000 vnđ </h5>
                                        </td>
                                        <td>#####</td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Viết đánh giá</button>
                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            Đơn hàng đã mua của bạn!
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show " id="tab2Id" role="tabpanel">
                    <!-- Account Information Section -->
                    <div class="card">
                        <div class="card-header">
                            Sản phẩm đã xem
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <a href="#"><img class="card-img-top" src="/D_A1/image/be-gai1.webp" alt=""></a>
                                        <div class="card-body">
                                            <a class="card-link-product" href="#">
                                                <p class="card-title">Đồ thể thao dài cho bé</p>
                                            </a>
                                            <p class="card-price">589.000 vnđ</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            Sảm phẩm đã xem của bạn
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show " id="tab3Id" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            Sản phẩm yêu thích
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá đơn hàng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc" style="width: 250px; font-size: 12px">Hoàn háo cho phái
                                                nam và phát nữ form áo gọn gàng thanh lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h6> 526.000 vnđ </h6>
                                        </td>
                                        <td>

                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/D_A1/image/be-gai1.webp" alt="ảnh-sản-phẩm"
                                                style="height: 80px;">
                                            <h4 class="text-title">Áo đẹp polo Nam Nữ</h4>
                                            <p class="text-dsc" style="width: 300px;">Hoàn háo cho phái nam và phát nữ
                                                form áo gọn gàng thanh lịch phù hợp
                                                với mọi gu thời trang</p>
                                        </td>
                                        <td>
                                            <h6> 526.000 vnđ </h6>
                                        </td>
                                        <td style="display: flex">

                                            <button type="submit" class="btn btn-primary">Quay lại mua hàng</button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            Sản phẩm bãn đã yêu thích
                        </div>
                    </div>

                </div>
                <!-- Other Tabs (like tab1Id, tab2Id) -->
                <!-- Add content for each tab if needed -->
            </div>
        </aside>
    </div>
    <?php include '../include/footer.php'; ?>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>