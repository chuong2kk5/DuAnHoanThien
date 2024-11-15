<?php
session_start();
session_destroy();  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng xuất thành công</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Đăng xuất',
            text: 'Đăng xuất thành công',
            icon: 'success'
        }).then(function() {
            window.location.href = "../html/index.php";  
        });
    </script>
</body>
</html>
