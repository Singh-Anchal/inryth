<?php
declare(strict_types=1);

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$file = __DIR__ . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

$try = [
    __DIR__ . $uri . '.php',
    __DIR__ . rtrim($uri, '/') . '.php',
];

foreach ($try as $php) {
    if (is_file($php)) {
        require $php;
        return true;
    }
}

if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    return true;
}

http_response_code(404);
require __DIR__ . '/404.php';
return true;
