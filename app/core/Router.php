<?php

class Router
{
    private $routes = [];
    private $namedRoutes = [];

    public function get($route, $controllerAction, $name = null)
    {
        $this->addRoute('GET', $route, $controllerAction, $name);
    }

    public function post($route, $controllerAction, $name = null)
    {
        $this->addRoute('POST', $route, $controllerAction, $name);
    }

    public function patch($route, $controllerAction, $name = null)
    {
        $this->addRoute('POST', $route, $controllerAction, $name);
    }

    public function delete($route, $controllerAction, $name = null)
    {
        $this->addRoute('POST', $route, $controllerAction, $name);
    }

    private function addRoute($method, $route, $controllerAction, $name = null)
    {
        $regexRoute = $this->convertRouteToRegex($route);
        $this->routes[] = [
            'method' => $method,
            'route' => $regexRoute,
            'controllerAction' => $controllerAction,
            'name' => $name
        ];

        if ($name) {
            $this->namedRoutes[$name] = [
                'method' => $method,
                'route' => $route,
                'controllerAction' => $controllerAction
            ];
        }
    }

    private function convertRouteToRegex($route)
    {
        $pattern = preg_replace('/\{id\}|\d+/', '\d+', $route);
        $pattern = str_replace('/', '\/', $pattern);
        return '/' . $pattern . '/';
    }

    public function dispatch($uri, $requestMethod)
    {
        foreach ($this->routes as $route) {
            if ($requestMethod == $route['method'] && $route['route'] == $this->convertRouteToRegex($uri) && preg_match($route['route'], $uri, $matches)) {
                $params = [];

                if (isset($matches[0])) {
                    $urlProcess = explode("/", filter_var(trim($matches[0], "/")));

                    foreach ($urlProcess as $value) {
                        if (is_numeric($value)) {
                            $params[] = $value;
                        }
                    }
                }


                list($controller, $action) = explode('@', $route['controllerAction']);
                require_once "./app/controllers/" . $controller . ".php";
                $controllerInstance = new $controller($this);

                if (method_exists($controllerInstance, $action)) {
                    return call_user_func_array([$controllerInstance, $action], $params);
                }
            }
        }

        http_response_code(404);
        echo "Page not found.";
    }

    private function getMainUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $mainUrl = $protocol . $host . dirname($_SERVER['SCRIPT_NAME']);

        return rtrim($mainUrl, '/');
    }

    public function route($name, $id = '')
    {
        if (!empty($this->namedRoutes) && isset($this->namedRoutes[$name])) {
            $routeUrl = $this->namedRoutes[$name]['route'];
            $mainUrl = $this->getMainUrl() . '/';

            if ($id) {
                $convertUrlId = basename(trim($routeUrl, '/'));

                return $mainUrl . str_replace($convertUrlId, $id, $routeUrl) ?? null;
            } else {
                return $mainUrl . $routeUrl ?? null;
            }
        }

        return null;
    }
}
