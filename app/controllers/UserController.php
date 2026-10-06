<?php
class UserController
{
    public function login(): void
    {
        if (user()) redirect('index.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $s = db()->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
            $s->execute([$email]);
            $u = $s->fetch();
            if ($u && password_verify($password, $u['password'])) {
                $_SESSION['user'] = $u;
                flash('success', 'Đăng nhập thành công.');
                redirect('index.php');
            }
            flash('error', 'Email hoặc mật khẩu không đúng.');
        }
        require __DIR__ . '/../view/login.php';
    }
    public function register(): void
    {
        if (user()) redirect('index.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $pass = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'candidate';
            if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6 || !in_array($role, ['candidate', 'employer'], true)) flash('error', 'Vui lòng nhập thông tin hợp lệ.');
            else {
                try {
                    $s = db()->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)');
                    $s->execute([$name, $email, password_hash($pass, PASSWORD_DEFAULT), $role]);
                    flash('success', 'Tạo tài khoản thành công, hãy đăng nhập.');
                    redirect('index.php?page=login');
                } catch (PDOException $e) {
                    flash('error', 'Email đã được sử dụng.');
                }
            }
        }
        require __DIR__ . '/../view/register.php';
    }
    public function logout(): void
    {
        session_destroy();
        redirect('index.php');
    }
    public function profile(): void
    {
        require_login();
        require __DIR__ . '/../view/profile.php';
    }
}
