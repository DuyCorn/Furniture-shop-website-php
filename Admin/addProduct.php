<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}

require_once 'layout/headerAdmin.php';
require_once '../include/Database.php';

$db = new Database();

$brands = $db->getAllData('brand');
$categories = $db->getAllData('category');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = trim($_POST['Product_Name']);
    $description = trim($_POST['Description']);
    $price = $_POST['Price'];
    $brandId = $_POST['Brand_Id'];
    $categoryId = $_POST['Category_Id'];

    if (!empty($_FILES['Image']['name'])) {
        $image = $_FILES['Image']['name'];
        $tmpName = $_FILES['Image']['tmp_name'];
        $uploadDir = '../include/image/';
        $uploadFile = $uploadDir . basename($image);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if ($fileType != 'image/jpeg' && $fileType != 'image/png' || filesize($tmpName) > 10 * 1024 * 1024) {
            $errors['image'] = "Invalid image. Image must be a JPEG or PNG file and cannot exceed 10MB.";
        }
    } else {
        $errors['image'] = "Please select an image file.";
    }

    if (strlen($productName) < 3 || !preg_match('/^[a-zA-Z0-9\s\p{L}]+$/u', $productName)) {
        $errors['productName'] = "Invalid product name. Product name must be at least 3 characters and can only contain letters, numbers, and spaces.";
    }

    if (empty($description) || !preg_match('/^[a-zA-Z0-9\s\p{L}]+$/u', $description)) {
        $errors['description'] = "Invalid description. Description cannot be empty and can only contain letters, numbers, and spaces.";
    }

    if (empty($price) || !is_numeric($price)) {
        $errors['price'] = "Invalid price. Price must be a number.";
    }

    if ($brandId == '') {
        $errors['brandId'] = "Please select a brand.";
    }

    if ($categoryId == '') {
        $errors['categoryId'] = "Please select a category.";
    }

    if (empty($errors)) {
        if (move_uploaded_file($tmpName, $uploadFile)) {
            $data = [
                'Product_Name' => $productName,
                'Description' => $description,
                'Price' => $price,
                'Image' => $image,
                'Brand_Id' => $brandId,
                'Category_Id' => $categoryId
            ];

            echo "<pre>";
        print_r($data);
        echo "</pre>";

            $result = $db->insert('product', $data);
            if ($result) {
                echo "Product added successfully.";
            } else {
                echo "Error adding product.";
            }
        } else {
            echo "Error uploading image.";
        }
    }
}
?>

<h1 class="mt-4">Add new product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="Product_Name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="Product_Name" name="Product_Name">
        <?php if (isset($errors['productName'])) { ?>
            <p class="text-danger"><small><?= $errors['productName'] ?></small></p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="Description" class="form-label">Description</label>
        <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
        <?php if (isset($errors['description'])) { ?>
            <p class="text-danger"><small><?= $errors['description'] ?></small></p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="Price" class="form-label">Price</label>
        <input type="number" class="form-control" id="Price" name="Price" step="0.01">
        <?php if (isset($errors['price'])) { ?>
            <p class="text-danger"><small><?= $errors['price'] ?></small></p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="Brand_Id" class="form-label">Brand</label>
        <select class="form-control" id="Brand_Id" name="Brand_Id">
            <option value="">Choose Brand</option>
            <?php foreach ($brands as $brand) { ?>
                <option value="<?= $brand['Brand_Id'] ?>"><?= $brand['Brand_Name'] ?></option>
            <?php } ?>
        </select>
        <?php if (isset($errors['brandId'])) { ?>
            <p class="text-danger"><small><?= $errors['brandId'] ?></small></p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="Category_Id" class="form-label">Category</label>
        <select class="form-control" id="Category_Id" name="Category_Id">
            <option value="">Choose Category</option>
            <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['Category_Id'] ?>"><?= $category['Category_Name'] ?></option>
            <?php } ?>
        </select>
        <?php if (isset($errors['categoryId'])) { ?>
            <p class="text-danger"><small><?= $errors['categoryId'] ?></small></p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="Image" class="form-label">Image</label>
        <input type="file" class="form-control" id="Image" name="Image">
        <?php if (isset($errors['image'])) { ?>
            <p class="text-danger"><small><?= $errors['image'] ?></small></p>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>

<?php require_once 'layout/footerAdmin.php'; ?>