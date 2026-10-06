<?php $title = 'Đăng nhập';
require __DIR__ . '/header.php'; ?><div class="auth">
    <h1>Đăng nhập</h1>
    <form method="post"><input type="hidden" name="csrf" value="<?= csrf_token() ?>"><label>Email</label><input type="email" name="email" required value="<?= old('email') ?>"><label>Mật khẩu</label><input type="password" name="password" required><button>Đăng nhập</button></form>
    <p>Chưa có tài khoản? <a href="index.php?page=register">Đăng ký</a></p>
</div><?php require __DIR__ . '/footer.php'; ?>