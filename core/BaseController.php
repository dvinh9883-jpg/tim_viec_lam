<?php
/** Lớp nền tùy chọn cho các Controller trong ứng dụng. */
namespace Core;

abstract class BaseController
{
    /**
     * Render một file trong app/view/.
     * Ví dụ: $this->view('home', ['jobs' => $jobs]);
     */
    protected function view(string $view, array $data = []): void
    {
        // Chỉ cho phép tên view dạng đường dẫn tương đối đơn giản.
        if ($view === '' || str_contains($view, '..') || str_starts_with($view, '/') || str_contains($view, "\\")) {
            throw new \InvalidArgumentException('Tên View không hợp lệ.');
        }

        $viewPath = dirname(__DIR__) . '/app/view/' . $view . '.php';
        if (!is_file($viewPath)) {
            http_response_code(500);
            throw new \RuntimeException('Không tìm thấy View: ' . $view);
        }

        extract($data, EXTR_SKIP);
        require $viewPath;
    }

    /** Chuyển hướng và kết thúc request. */
    protected function redirect(string $url): never
    {
        header('Location: ' . $url);
        exit;
    }

    /** Lấy dữ liệu POST an toàn kiểu chuỗi; không thay thế việc validate nghiệp vụ. */
    protected function post(string $key, string $default = ''): string
    {
        $value = $_POST[$key] ?? $default;
        return is_string($value) ? $value : $default;
    }
}
