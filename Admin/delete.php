<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}

require_once '../include/Database.php';
require_once '../Product/Product.php';

$db = new Database();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $result = $db->delete('product', "Product_Id = $productId");

    if ($result) {
        header("Location: productList.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
} else {
    header("Location: productList.php");
    exit();
}