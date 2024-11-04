<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/D_A1/css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include '../include/navbar.php' ?>
  <br>
  <br>
  <br>
  <div class="container" style="display: flex;">
    <article class="col-sm-5"
      style="background-color: rgb(255, 254, 254); border: 1px solid rgb(220, 217, 217);  padding: 0; margin-right: 50px; border-radius: 5px">
      <div class="heading text-center">
        <img src="http://pluspng.com/img-png/user-png-icon-big-image-png-2240.png"
          style=" margin-top: 20px;height: 58px;" alt="avatar">
        <p class="phone">03368451037</p>
      </div>
      <div class="user-action">
        <ul>
          <li><a href="#">Đơn hàng</a></li>
          <li><a href="#">Thẻ thành viên</a></li>
          <li><a href="#">Số địa chỉ</a></li>
          <li><a href="#">Yêu thích</a></li>
          <li><a href="#">đã xem gần đây</a></li>
          <li><a href="#">đăng xuất</a></li>
        </ul>
      </div>
    </article> 
    <aside class="col-sm-7">
      <div class="smg-text " style="border: 1px solid  rgb(220, 217, 217); border-radius: 5px;  box-shadow: 0px 2px 2px 0px  rgb(220, 217, 217); padding: 30px;">
        <h2 class="card-title">Thông tin tài khoản</h2>
          <div class="control-information">
            <p>Giới tính</p>
            <div class="control" style="display: flex; flex-wrap: 1;">
              <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1" checked="checked">
              <span class="data-v-ed45279a">Nam</span>
              <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1" checked="checked">
              <span class="data-v-ed45279a">Nữ</span>
              <input class="data-v-ed45279a" type="radio" name="radio" id="radio1" value="1" checked="checked">
              <span class="data-v-ed45279a">Khác</span>
            </div>
            <div  class="form-group active"><label >Họ tên</label> <input  type="text" name="firstName" class="form-control "></div>
            <div  class="form-group active"><label >Số điện thoại</label> <input  disabled="disabled" type="text" name="phone" class="form-control "></div>
            <div  class="form-group active"><label >Email</label> <input  type="text" name="email" class="form-control "></div>
            <input  type="date" data-date-format="DD MMMM YYYY" name="" min="01-01-1971" id="birthday" class="form-control">
            <br>
            <div  class="form-button text-center"><button  disabled="disabled" class="btn btn-primary ">Lưu thay đổi</button> <!----> <!----></div>
          </div>
      </div>
      <!-- Giỏ hàng -->
      <div class="smg-text action" style="border: 1px solid  rgb(220, 217, 217); border-radius: 5px;  box-shadow: 0px 2px 2px 0px  rgb(220, 217, 217); padding: 30px;">
        <h2 class="card-title">Đơn hàng</h2>
          <div class="control-information">
            <h5 class="card-title">online</h5>
            <hr>
            <div class="control">
              <img class="card-img-top" src="https://canifa.com/assets/images/history-order-empty.png" alt="cart" style="max-width: 200px;">
            </div>
             
          </div>
      </div>
      
    </aside>
  </div>
  <?php include '../include/footer.php' ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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