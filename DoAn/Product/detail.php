<?php 
session_start();
require_once '../config.php';
require_once "../include/Database.php";
require_once "Product.php";
require_once '../Cart/Cart.php';

$db = new Database();
$product = new Product();
if(isset($_SESSION['user_id'])){
    $cart = new Cart($_SESSION['user_id'], $db);
    $cart->id = $cart->getCartId($db);
}
$id = $_GET['id'];
$productDetail = $db->getRows("SELECT * FROM product WHERE Product_Id = :id", ['id' => $id], true);

if (!$productDetail) {
    header("Location: ".BASE_URL."/Error/404.php");
}

$brand = $db->getRows("SELECT * FROM brand WHERE Brand_Id = :brand_id", ['brand_id' => $productDetail['Brand_Id']], true);
$category = $db->getRows("SELECT * FROM category WHERE Category_Id = :category_id", ['category_id' => $productDetail['Category_Id']], true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: ../Auth/login.php");
        exit();
    }

    $quantity = $_POST['quantity'];
    $cartItem = $cart->getCartItem($db, $productDetail['Product_Id']);
    if ($cartItem) {
        $newQuantity = $cartItem['quantity'] + $quantity;
        $cart->updateQuantity($db, $productDetail['Product_Id'], $newQuantity);
    } else {
        $cart->addToCart($db, $productDetail['Product_Id'], $quantity);
    }
}
require_once "../include/layout/header.php";
?>

<div class="row p-4">
    <div class="col-6">
        <img src="../include/image/<?= $productDetail['Image'] ?>" alt="Hình ảnh" class="img-fluid">
    </div>
    <div class="col-6">
        <h2><?= $productDetail['Product_Name'] ?></h2>
        <p><b>Mô tả:</b><?= $productDetail['Description'] ?></p>
        <p><b>Giá:</b> <?= number_format($productDetail['Price'], 0, ',', '.') ?> VNĐ</p>
        <p><b>Nhãn hiệu:</b> <?= $brand['Brand_Name'] ?></p>
        <p><b>Danh mục:</b> <?= $category['Category_Name'] ?></p>
        <form method="post">
            <div class="quantity-input mb-3">
                <label for="quantity"><b>Số lượng:</b></label>
                <button type="button" class="btn-outline-warning" id="decrease" onclick="decreaseQuantity()">-</button>
                <input type="text" id="quantity" name="quantity" min="1" value="1" readonly>
                <button type="button" class="btn-outline-warning" id="increase" onclick="increaseQuantity()">+</button>
            </div>
            <button type="submit" name="add_to_cart" class="btn btn-primary add-to-cart">Thêm vào giỏ hàng</button>
        </form>
    </div>
</div>
<script>
    function increaseQuantity() {
        event.preventDefault();
        let quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
    }

    function decreaseQuantity() {
        event.preventDefault();
        let quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        }
    }
</script>

<?php require_once "../include/layout/footer.php" ?>
