<?php
require_once __DIR__ . '/../models/JobModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
class JobController
{
    private JobModel $jobs;
    private CategoryModel $categories;
    public function __construct()
    {
        $this->jobs = new JobModel();
        $this->categories = new CategoryModel();
    }
    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $category = (int)($_GET['category'] ?? 0);
        $jobs = $this->jobs->search($q, $category);
        $categories = $this->categories->all();
        require __DIR__ . '/../view/home.php';
    }
    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $job = $this->jobs->find($id);
        if (!$job) {
            http_response_code(404);
            exit('Công việc không tồn tại.');
        }
        require __DIR__ . '/../view/job.php';
    }
    public function apply(): void
    {
        require_login();
        verify_csrf();
        $jobId = (int)($_POST['job_id'] ?? 0);
        $uid = (int)user()['id'];
        $stmt = db()->prepare('INSERT INTO applications(job_id,user_id,cover_letter) VALUES(?,?,?)');
        try {
            $stmt->execute([$jobId, $uid, trim($_POST['cover_letter'] ?? '')]);
            flash('success', 'Ứng tuyển thành công!');
        } catch (PDOException $e) {
            flash('error', 'Bạn đã ứng tuyển công việc này hoặc dữ liệu không hợp lệ.');
        }
        redirect('index.php?page=job&id=' . $jobId);
    }
}
