
<?php
session_start();
require_once 'function.php';

require_once __DIR__ . '/database.php';

require_once __DIR__ . '/models/JobModel.php';
require_once __DIR__ . '/models/UserModel.php';
require_once __DIR__ . '/models/CategoryModel.php';

require_once __DIR__ . '/controllers/JobController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/EmployerController.php';
require_once __DIR__ . '/controllers/AdminController.php';

$page = $_GET['page'] ?? 'home';

if ($page === 'home' || $page === 'jobs') {
    $controller = new JobController();
    $controller->index();
} elseif ($page === 'job') {
    $controller = new JobController();
    $controller->show();
} elseif ($page === 'apply') {
    $controller = new JobController();
    $controller->apply();
} elseif ($page === 'login') {
    $controller = new UserController();
    $controller->login();
} elseif ($page === 'register') {
    $controller = new UserController();
    $controller->register();
} elseif ($page === 'logout') {
    $controller = new UserController();
    $controller->logout();
} elseif ($page === 'profile') {
    $controller = new UserController();
    $controller->profile();
} elseif ($page === 'employer') {
    $controller = new EmployerController();
    $controller->dashboard();
} elseif ($page === 'post-job') {
    $controller = new EmployerController();
    $controller->create();
} elseif ($page === 'edit-job') {
    $controller = new EmployerController();
    $controller->edit();
} elseif ($page === 'delete-job') {
    $controller = new EmployerController();
    $controller->delete();
} elseif ($page === 'admin') {
    $controller = new AdminController();
    $controller->dashboard();
} else {
    http_response_code(404);
    exit('404 - Không tìm thấy trang');
}
?>
