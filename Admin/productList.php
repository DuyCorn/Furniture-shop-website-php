<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}

require_once '../include/Database.php';
require_once '../Product/Product.php';

require_once 'layout/headerAdmin.php';

$db = new Database();

$perPage = 15;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($currentPage - 1) * $perPage;

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($searchQuery)) {
    // Use LOWER() function to make the search case-insensitive
    $sql = "SELECT * FROM product WHERE LOWER(Product_Name) LIKE :searchQuery LIMIT :start, :perPage";
    $products = $db->getRows($sql, [':searchQuery' => '%' . strtolower($searchQuery) . '%', ':start' => $start, ':perPage' => $perPage]);
    // Use LOWER() function for the count query as well
    $totalProducts = $db->countRows("SELECT * FROM product WHERE LOWER(Product_Name) LIKE '%" . strtolower($searchQuery) . "%'");
} else {
    $products = $db->getLimitedRows('product', $perPage, $start);
    $totalProducts = $db->countRows("SELECT * FROM product");
}

$totalPages = ceil($totalProducts / $perPage);

?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Product List</h1>

    <div class="mb-3">
        <form method="GET" action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search products..." name="search" value="<?php echo $searchQuery; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Product List
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Brand Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $row): ?>
                        <tr>
                            <td><?php echo $row['Product_Name']; ?></td>
                            <td><?php echo number_format($row['Price'], 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <?php
                                $brandName = $db->getRows("SELECT Brand_Name FROM brand WHERE Brand_Id = " . $row['Brand_Id'], [], true)['Brand_Name'];
                                echo $brandName;
                                ?>
                            </td>
                            <td>
                                <a href="detailAdmin.php?id=<?php echo $row['Product_Id']; ?>" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?><?php if (!empty($searchQuery)) { echo '&search=' . $searchQuery; } ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($currentPage == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?><?php if (!empty($searchQuery)) { echo '&search=' . $searchQuery; } ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?><?php if (!empty($searchQuery)) { echo '&search=' . $searchQuery; } ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php 
require_once 'layout/footerAdmin.php';
?>