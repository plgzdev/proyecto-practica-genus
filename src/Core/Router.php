<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class Router
{
    /** @var array<string, array<string, string|callable>> */
    private array $routes = [];

    public function get(string $path, string|callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, string|callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, string|callable $handler): void
    {
        $normalizedPath = $this->normalizePath($path);
        $this->routes[$method][$normalizedPath] = $handler;
    }

    private function normalizePath(string $path): string
    {
        $trimmed = trim($path, '/');
        return $trimmed === '' ? '/' : '/' . $trimmed;
    }

    public function dispatch(string $method, string $uri): void
    {
        $rawPath = parse_url($uri, PHP_URL_PATH);
        $path = $this->normalizePath(is_string($rawPath) ? $rawPath : '/');
        $httpMethod = strtoupper($method);

        $handler = $this->routes[$httpMethod][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo '404 - Página no encontrada';
            return;
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            [$file, $action] = explode('@', $handler, 2);
            $controllerPath = dirname(__DIR__) . "/Controllers/{$file}.php";

            if (!file_exists($controllerPath)) {
                throw new RuntimeException("Archivo controlador no encontrado: {$file}.php");
            }

            require_once $controllerPath;

            if (!function_exists($action)) {
                throw new RuntimeException("Función controladora no encontrada: {$action}()");
            }

            $action();
            return;
        }

        if (is_callable($handler)) {
            $handler();
        }
    }
}