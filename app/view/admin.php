<?php $title = 'Quản trị';
require __DIR__ . '/header.php'; ?><div class="page-head">
    <div>
        <h1>Dashboard quản trị</h1>
        <p>Quản lý người dùng và tin tuyển dụng.</p>
    </div>
</div>
<h2>Người dùng</h2>
<div class="table-wrap">
    <table>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Vai trò</th>
        </tr><?php foreach ($users as $u): ?><tr>
                <td><?= $u['id'] ?></td>
                <td><?= e($u['name']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td><?= e($u['role']) ?></td>
            </tr><?php endforeach; ?>
    </table>
</div>
<h2>Tin tuyển dụng</h2>
<div class="table-wrap">
    <table>
        <tr>
            <th>Tiêu đề</th>
            <th>Nhà tuyển dụng</th>
            <th>Địa điểm</th>
        </tr><?php foreach ($jobs as $j): ?><tr>
                <td><?= e($j['title']) ?></td>
                <td><?= e($j['employer']) ?></td>
                <td><?= e($j['location']) ?></td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require __DIR__ . '/footer.php'; ?>