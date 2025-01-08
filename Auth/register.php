<?php
require_once '../config.php';
require_once "Auth.php";
$auth = new Auth();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $errors = $auth->register($username, $email, $phone, $password);

    if(empty($errors)) {
        header("Location: " . BASE_URL);
    }
}

require_once "../include/layout/header.php" ;
?>

<div class="container register-container">
        <div class="card auth-card">
            <h2 class="text-center mb-4">Đăng Ký</h2>
            <form method="post">
                <div class="form-group">
                    <i class="fa fa-user"></i>
                    <span>|</span>
                    <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập">
                    <p><small style="color:darkblue">(Tên đăng nhập không được chứa kí tự đặc biệt)</small></p>
                    <p class="error" style="color:red;"><small><?php echo $errors['username'] ?? ''; ?></small></p>
                </div>
                <div class="form-group">
                    <i class="fa fa-envelope"></i>
                    <span>|</span>
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    <p class="error"style="color:red;"><small><?php echo $errors['email'] ?? ''; ?></small></p>
                </div>
                <div class="form-group">
                    <i class="fa fa-phone"></i>
                    <span>|</span>
                    <input name="phone" type="tel" class="form-control" placeholder="Số điện thoại">
                    <p class="error"style="color:red;"><small><?php echo $errors['phone'] ?? ''; ?></small></p>
                </div>
                <div class="form-group">
                    <i class="fa fa-lock"></i>
                    <span>|</span>
                    <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                    <p><small style="color:darkblue">(Mật khẩu phải từ 8 kí tự trở lên)</small></p>
                    <p class="error"style="color:red;"><small><?php echo $errors['password'] ?? ''; ?></small></p>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-1 mb-1">Đăng Ký</button>
                <p class="text-center">Đã có tài khoản?<a href="login.php"> Đăng nhập ngay</a></p>
            </form>
        </div>
    </div>

<?php 
require_once "../include/layout/footer.php"
?>
