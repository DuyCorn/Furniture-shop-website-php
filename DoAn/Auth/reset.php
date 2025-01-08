<?php
require_once '../config.php';
require_once "../Auth/Auth.php";

$auth = new Auth();

$auth = new Auth();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPass = $_POST['newPass'];
    $rePass = $_POST['rePass'];
    $token = $_GET['token'];

    if (empty($newPass) || strlen($newPass) < 8) {
        $errors['password'] = 'Mật khẩu phải dài ít nhất 8 ký tự và không được để trống.';
    }

    if ($newPass !== $rePass) {
        $errors['rePass'] = 'Mật khẩu nhập lại không khớp.';
    }

    if (empty($errors)) {
        $resetPassRow = $auth->db->getRows("SELECT * FROM reset_pass WHERE Token = :token", ['token' => $token], true);

        if ($resetPassRow) {
            $email = $resetPassRow['Email'];

            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);
            $auth->db->update('users', ['Password' => $hashedPassword], "Email = '$email'");

            $auth->db->delete('reset_pass', "Token = '$token'");

            echo "<script>alert('Đổi mật khẩu thành công'); window.location = '../Auth/login.php';</script>";
        }
    }
}
require_once "../include/layout/header.php" ?>

<div class="container forgot-container">
    <div class="card auth-card">
        <h2 class="text-center mb-4">Lấy lại mật khẩu</h2>
        <form method="post">
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <span>|</span>
                <input name="newPass" type="password" class="form-control" placeholder="Mật khẩu mới" required>
                <p class="error"style="color:red;"><small><?php echo $errors['newPass'] ?? ''; ?></small></p>
            </div>
            <div class="form-group mt-3">
                <i class="fa fa-redo"></i>
                <span>|</span>
                <input name="rePass" type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
                <p class="error"style="color:red;"><small><?php echo $errors['rePass'] ?? ''; ?></small></p>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3 mb-1">Cập nhật</button>
        </form>
    </div>
</div>

<?php require_once "../include/layout/footer.php" ?>