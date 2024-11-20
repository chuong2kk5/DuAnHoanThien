<?php
session_start();
include('../admin/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Địa Chỉ</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "
        <script>
            Swal.fire({
                title: 'Lỗi',
                text: 'Vui lòng đăng nhập trước khi thêm địa chỉ!',
                icon: 'error'
            });
        </script>";
        die();
    }

    $user_id = $_SESSION['user_id'];
    $city = $_POST['city'];
    $address_line = $_POST['address_line'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // Kiểm tra rỗng
    $fields = ['city' => $city, 'address_line' => $address_line, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country];
    foreach ($fields as $key => $value) {
        if (empty($value)) {
            echo "
            <script>
                Swal.fire({
                    title: 'Lỗi',
                    text: 'Trường " . $key . " không được để trống!',
                    icon: 'error'
                });
            </script>";
            die();
        }
    }

    // Kiểm tra địa chỉ trùng lặp
    $check_sql = "SELECT * FROM addresses WHERE user_id = ? AND city = ? AND address_line = ? AND state = ? AND postal_code = ? AND country = ?";

    if ($check_stmt = $conn->prepare($check_sql)) {
        $check_stmt->bind_param("isssss", $user_id, $city, $address_line, $state, $postal_code, $country);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            echo "
            <script>
    Swal.fire({
        title: 'Lỗi',
        text: 'Địa chỉ này đã tồn tại trong hệ thống!',
        icon: 'error'
    }).then((result) => {
        if (result.isConfirmed || result.isDismissed) {
            window.location.href = 'account.php';
        }
    });
</script>";

            die();
        }
    } else {
        $error = $conn->error;
        echo "
        <script>
            Swal.fire({
                title: 'Lỗi',
                text: 'Lỗi kiểm tra địa chỉ: " . json_encode($error) . "',
                icon: 'error'
            });
        </script>";
        die();
    }

    // Câu lệnh SQL
    $sql = "INSERT INTO addresses (user_id, city, address_line, state, postal_code, country) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Chuẩn bị và thực thi
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isssss", $user_id, $city, $address_line, $state, $postal_code, $country);

        if ($stmt->execute()) {
            echo "
            <script>
                Swal.fire({
                     position: 'top-end',
                     icon: 'success',
                     title: 'Thêm Địa Chỉ Thành Công',
                     showConfirmButton: false,
                     timer: 1000
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = 'account.php';
                    }
                });
            </script>";
        } else {
            $error = $conn->error;
            echo "
            <script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'Đã xảy ra lỗi vui lòng thử lại. Lỗi: " . json_encode($error) . "',
                    icon: 'error'
                });
            </script>";
        }

    } else {
        $error = $conn->error;
        echo "
        <script>
            Swal.fire({
                title: 'Lỗi',
                text: 'Lỗi chuẩn bị câu lệnh: " . json_encode($error) . "',
                icon: 'error'
            });
        </script>";
    }
}
?>