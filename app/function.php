<?php
require_once __DIR__ . '/database.php';
function e($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}
function flash(?string $type = null, ?string $message = null): ?array
{
    if ($type && $message) {
        $_SESSION['flash'] = [$type, $message];
        return null;
    }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}
function user(): ?array
{
    return $_SESSION['user'] ?? null;
}
function require_login(): void
{
    if (!user()) redirect('index.php?page=login');
}
function require_role(string $role): void
{
    require_login();
    if ((user()['role'] ?? '') !== $role) redirect('index.php');
}
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function verify_csrf(): void
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        exit('CSRF token không hợp lệ.');
    }
}
function old(string $key, string $default = ''): string
{
    return e($_POST[$key] ?? $default);
}
