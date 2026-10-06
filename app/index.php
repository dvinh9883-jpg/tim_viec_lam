<?php
require_once __DIR__ . '/function.php';
$page = $_GET['page'] ?? 'home';
$routes = [
    'home' => ['controllers/JobController.php', 'index'],
    'jobs' => ['controllers/JobController.php', 'index'],
    'job' => ['controllers/JobController.php', 'show'],
    'apply' => ['controllers/JobController.php', 'apply'],
    'login' => ['controllers/UserController.php', 'login'],
    'register' => ['controllers/UserController.php', 'register'],
    'logout' => ['controllers/UserController.php', 'logout'],
    'profile' => ['controllers/UserController.php', 'profile'],
    'employer' => ['controllers/EmployerController.php', 'dashboard'],
    'post-job' => ['controllers/EmployerController.php', 'create'],
    'edit-job' => ['controllers/EmployerController.php', 'edit'],
    'delete-job' => ['controllers/EmployerController.php', 'delete'],
    'admin' => ['controllers/AdminController.php', 'dashboard'],
];
if (!isset($routes[$page])) {
    http_response_code(404);
    exit('404 - Không tìm thấy trang');
}
[$file, $method] = $routes[$page];
require __DIR__ . '/' . $file;
$controller = match (true) {
    str_contains($file, 'JobController') => new JobController(),
    str_contains($file, 'UserController') => new UserController(),
    str_contains($file, 'EmployerController') => new EmployerController(),
    default => new AdminController(),
};
$controller->$method();
