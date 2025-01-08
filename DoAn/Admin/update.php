<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}

require_once '../include/Database.php';
require_once '../Product/Product.php';

$db = new Database();

if (isset($_POST['Product_Name']) && isset($_POST['Description']) && isset($_POST['Price']) && isset($_POST['Brand_Id']) && isset($_POST['Category_Id'])) {
    $productId = $_POST['id'];
    $productName = trim($_POST['Product_Name']);
    $description = trim($_POST['Description']);
    $price = trim($_POST['Price']);
    $brandId = trim($_POST['Brand_Id']);
    $categoryId = trim($_POST['Category_Id']);

    $updateData = [
        'Product_Name' => $productName,
        'Description' => $description,
        'Price' => $price,
        'Brand_Id' => $brandId,
        'Category_Id' => $categoryId
    ];

    $result = $db->update('product', $updateData, "Product_Id = $productId");

    if ($result) {
        header("Location: detailAdmin.php?id=$productId");
        exit();
    } else {
        echo "Error updating product.";
    }
} else {
    header("Location: detailAdmin.php?id=".$_GET['id']);
    exit();
}