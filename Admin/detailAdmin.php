<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'customer') {
    header("Location: ../Error/401.php");
    exit();
}
require_once '../include/Database.php';
require_once '../Product/Product.php';
require_once 'layout/headerAdmin.php';

$db = new Database();
$product = new Product();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetail = $db->getRows("SELECT * FROM product WHERE Product_Id = :id", ['id' => $id], true);

    $brands = $db->getAllData('brand');
    $categories = $db->getAllData('category');

    $brand = $db->getRows("SELECT * FROM brand WHERE Brand_Id = :brand_id", ['brand_id' => $productDetail['Brand_Id']], true);
    $category = $db->getRows("SELECT * FROM category WHERE Category_Id = :category_id", ['category_id' => $productDetail['Category_Id']], true);
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Product Detail</h1>

    <div class="row">
        <div class="col-6">
            <img src="../include/image/<?= $productDetail['Image'] ?>" alt="Hình ảnh" class="img-fluid">
        </div>
        <div class="col-6">
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?= $productDetail['Product_Id'] ?>">
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="Product_Name" value="<?= $productDetail['Product_Name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="Description"><?= $productDetail['Description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="Price" value="<?=$productDetail['Price']?> " >
                </div>
                <div class="mb-3">
                    <label for="brandId" class="form-label">Brand</label>
                    <select class="form-control" id="brandId" name="Brand_Id">
                        <?php foreach ($brands as $brandOption) { ?>
                            <option value="<?= $brandOption['Brand_Id'] ?>" <?= ($brandOption['Brand_Id'] == $productDetail['Brand_Id']) ? 'selected' : '' ?>><?= $brandOption['Brand_Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="categoryId" class="form-label">Category</label>
                    <select class="form-control" id="categoryId" name="Category_Id">
                        <?php foreach ($categories as $categoryOption) { ?>
                            <option value="<?= $categoryOption['Category_Id'] ?>" <?= ($categoryOption['Category_Id'] == $productDetail['Category_Id']) ? 'selected' : '' ?>><?= $categoryOption['Category_Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="delete.php?id=<?= $productDetail['Product_Id'] ?>" class="btn btn-danger">Delete</a>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'layout/footerAdmin.php';
?>