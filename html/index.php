<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../admin/config.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  
<?php include '../include/head.php' ?>
 

<body>
    
    <main>
        <?php include '../include/header.php' ?>
        <?php include '../include/navbar.php' ?>
        <?php include '../include/slide.php' ?>
        <?php include '../include/user_coupons.php' ?>
        <?php include '../include/category.php' ?>
        <?php include '../include/products.php' ?>
        <?php include '../include/footer.php' ?>
    </main>


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