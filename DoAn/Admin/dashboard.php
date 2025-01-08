<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}
require_once 'layout/headerAdmin.php';
require_once '../include/Database.php';

$db = new Database();

$totalProducts = $db->countRows("SELECT * FROM product");

$totalUsers = $db->countRows("SELECT * FROM users");

$totalRevenue = $db->getRows("SELECT total FROM total_money", [], true)['total'];

?>
<h1 class="mt-3 mb-3">Welcome to Admin page</h1>

<div class="row mt-4">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Tổng số sản phẩm</h5>
                        <p class="card-text text-muted mb-0">Số lượng sản phẩm hiện có</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-box-seam fs-1 text-primary"></i>
                    </div>
                </div>
                <h2 class="mt-3 mb-0"><?= $totalProducts ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Tổng số người dùng</h5>
                        <p class="card-text text-muted mb-0">Số lượng người dùng đã đăng ký</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                    </div>
                </div>
                <h2 class="mt-3 mb-0"><?= $totalUsers ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Tổng doanh thu</h5>
                        <p class="card-text text-muted mb-0">Tổng doanh thu hiện tại</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-currency-dollar fs-1 text-warning"></i>
                    </div>
                </div>
                <h2 class="mt-3 mb-0"><?= number_format($totalRevenue, 0, ',', '.') ?> VNĐ</h2>
            </div>
        </div>
    </div>
</div>

<?php 
require_once 'layout/footerAdmin.php';
?>