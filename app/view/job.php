<?php $title = $job['title'];
require __DIR__ . '/header.php'; ?><div class="job-detail">
    <div><a href="index.php?page=jobs">← Quay lại</a>
        <h1><?= e($job['title']) ?></h1>
        <p class="company big"><?= e($job['employer']) ?></p>
        <div class="tags large"><span>📍 <?= e($job['location']) ?></span><span>💰 <?= e($job['salary']) ?></span><span>⏱ <?= e($job['job_type']) ?></span><span>🏷 <?= e($job['category_name'] ?? 'Khác') ?></span></div>
        <hr>
        <h2>Mô tả công việc</h2>
        <div class="content"><?= nl2br(e($job['description'])) ?></div>
    </div>
    <aside class="apply-box">
        <h3>Ứng tuyển ngay</h3><?php if (user() && user()['role'] === 'candidate'): ?><form method="post" action="index.php?page=apply"><input type="hidden" name="csrf" value="<?= csrf_token() ?>"><input type="hidden" name="job_id" value="<?= $job['id'] ?>"><textarea name="cover_letter" placeholder="Lời nhắn cho nhà tuyển dụng..."></textarea><button>Gửi hồ sơ</button></form><?php elseif (!user()): ?><p>Bạn cần đăng nhập để ứng tuyển.</p><a class="btn full" href="index.php?page=login">Đăng nhập</a><?php else: ?><p>Tài khoản nhà tuyển dụng không thể ứng tuyển.</p><?php endif; ?>
    </aside>
</div><?php require __DIR__ . '/footer.php'; ?>