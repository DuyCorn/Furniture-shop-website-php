<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'customer') {
    header("Location: ../Error/401.php");
    exit();
}
require_once '../include/Database.php';

$db = new Database();
$brands = $db->getAllData('brand');

$brandName = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteBrand'])) {
        $brandIdToDelete = $_POST['deleteBrand'];
        $db->delete('product', 'Brand_Id = :brandIdToDelete', ['brandIdToDelete' => $brandIdToDelete]);
        $db->delete('brand', 'Brand_Id = :brandIdToDelete', ['brandIdToDelete' => $brandIdToDelete]);
        header('Location: brand.php');
        exit();
    } else {
        $brandName = trim($_POST['brandName']);

        if (empty($brandName)) {
            $errors[] = 'Brand name is required.';
        } elseif (strlen($brandName) < 5) {
            $errors[] = 'Brand name must be at least 5 characters long.';
        } else {
            $query = "SELECT * FROM `brand` WHERE LOWER(`Brand_Name`) = LOWER(:brandName) LIMIT 1";
            $stmt = $db->prepareAndExecute($query, ['brandName' => $brandName]);

            if ($stmt->rowCount() > 0) {
                $errors[] = 'Brand name already exists in the database.';
            } else {
                $data = ['Brand_Name' => $brandName];
                $db->insert('brand', $data);
                header('Location: brand.php');
                exit();
            }
        }
    }
}

require_once 'layout/headerAdmin.php';
?>

<div class="card mt-3">
    <div class="card-header">
        Add New Brand
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <input type="text" id="brandName" name="brandName" class="form-control" placeholder="Enter brand name" value="<?php echo htmlspecialchars($brandName); ?>">
                <?php if (!empty($errors)): ?>
                    <p><small class="text-danger"><?php echo $errors[0]; ?></small></p>
                <?php endif; ?>
            </div>
            <button name="addBrand" type="submit" class="btn btn-primary">Add Brand</button>
        </form>
    </div>
</div>

<table class="table table-striped mt-3">
    <thead class="bg-success text-white">
        <tr>
            <th>Id</th>
            <th>Brand Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($brands as $brand): ?>
            <tr>
                <td><?php echo $brand['Brand_Id']; ?></td>
                <td><?php echo $brand['Brand_Name']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $brand['Brand_Id']; ?>" data-brand-name="<?php echo $brand['Brand_Name']; ?>">Delete</button>
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
                Are you sure you want to delete the brand <b><span id="brandNameToDelete"></span></b>?
                <p class="text-danger">This will delete all products associated with this brand.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="post">
                    <input type="hidden" name="deleteBrand" id="brandIdToDeleteInput"> 
                    <button class="btn btn-danger delete-modal">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.delete-btn').click(function() {
            var brandId = $(this).data('id');
            var brandName = $(this).data('brand-name');
            $('#brandNameToDelete').text(brandName);
            $('input[name="deleteBrand"]').val(brandId);
        });

        $('.delete-modal').click(function() {
            $('#deleteModal form').submit();
        });
    });
</script>
