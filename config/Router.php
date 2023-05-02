<?php

namespace config;

class Router
{
    const GET    = 'GET';
    const POST   = 'POST';
    const DELETE = 'DELETE';
    const PATCH  = 'PATCH';
    const PUT    = 'PUT';

    protected $routes = [];
    protected $methodMap = [
        self::GET    => 'get',
        self::POST   => 'post',
        self::DELETE => 'delete',
        self::PATCH  => 'patch',
        self::PUT    => 'put',
    ];

    public function add(string $method, string $uri, string $controller): self
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => $method,
            'middleware' => [],
        ];

        return $this;
    }

    public function get(string $uri, string $controller): self
    {
        return $this->add(self::GET, $uri, $controller);
    }

    public function post(string $uri, string $controller): self
    {
        return $this->add(self::POST, $uri, $controller);
    }

    public function delete(string $uri, string $controller): self
    {
        return $this->add(self::DELETE, $uri, $controller);
    }

    public function patch(string $uri, string $controller): self
    {
        return $this->add(self::PATCH, $uri, $controller);
    }

    public function put(string $uri, string $controller): self
    {
        return $this->add(self::PUT, $uri, $controller);
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route(string $uri, string $method)
    {
        $route = $this->findRoute($uri, $method);

        if ($route) {
            $this->resolveMiddleware($route);
            $this->loadController($route['controller']);
        } else {
            $this->abort();
        }
    }

    protected function findRoute(string $uri, string $method): ?array
    {
        $method = strtoupper($method);
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                return $route;
            }
        }
        return null;
    }

    protected function resolveMiddleware(array $route): void
    {
        foreach ($route['middleware'] as $middleware) {
            Middleware::resolve($middleware);
        }
    }

    protected function loadController(string $controller): void
    {
        require_once base_path('Http/controllers/' . $controller);
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
