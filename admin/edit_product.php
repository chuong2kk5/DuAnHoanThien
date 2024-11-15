<?php
// edit_product.php

session_start();
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $product_id = intval($_POST['product_id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $category_id = intval($_POST['category_id']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; 
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Không thể tải lên hình ảnh.',
                            icon: 'error'
                        }).then(function() {
                            window.history.back();
                        });
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'File tải lên không phải là hình ảnh.',
                        icon: 'error'
                    }).then(function() {
                        window.history.back();
                    });
                  </script>";
            exit();
        }
    } else {
        $stmt = $conn->prepare("SELECT image_path FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();
    }

    // Chuẩn bị truy vấn để cập nhật sản phẩm
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, category_id = ?, image_path = ? WHERE product_id = ?");
    $stmt->bind_param("ssdiisi", $name, $description, $price, $quantity, $category_id, $image_path, $product_id);
    
    
    if ($stmt->execute()) {
        // Cập nhật thành công
        header("Location: manage_products.php?message=Cập nhật sản phẩm thành công.");
        exit();
    } else {
        // Cập nhật thất bại
        echo "<script>
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Không thể cập nhật sản phẩm.',
                    icon: 'error'
                }).then(function() {
                    window.history.back();
                });
              </script>";
            $stmt->close();

        exit();
    }

}
