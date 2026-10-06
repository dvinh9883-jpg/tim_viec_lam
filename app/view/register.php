<?php $title = 'Đăng ký';
require __DIR__ . '/header.php'; ?><div class="auth">
    <h1>Tạo tài khoản</h1>
    <form method="post"><input type="hidden" name="csrf" value="<?= csrf_token() ?>"><label>Họ và tên</label><input name="name" required value="<?= old('name') ?>"><label>Email</label><input type="email" name="email" required value="<?= old('email') ?>"><label>Mật khẩu</label><input type="password" name="password" minlength="6" required><label>Bạn là</label><select name="role">
            <option value="candidate">Ứng viên tìm việc</option>
            <option value="employer">Nhà tuyển dụng</option>
        </select><button>Đăng ký</button></form>
</div><?php require __DIR__ . '/footer.php'; ?>