<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nội thất Hoàng Duy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 40px;
        }
        .header .logo {
            flex-grow: 1;
        }
        .header .logo a img{
            height: 100px;
            width: 100px;
        }
        .header .header-img {
            flex-grow: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header .header-img img{
            height: 110px;
            width: 800px;
        }
        .header .auth-buttons {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
        }
        .header .auth-buttons .btn-primary:hover{
            background-color: white;
            color: blue;
            border: 1px solid blue;
        }
        .header .auth-buttons .btn-success:hover{
            background-color: white;
            color: rgb(16, 175, 19);
            border: 1px solid rgb(16, 175, 19);
        }
        .header .auth-buttons .btn-danger:hover{
            background-color: white;
            color: red;
            border: 1px solid red;
        }
        .header .auth-buttons .btn-info:hover{
            background-color: white;
            color: #0dcaf0;
            border: 1px solid #0dcaf0;
        }
        .navbar {
            padding-left: 40px;
            height: 60px;
            background: linear-gradient(to right, #ff9966, #ff5e62, #ff4b2b, #ff416c);
        }
        .nav-item {
            margin-right: 8px;
        }
        .nav-link {
            font-size: 20px;
            transition: all .3s;
            line-height: 45px;
        }
        .nav-link:hover {
            transform: scale(1.1);
            background-color: #ff4b2b;
            color: white !important;
        }
        .footer {
            color: white;
            display: flex;
            justify-content: space-between;
            background: linear-gradient(to right, #ff9966, #ff5e62, #ff4b2b, #ff416c);
        }
        .footer a {
            color: white;
            font-size: 25px;
        }
        .footer a:hover {
            color: #1E90FF;
        }
        .footer-info {
            flex: 1;
        }
        .footer-map {
            flex: 1;
            height: 150px;
        }
        .content-container{
            /* padding: 20px; */
        }
        .login-container {
            width: 800px;
            margin: 0 auto;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .login-container .form-group {
            position: relative;
        }
        .login-container .form-group i {
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .login-container .form-group input {
            padding-inline-start: 40px;
        }
        .login-container .form-group span {
            position: absolute;
            left: 30px;
            color: rgb(197, 194, 194);
            font-size: 21px;
        }
        .login-container .btn-primary {
            background: linear-gradient(to left, #0ad0cd, #ea4ae2);
            position: relative;
            border: none;
        }
        .auth-card {
            box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-inline-start: 100px;
            padding-inline-end: 100px;
            border-radius: 50px;
            background: linear-gradient(lightgreen, rgb(3, 164, 84));
        }
        .auth-card a{
            color: #FFF01F;
        }
        .auth-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .register-container {
            width: 800px;
            margin: 0 auto;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .register-container .form-group {
            position: relative;
        }
        .register-container .form-group i {
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .register-container .form-group input {
            padding-inline-start: 40px;
        }
        .register-container .form-group span {
            position: absolute;
            left: 30px;
            color: rgb(197, 194, 194);
            font-size: 21px;
        }
        .register-container .btn-primary {
            background: linear-gradient(to left, #0ad0cd, #ea4ae2);
            border: none;
        }
        .forgot-container {
            width: 800px;
            margin: 0 auto;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .forgot-container .form-group {
            position: relative;
        }
        .forgot-container .form-group i {
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .forgot-container .form-group input {
            padding-inline-start: 40px;
        }
        .forgot-container .form-group span {
            position: absolute;
            left: 30px;
            color: rgb(197, 194, 194);
            font-size: 21px;
        }
        .forgot-container .btn-primary {
            background: linear-gradient(to left, #0ad0cd, #ea4ae2);
            border: none;
        }
        .product-container{
            padding: 10px;
        }
        .product-card {
            border-radius: 15px;
            transition: all .2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            width: 200px;
        }

        .product-card:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .product-card img{
            height: 150px;
            object-fit: cover
        }
        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
        }

        .contact-container table, th , tr, td{
            border: 0.5px solid black;
            padding: 15px;
        }
        .filter-container ul{
            list-style-type: none;
            padding-left: 10px;
        }
        .filter-container li{
            padding-bottom: 15px;
            font-size: 15px;
            color: black;
        }
        .filter-container a{
            color: black;
        }
        #quantity {
        width: 30px;
        }
        #cart-quantity {
            text-decoration:none;
            display:inline-block;
            font-size: 20px;
            border:1px solid black;
            color: black;
            width: 30px;
            background-color: lightgray;
        }
        #cart-quantity:hover{
            background-color: #ffc107;
            border:1px solid #ffc107;
        }
        .custom-table {
            border:2px solid white !important;
        }

        .custom-table thead tr {
            border-bottom: 2px solid darkgray;
        }

        .custom-table th, .custom-table td {
            border: none !important;
            text-align: center;
        }
        .pagination a {
            text-decoration: none;
            font-size: 16px;
            color: black;
        }

        .pagination a.active {
            font-weight: bold;
            text-decoration: underline;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL . '/include/image/logo.jpg'; ?>" alt="Logo Here"></a>
        </div>
        <div class="header-img">
            <img src="<?php echo BASE_URL . '/include/image/furniture.gif'; ?>" alt="Fashion Gif">
        </div>
        <div class="auth-buttons">
            <?php
            if(!isset($_SESSION['logged_in'])){
            ?>
            <a href="<?php echo BASE_URL . '/Auth/login.php'; ?>"><button class="btn btn-primary">Đăng nhập</button></a>
            <a href="<?php echo BASE_URL . '/Auth/register.php'; ?>"><button class="btn btn-success ms-2">Đăng kí</button></a>
            <?php 
            }else{
            ?>
            <a href="<?php echo BASE_URL . '/Auth/logout.php'; ?>"><button class="btn btn-danger">Đăng xuất</button></a>
            <a href="<?php echo BASE_URL . '/Cart/userCart.php'; ?>"><button class="btn btn-info ms-2">Giỏ hàng</button></a>
            <?php 
            }
            ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL?>"><i class="fas fa-home"></i> Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL.'/Product/products.php'?>"><i class="fas fa-box-open"></i> Tất Cả Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL.'/aboutUs.php'?>"><i class="fas fa-info-circle"></i> Thông Tin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL.'/contact.php'?>"><i class="fas fa-phone"></i> Liên Hệ</a>
                </li>
                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 'admin') {?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL.'/Admin/dashboard.php'?>"><i class="fas fa-user-shield"></i> Admin</a>
                </li>    
                <?php }?>
            </ul>
        </div>
    </nav>
    <div class="content-container">
        