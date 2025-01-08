<?php
session_start();
require_once '../config.php';
require_once "../include/Database.php";
require_once "Product.php";
require_once "../include/layout/header.php";

$db = new Database();
$product = new Product();

$allProducts = $product->getAllProducts($db);

$sortType = $_GET['sort'] ?? '';
$brandId = $_GET['brand'] ?? ''; 
$categoryId = $_GET['category'] ?? '';
$searchTerm = $_GET['search'] ?? '';

$productPerPage = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productPerPage;

$filteredProducts = $allProducts;
if ($brandId != '') {
    $filteredProducts = array_filter($filteredProducts, function($product) use ($brandId) {
        return $product['Brand_Id'] == $brandId;
    });
}
if ($categoryId != '') {
    $filteredProducts = array_filter($filteredProducts, function($product) use ($categoryId) {
        return $product['Category_Id'] == $categoryId;
    });
}
if ($searchTerm != '') {
    $filteredProducts = array_filter($filteredProducts, function($product) use ($searchTerm) {
        return stripos($product['Product_Name'], $searchTerm) !== false;
    });
}

$sortedProducts = $product->getProductsSorted($filteredProducts, $sortType);

$totalProducts = count($sortedProducts);
$totalPages = ceil($totalProducts / $productPerPage);

$products = array_slice($sortedProducts, $offset, $productPerPage);

$brands = $db->getAllData('brand');
$categories = $db->getAllData('category');

$urlParams = $_GET;
unset($urlParams['page']);
$urlParams = http_build_query($urlParams);

?>

<div class="row p-4">
    <div class="filter-container col-3">
        <div class="form-group">
            <input type="text" class="form-control mb-2" id="searchBox" name="searchBox" placeholder="Search" onkeydown="if (event.key == 'Enter') searchProduct()">
        </div>
        <div class="form-group">
            <h3>Nhãn hiệu:</h3>
            <br>
            <ul>
                <?php
                foreach ($brands as $brand) {
                    $countBrand = count(array_filter($allProducts, function($product) use ($brand) {
                        return $product['Brand_Id'] == $brand['Brand_Id'];
                    }));
                    ?>
                    <li><a href="?brand=<?php echo urlencode($brand['Brand_Id']); ?>"><?php echo $brand['Brand_Name'] . " (" . $countBrand . ")" ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="form-group">
            <h3>Danh mục:</h3>
            <br>
            <ul>
                <?php
                foreach ($categories as $category) {
                    $countCategory = count(array_filter($allProducts, function($product) use ($category) {
                        return $product['Category_Id'] == $category['Category_Id'];
                    }));
                    ?>
                    <li><a href="?category=<?php echo urlencode($category['Category_Id']); ?>"><?php echo $category['Category_Name'] . " (" . $countCategory . ")" ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="product-container col-9" id="product-container">
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <div class="sort d-flex justify-content-end mb-3">
                    <select id="sortSelect" class="form-control" title="sort" onchange="sortProducts()">
                        <option value="">Sắp xếp</option>
                        <option value="name-asc">Sắp xếp theo tên A-Z</option>
                        <option value="name-desc">Sắp xếp theo tên Z-A</option>
                        <option value="price-desc">Sắp xếp giá giảm dần</option>
                        <option value="price-asc">Sắp xếp giá tăng dần</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <a href="detail.php?id=<?=$product['Product_Id']?>"><img class="card-img-top" src="../include/image/<?= $product['Image'] ?>" alt="Hình ảnh"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <p><?= $product['Product_Name'] ?></p>
                            </h4>
                            <small>Giá: <?= number_format($product['Price'], 0, ',', '.') ?> VNĐ</small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <button class="btn btn-primary me-2" onclick="window.location.href='?<?php echo $urlParams; ?>&page=<?php echo $page - 1; ?>'"><i class="fas fa-arrow-left"></i></button>
            <?php endif; ?>

            <?php 
            if ($totalPages <= 3) {
                $start = 1;
                $end = $totalPages;
            } else {
                $start = $page - 1 <= 1 ? 1 : ($page + 1 >= $totalPages ? $totalPages - 2 : $page - 1);
                $end = $start + 2;
            }
            if ($start > 1) echo "...";
            for ($i = $start; $i <= $end; $i++): ?>
                <a href="?<?php echo $urlParams; ?>&page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?> ms-1 me-2 mt-1"><?php echo $i; ?></a>
            <?php endfor; 
            if ($end < $totalPages) echo "...";
            ?>

            <?php if ($page < $totalPages): ?>
                <button class="btn btn-primary ms-2" onclick="window.location.href='?<?php echo $urlParams; ?>&page=<?php echo $page + 1; ?>'"><i class="fas fa-arrow-right"></i></button>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function searchProduct() {
        let input = document.getElementById('searchBox').value;
        window.location.href = "?search=" + encodeURIComponent(input);
    }

    function sortProducts() {
        let sortValue = document.getElementById('sortSelect').value;
        window.location.href = "?sort=" + sortValue;
    }
</script>

<?php 
require_once "../include/layout/footer.php";
?>