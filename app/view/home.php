<?php $title = 'Tìm việc làm';
require __DIR__ . '/header.php'; ?>
<section class="hero">
    <div>
        <p class="eyebrow">NỀN TẢNG TUYỂN DỤNG</p>
        <h1>Tìm công việc<br><span>phù hợp với bạn</span></h1>
        <p>Khám phá hàng trăm cơ hội việc làm và ứng tuyển trực tuyến nhanh chóng.</p>
    </div>
    <div class="hero-card">💼<strong><?= count($jobs) ?></strong><small>việc làm đang tuyển</small></div>
</section>
<form class="search" method="get"><input type="hidden" name="page" value="jobs"><input name="q" value="<?= e($q) ?>" placeholder="Chức danh, kỹ năng, địa điểm..."><select name="category">
        <option value="0">Tất cả ngành nghề</option><?php foreach ($categories as $c): ?><option value="<?= $c['id'] ?>" <?= $category == $c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option><?php endforeach; ?>
    </select><button>Tìm việc</button></form>
<h2>Việc làm mới nhất</h2>
<div class="grid"><?php foreach ($jobs as $j): ?><article class="job-card">
            <div class="logo"><?= mb_strtoupper(mb_substr($j['employer'], 0, 1)) ?></div>
            <div class="job-main"><a class="job-title" href="index.php?page=job&id=<?= $j['id'] ?>"><?= e($j['title']) ?></a>
                <div class="company"><?= e($j['employer']) ?></div>
                <div class="tags"><span>📍 <?= e($j['location']) ?></span><span>💰 <?= e($j['salary']) ?></span><span>⏱ <?= e($j['job_type']) ?></span></div>
            </div><span class="category"><?= e($j['category_name'] ?? 'Khác') ?></span>
        </article><?php endforeach;
                    if (!$jobs): ?><p>Không tìm thấy việc làm phù hợp.</p><?php endif; ?></div>
<?php require __DIR__ . '/footer.php'; ?>