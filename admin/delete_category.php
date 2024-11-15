<?php 
    include 'config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_id = $_POST['category_id'];
         
        // check product id
        if(isset($category_id) && !empty($category_id)) {
            // delete category
            $sql ="DELETE FROM categories WHERE category_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $category_id);
        }
        // check 
        if($stmt->execute()) {
            $message = "Delete category successfully";
        }else {
            $message = "Delete category failed";
        }
        $stmt->close();
    }else {
        $message = "invalid request";
    }
    // chuyen huong
    header("Location: manage_categories.php?message=" . ($message));
    $conn->close();