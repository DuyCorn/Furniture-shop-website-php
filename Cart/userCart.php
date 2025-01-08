<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . BASE_URL . "/Auth/login.php");
    exit();
}

require_once '../config.php';
require_once "../include/Database.php";
require_once '../Product/Product.php';
require_once "Cart.php";

$db = new Database();
$product = new Product();
$cart = new Cart($_SESSION['user_id'], $db);

$cartItems = $cart->getCartItems($db);
$totalPrice = $cart->getTotalPrice($db);

if (isset($_POST['checkout'])) {
    $cart->clearCart($db); 

    $db->update('total_money', ['total' => $totalPrice], '1');

    header("Location: userCart.php");
    exit();
}
require_once "../include/layout/header.php";

?>

<div class="container mt-5">
    <table class="table table-striped custom-table">
        <thead>
            <tr>
                <th style="width: 250px;">Ảnh sản phẩm</th>
                <th style="width: 20%; margin-left: 100px;">Tên sản phẩm</th>
                <th style="width: 20%;">Số lượng</th>
                <th style="width: 20%;">Số tiền</th>
                <th style="width: 20%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item):
                $productDetail = $product->getProductById($db, $item['product_id']);
                $itemTotal = $productDetail['Price'] * $item['quantity'];
            ?>
                <tr>
                    <td><img src="../include/image/<?= $productDetail['Image'] ?>" alt="Hình ảnh" class="img-fluid" style="width: 100%;"></td>
                    <td><?= $productDetail['Product_Name'] ?></td>
                    <td>
                        <div class="quantity-input mb-3">
                            <a id="cart-quantity" role="button" class="btn-outline-warning" href="decrease_quantity.php?id=<?= $item['id'] ?>">-</a>
                            <input type="text" name="quantity" min="1" value="<?= $item['quantity'] ?>" style="width: 50px;" readonly>
                            <a id="cart-quantity" role="button" class="btn-outline-warning" href="increase_quantity.php?id=<?= $item['id'] ?>">+</a>
                        </div>
                    </td>
                    <td><?= number_format($itemTotal, 0, ',', '.') ?> VNĐ</td>
                    <td><a href="remove.php?id=<?= $item['id'] ?>" role="button" class="btn btn-danger">Xóa khỏi giỏ hàng</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <h4>Tổng tiền: <?= number_format($totalPrice, 0, ',', '.') ?> VNĐ</h4>
        <form method="POST">
            <button type="submit" name="checkout" class="btn btn-success ms-3">Thanh toán</button>
        </form>
    </div>
</div>

<?php require_once "../include/layout/footer.php" ?>