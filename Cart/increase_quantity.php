<?php
session_start();

require_once "../include/Database.php";
require_once '../Product/Product.php';
require_once "Cart.php";

if (!isset($_GET['id'])) {
    header('Location: userCart.php');
    exit();
}

$db = new Database();
$cart = new Cart($_SESSION['user_id'], $db);

$cart->increaseQuantity($db, $_GET['id']);

header('Location: userCart.php');