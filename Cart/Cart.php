<?php
class Cart {
    public $id;
    public $user_id;

    public function __construct($user_id, $db) {
        $this->user_id = $user_id;
        $this->id = $this->getCartId($db);
        if ($this->id === null) {
            $this->createCart($db);
            $this->id = $this->getCartId($db);
        }
    }
    public function createCart($db) {
        $sql = "INSERT INTO cart (user_id) VALUES (:user_id)";
        $data = ['user_id' => $this->user_id];
        return $db->prepareAndExecute($sql, $data);
    }

    public function getCart($db) {
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $data = ['user_id' => $this->user_id];
        return $db->getRows($sql, $data, true);
    }
    public function addToCart($db, $product_id, $quantity) {
        $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)";
        $data = ['cart_id' => $this->id, 'product_id' => $product_id, 'quantity' => $quantity];
        return $db->prepareAndExecute($sql, $data);
    }
    public function removeFromCart($db, $id) {
        $sql = "DELETE FROM cart_items WHERE id = :id";
        $data = ['id' => $id];
        return $db->prepareAndExecute($sql, $data);
    }

    public function getCartItems($db) {
        $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id";
        $data = ['cart_id' => $this->id];
        return $db->getRows($sql, $data);
    }

    public function increaseQuantity($db, $id) {
        $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE id = :id";
        $data = ['id' => $id];
        return $db->prepareAndExecute($sql, $data);
    }
    
    public function decreaseQuantity($db, $id) {
        $sql = "UPDATE cart_items SET quantity = quantity - 1 WHERE id = :id AND quantity > 1";
        $data = ['id' => $id];
        return $db->prepareAndExecute($sql, $data);
    }

    public function getTotalPrice($db) {
        $sql = "SELECT SUM(p.price * ci.quantity) as total FROM cart_items ci JOIN product p ON ci.product_id = p.Product_Id WHERE ci.cart_id = :cart_id";
        $data = ['cart_id' => $this->id];
        $result = $db->getRows($sql, $data, true);
        return is_array($result) ? $result['total'] : 0;
    }
    public function updateQuantity($db, $product_id, $newQuantity) {
        $sql = "UPDATE cart_items SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id";
        $data = ['cart_id' => $this->id, 'product_id' => $product_id, 'quantity' => $newQuantity];
        return $db->prepareAndExecute($sql, $data);
    }
    public function clearCart($db) {
        $sql = "DELETE FROM cart_items WHERE cart_id = :cart_id";
        $data = ['cart_id' => $this->id];
        return $db->prepareAndExecute($sql, $data);
    }

    public function getCartItem($db, $product_id) {
        $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id";
        $data = ['cart_id' => $this->id, 'product_id' => $product_id];
        return $db->getRows($sql, $data, true);
    }
    public function getCartId($db) {
        $cart = $db->getRows("SELECT id FROM cart WHERE user_id = :user_id", ['user_id' => $this->user_id], true);
        return $cart ? $cart['id'] : null;
    }
}
