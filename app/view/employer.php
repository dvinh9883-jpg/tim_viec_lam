<?php $title = 'Quản lý tuyển dụng';
require __DIR__ . '/header.php'; ?><div class="page-head">
    <div>
        <h1>Quản lý tin tuyển dụng</h1>
        <p>Quản lý các vị trí bạn đang đăng.</p>
    </div><a class="btn" href="index.php?page=post-job">+ Đăng tin mới</a>
</div>
<div class="table-wrap">
    <table>
        <tr>
            <th>Vị trí</th>
            <th>Địa điểm</th>
            <th>Ứng viên</th>
            <th>Thao tác</th>
        </tr><?php foreach ($jobs as $j): ?><tr>
                <td><b><?= e($j['title']) ?></b><small><?= e($j['category_name'] ?? '') ?></small></td>
                <td><?= e($j['location']) ?></td>
                <td><?= $j['applications'] ?></td>
                <td><a href="index.php?page=edit-job&id=<?= $j['id'] ?>">Sửa</a>
                    <form class="inline" method="post" action="index.php?page=delete-job" onsubmit="return confirm('Xóa tin này?')">
                        <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
                        <input type="hidden" name="id" value="<?= $j['id'] ?>">
                        <button class="link danger">Xóa</button></form>
                </td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require __DIR__ . '/footer.php'; ?>