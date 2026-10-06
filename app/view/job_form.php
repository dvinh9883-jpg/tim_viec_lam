<?php $title = $job ? 'Sửa tin' : 'Đăng tin tuyển dụng';
require __DIR__ . '/header.php'; ?><div class="form-page">
    <h1><?= $job ? 'Sửa tin tuyển dụng' : 'Đăng tin tuyển dụng' ?></h1>
    <form method="post"><input type="hidden" name="csrf" value="<?= csrf_token() ?>"><label>Tiêu đề công việc</label><input name="title" required value="<?= e($job['title'] ?? '') ?>"><label>Ngành nghề</label><select name="category_id" required><?php foreach ($categories as $c): ?><option value="<?= $c['id'] ?>" <?= ($job['category_id'] ?? 0) == $c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option><?php endforeach; ?></select><label>Địa điểm</label><input name="location" required value="<?= e($job['location'] ?? '') ?>"><label>Mức lương</label><input name="salary" value="<?= e($job['salary'] ?? '') ?>" placeholder="10 - 20 triệu"><label>Loại hình</label><select name="job_type">
            <option>Toàn thời gian</option>
            <option>Part-time</option>
            <option>Remote</option>
            <option>Thực tập</option>
        </select><label>Hạn ứng tuyển</label><input type="date" name="deadline" value="<?= e($job['deadline'] ?? '') ?>"><label>Mô tả</label><textarea name="description" rows="10" required><?= e($job['description'] ?? '') ?></textarea><button>Lưu tin</button></form>
</div><?php require __DIR__ . '/footer.php'; ?>