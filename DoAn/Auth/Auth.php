<?php
session_start();
require_once "../include/Database.php";

class Auth {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username, $password) {
        $errors = [];
        $user = $this->db->getRows("SELECT * FROM users WHERE Username = :username", ['username' => $username], true);

        if (!$user) {
            $errors['username'] = 'Tên đăng nhập không tồn tại.';
        }
    
        if (!$user || !password_verify($password, $user['Password'])) {
            $errors['password'] = 'Mật khẩu không đúng.';
        }
        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['User_Id'];
            $_SESSION['Role'] = $user['Role'];
            if ($user['Role'] == 'admin') {
                header("Location: ../Admin/dashboard.php");
            } else {
                header("Location: " . BASE_URL . "/");
            }
            exit();
        }
        return $errors;
    }    

    public function register($username, $email, $phone, $password) {
        $errors = [];
        if (empty($username) || !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $errors['username'] = 'Tên đăng nhập không được chứa ký tự đặc biệt hoặc để trống.';
        }
        if (empty($password) || strlen($password) < 8) {
            $errors['password'] = 'Mật khẩu phải dài ít nhất 8 ký tự và không được để trống.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ hoặc để trống.';
        }
        if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
            $errors['phone'] = 'Số điện thoại phải dài đúng 10 số và không được để trống.';
        }
        if (empty($errors)) {
            $existingUser = $this->db->getRows("SELECT * FROM users WHERE email = :email", ['email' => $email], true);
            if ($existingUser) {
                $errors['email'] = 'Email đã được sử dụng.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->db->insert('Users', [
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => $hashedPassword,
                    'role' => 'customer'
                ]);
    
                $newUser = $this->db->getRows("SELECT * FROM Users WHERE email = :email", ['email' => $email], true);
    
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $newUser['User_Id'];
                $_SESSION['Role'] = $newUser['Role'];
                if ($newUser['Role'] == 'admin') {
                    header("Location: ../Admin/dashboard.php");
                } else {
                    header("Location: ".BASE_URL."");
                }
                exit();
            }
        }
        return $errors;
    }    
    
    public function logout() {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['Role']);
    }
    
}
