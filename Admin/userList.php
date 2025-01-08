<?php
session_start();
if (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'admin') {
    header("Location: ../Error/401.php");
    exit();
}

require_once 'layout/headerAdmin.php';
require_once '../include/Database.php';
$db = new Database();

$users = $db->getAllData('users');
?>

<table class="table table-striped mt-4">
    <thead class="bg-success text-white">
        <tr>
            <th>Username</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['Username']; ?></td>
                <td><?php echo $user['Role']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
require_once 'layout/footerAdmin.php'
?>