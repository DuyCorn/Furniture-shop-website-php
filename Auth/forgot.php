<?php
require_once '../config.php';
require_once "../Auth/Auth.php";
require_once "../include/function.php";

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $user = $auth->db->getRows("SELECT * FROM users WHERE Email = :email", ['email' => $email], true);

    if (!$user) {
        echo "Email không tồn tại trong hệ thống.";
    } else {
        $token = bin2hex(random_bytes(50)); 

        $auth->db->insert('reset_pass', [
            'Email' => $email,
            'Token' => $token
        ]);

        $resetLink = "./reset.php?token=$token";
        $content = "Click vào đường link sau để đặt lại mật khẩu: $resetLink";
        sendMail($email, 'Đặt lại mật khẩu', $content);
    }
}

require_once "../include/layout/header.php" ?>

<div class="container forgot-container">
    <div class="card auth-card">
        <h2 class="text-center mb-4">Nhập Email</h2>
        <form method="post">
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <span>|</span>
                <input name="email" type="text" class="form-control" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3 mb-1">Gửi</button>
        </form>
    </div>
</div>

<?php require_once "../include/layout/footer.php" ?>