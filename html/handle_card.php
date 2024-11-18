<?php
session_start();
include "cart.php";

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    $cart->updateQuantity($id, $quantity);

    header("Location: cart_page.php");
    exit;
} 
