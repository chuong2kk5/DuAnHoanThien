<?php 
include 'config.php';
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // kiem tra xem co yeu cau post khong
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];

    // kiem tra anh uplaoad 
    if($_FILES['image']['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename(path: $_FILES["image"]['name']);
        if($_FILES['image']['size'] > 2000000) {
            die("Kich thuoc anh qua lon, vui long chon anh co kich thuoc be hon~!");
        }
    }
    // di chuyen file den thu muc da chi dinh
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;

        //  add danh muc vao DB
        $stmt = $conn->prepare("INSERT INTO categories (name, category_id, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $category_id, $image_path); 
        $stmt->execute();
        $stmt->close();

        header("Location: manage_categories.php");
        exit();
    }else {
        echo "Co loi xay ra khi upload anh, vui long thu lai~!";
    }
}else {
     echo " vui long chon anh~!";
}