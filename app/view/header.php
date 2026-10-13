<?php $f = flash(); ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title ?? 'JobFinder') ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="nav"><a class="brand" href="index.php">Job<span>Finder</span></a>
        <nav><a href="index.php?page=jobs">Tìm việc</a>
        <?php if (user() && user()['role'] === 'employer'): ?>
            <a href="index.php?page=employer">Nhà tuyển dụng</a>
            <?php endif; ?><?php if (user() && user()['role'] === 'admin'): ?>
                <a href="index.php?page=admin">Quản trị</a><?php endif; ?></nav>
        <div class="account"><?php if (user()): ?><span>Xin chào, <?= e(user()['name']) ?>
        </span><a class="btn outline" href="index.php?page=logout">Đăng xuất</a><?php else: ?>
            <a href="index.php?page=login">Đăng nhập</a><a class="btn" href="index.php?page=register">Đăng ký</a>
            <?php endif; ?></div>
    </header>
    <?php if ($f): ?><div class="flash <?= $f[0] ?>"><?= e($f[1]) ?></div><?php endif; ?>
    <main class="container">