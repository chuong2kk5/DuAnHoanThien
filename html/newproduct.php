<?php 
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha384-xh6Fe+6IB0cZnOTmII2KN2II2RVaxVp5jyzsLl2zdGqQ5I+zpjsiW93htB7bHJBL" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
    <?php include '../include/header.php' ?>
    <?php include '../include/navbar.php' ?>
    <?php include '../include/products.php' ?>
    <?php include '../include/footer.php' ?>

    <script src="">
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