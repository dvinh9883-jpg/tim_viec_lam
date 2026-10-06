<?php $title = 'Tài khoản';
require __DIR__ . '/header.php'; ?><div class="auth">
    <h1>Tài khoản</h1>
    <p><b>Họ tên:</b> <?= e(user()['name']) ?></p>
    <p><b>Email:</b> <?= e(user()['email']) ?></p>
    <p><b>Vai trò:</b> <?= e(user()['role']) ?></p>
</div><?php require __DIR__ . '/footer.php'; ?>