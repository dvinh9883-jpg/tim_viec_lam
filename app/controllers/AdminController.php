<?php
class AdminController
{
    public function dashboard(): void
    {
        require_role('admin');
        $users = db()->query('SELECT id,name,email,role,created_at FROM users ORDER BY id DESC')->fetchAll();
        $jobs = db()->query('SELECT j.*,u.name employer FROM jobs j JOIN users u ON u.id=j.employer_id ORDER BY j.id DESC')->fetchAll();
        require __DIR__ . '/../view/admin.php';
    }
}
