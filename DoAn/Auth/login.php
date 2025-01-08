<?php
require_once '../config.php';
require_once "Auth.php";

$auth = new Auth();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $errors = $auth->login($username, $password);
}

require_once "../include/layout/header.php";
?>

<div class="container login-container">
    <div class="card auth-card">
        <h2 class="text-center mb-4">Đăng Nhập</h2>
        <form method="post">
            <div class="form-group">
                <i class="fa fa-user"></i>
                <span>|</span>
                <input name="username" type="text" class="form-control mb-3" placeholder="Tên đăng nhập" required value="<?php echo isset($username) ? $username : ''; ?>">
                <?php if (isset($errors['username'])): ?>
                    <p style="color:red;"><small><?php echo $errors['username']; ?></small></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <span>|</span>
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                <?php if (isset($errors['password'])): ?>
                    <p style="color:red;"><small><?php echo $errors['password']; ?></small></p>
                <?php endif; ?>
                <a href="forgot.php">Quên mật khẩu?</a>
            </div>
                <button type="submit" class="btn btn-primary w-100 mt-3 mb-1">Đăng Nhập</button>
                <p class="text-center">Chưa có tài khoản?<a href="register.php"> Đăng kí ngay</a></p>
        </form>
    </div>
</div>

<?php require_once "../include/layout/footer.php" ?>
