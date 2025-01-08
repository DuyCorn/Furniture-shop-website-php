<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'customer') {
    header("Location: ../Error/401.php");
    exit();
}
require_once '../include/Database.php';

$db = new Database();
$categories = $db->getAllData('category');

$categoryName = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteCategory'])) {
        $categoryIdToDelete = $_POST['deleteCategory'];

        $db->delete('product', 'Category_Id = :categoryIdToDelete', ['categoryIdToDelete' => $categoryIdToDelete]);

        $db->delete('category', 'Category_Id = :categoryIdToDelete', ['categoryIdToDelete' => $categoryIdToDelete]);
        header('Location: category.php');
        exit();
    } else {
        $categoryName = trim($_POST['categoryName']);

        if (empty($categoryName)) {
            $errors[] = 'Category name is required.';
        } else {
            $query = "SELECT * FROM category WHERE LOWER(`Category_Name`) = LOWER(:categoryName) LIMIT 1";
            $stmt = $db->prepareAndExecute($query, ['categoryName' => $categoryName]);
            if ($stmt->rowCount() > 0) {
                $errors[] = 'Category name already exists in the database.';
            } else {
                $data = ['Category_Name' => $categoryName];
                $db->insert('category', $data);
                header('Location: category.php');
                exit();
            }
        }
    }
}

require_once 'layout/headerAdmin.php';
?>

<div class="card mt-3">
    <div class="card-header">
        Add New Category
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Enter category name" value="<?php echo htmlspecialchars($categoryName); ?>">
                <?php if (!empty($errors)): ?>
                    <p><small class="text-danger"><?php echo $errors[0]; ?></small></p>
                <?php endif; ?>
            </div>
            <button name="addCategory" type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</div>

<table class="table table-striped mt-3">
    <thead class="bg-success text-white">
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['Category_Id']; ?></td>
                <td><?php echo $category['Category_Name']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $category['Category_Id']; ?>" data-category-name="<?php echo $category['Category_Name']; ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the category "<b><span id="categoryNameToDelete"></span></b>"?
                <p class="text-danger">This will delete all products associated with this category.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="post">
                    <input type="hidden" name="deleteCategory" id="categoryIdToDeleteInput"> 
                    <button class="btn btn-danger delete-modal">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.delete-btn').click(function() {
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('category-name');
            $('#categoryNameToDelete').text(categoryName);
            $('input[name="deleteCategory"]').val(categoryId);
        });

        $('.delete-modal').click(function() {
            $('#deleteModal form').submit();
        });
    });
</script>