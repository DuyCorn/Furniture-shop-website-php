<?php
class Product{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $brand_id;
    public $category_id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    public function getBrandId() {
        return $this->brand_id;
    }

    public function setBrandId($brand_id) {
        $this->brand_id = $brand_id;
    }
    public function getCategoryId() {
        return $this->category_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }
    public function getAllProducts($db) {
        return $db->getAllData('product');
    }
    public function getProductById($db, $id) {
        $sql = "SELECT * FROM product WHERE Product_Id = :id";
        $data = ['id' => $id];
        return $db->getRows($sql, $data, true);
    }
    public function getLastId($db) {
        return $db->pdo->lastInsertId();
    }
    public function getProductsSorted($products, $sortType) {
        usort($products, function($a, $b) use ($sortType) {
            switch ($sortType) {
                case 'name-asc':
                    return strcmp($a['Product_Name'], $b['Product_Name']);
                case 'name-desc':
                    return strcmp($b['Product_Name'], $a['Product_Name']);
                case 'price-desc':
                    return $b['Price'] - $a['Price'];
                case 'price-asc':
                    return $a['Price'] - $b['Price'];
                default:
                    return 0;
            }
        });
        return $products;
    }    
    public function searchProductsByName($db, $searchTerm) {
        $sql = "SELECT * FROM product WHERE Product_Name LIKE :searchTerm";
        $data = ['searchTerm' => '%' . $searchTerm . '%'];
        return $db->getRows($sql, $data);
    }
    public function getTotalProducts($db) {
        return $db->countRows("SELECT * FROM product");
    }
    
}