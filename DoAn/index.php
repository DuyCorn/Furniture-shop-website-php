<?php
session_start();

require_once 'config.php';
require_once "include/Database.php";
require_once "Product/Product.php";
require_once "include/layout/header.php";

$db = new Database();
$product = new Product();

$allProducts = $product->getAllProducts($db);

$productsSortedByPriceDesc = $product->getProductsSorted($allProducts, 'price-desc');

$newestProducts = array_slice($productsSortedByPriceDesc, 0, 5);

$productsSortedByPriceAsc = $product->getProductsSorted($allProducts, 'price-asc');

$bestSellingProducts = array_slice($productsSortedByPriceAsc, 0, 5);
?>

<div class="ps-2" style="background-color: green;height: 3.5rem;color:white"><h1><b>Những mặt hàng mới nhất</b></h1></div>
<div class="mt-4">
    <div class="d-flex justify-content-around flex-wrap">
        <?php foreach ($newestProducts as $product): ?>
            <div class="card product-card mb-4">
                <a href="Product/detail.php?id=<?=$product['Product_Id']?>"><img class="card-img-top" src="include/image/<?= $product['Image'] ?>" alt="Hình ảnh"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <p><?= $product['Product_Name'] ?></p>
                    </h4>
                    <small>Giá: <?= number_format($product['Price'], 0, ',', '.') ?> VNĐ</small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="ps-3" style="background-color: darkblue;height: 3.5rem;color:white""><h1><b>Những mặt hàng bán chạy nhất</b></h1></div>
<div class="mt-4">
    <div class="d-flex justify-content-around flex-wrap">
        <?php foreach ($bestSellingProducts as $product): ?>
            <div class="card product-card mb-4">
                <a href="Product/detail.php?id=<?=$product['Product_Id']?>"><img class="card-img-top" src="include/image/<?= $product['Image'] ?>" alt="Hình ảnh"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <p><?= $product['Product_Name'] ?></p>
                    </h4>
                    <small>Giá: <?= number_format($product['Price'], 0, ',', '.') ?> VNĐ</small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "include/layout/footer.php"; ?>
