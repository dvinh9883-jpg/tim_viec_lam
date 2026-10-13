<?php

/** Router tương thích với URL hiện tại: index.php?page=home, index.php?page=job&id=1... */

namespace Core;

final class Router
{
    private string $appDirectory;

    /**
     * @param array<string, array{0:string, 1:string, 2:string}> $routes
     *        page => [file tương đối trong app/, tên class, tên method]
     */
    public function __construct(
        private array $routes,
        ?string $appDirectory = null
    ) {
        $this->appDirectory = $appDirectory ?? dirname(__DIR__) . '/app';
    }

    public function dispatch(): void
    {
        $page = $_GET['page'] ?? 'home';
        if (!is_string($page) || !isset($this->routes[$page])) {
            http_response_code(404);
            exit('404 - Không tìm thấy trang');
        }

        [$relativeFile, $className, $method] = $this->routes[$page];
        $file = $this->appDirectory . '/' . ltrim($relativeFile, '/');

        // Ngăn route cấu hình nhầm trỏ ra ngoài thư mục app/.
        $realApp = realpath($this->appDirectory);
        $realFile = realpath($file);
        if ($realApp === false || $realFile === false || !str_starts_with($realFile, $realApp . DIRECTORY_SEPARATOR) || !is_file($realFile)) {
            http_response_code(500);
            exit('Cấu hình route không hợp lệ.');
        }

        require_once __DIR__ . '/BaseController.php';
        require_once $realFile;

        if (!class_exists($className) || !method_exists($className, $method)) {
            http_response_code(500);
            exit('Controller hoặc action chưa được định nghĩa.');
        }

        $controller = new $className();
        if (!is_callable([$controller, $method])) {
            http_response_code(500);
            exit('Action không thể được gọi.');
        }

        $controller->$method();
    }
}
