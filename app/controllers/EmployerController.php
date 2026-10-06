<?php
require_once __DIR__ . '/../models/JobModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
class EmployerController
{
    private JobModel $jobs;
    private CategoryModel $cats;
    public function __construct()
    {
        $this->jobs = new JobModel();
        $this->cats = new CategoryModel();
    }
    public function dashboard(): void
    {
        require_role('employer');
        $jobs = $this->jobs->byEmployer((int)user()['id']);
        require __DIR__ . '/../view/employer.php';
    }
    public function create(): void
    {
        require_role('employer');
        $categories = $this->cats->all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $this->jobs->create($_POST, (int)user()['id']);
            flash('success', 'Đăng tin tuyển dụng thành công.');
            redirect('index.php?page=employer');
        }
        $job = null;
        require __DIR__ . '/../view/job_form.php';
    }
    public function edit(): void
    {
        require_role('employer');
        $id = (int)($_GET['id'] ?? 0);
        $job = $this->jobs->findOwned($id, (int)user()['id']);
        if (!$job) exit('Không có quyền hoặc công việc không tồn tại.');
        $categories = $this->cats->all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $this->jobs->update($id, $_POST);
            flash('success', 'Đã cập nhật tin tuyển dụng.');
            redirect('index.php?page=employer');
        }
        require __DIR__ . '/../view/job_form.php';
    }
    public function delete(): void
    {
        require_role('employer');
        verify_csrf();
        $this->jobs->delete((int)($_POST['id'] ?? 0), (int)user()['id']);
        flash('success', 'Đã xóa tin.');
        redirect('index.php?page=employer');
    }
}
