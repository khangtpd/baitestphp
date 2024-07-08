<?php
class App
{
    private $router;

    function __construct()
    {
        $this->router = new Router();
        $this->initializeRoutes();
    }

    private function initializeRoutes()
    {
        require_once './app/routes/web.php';
    }

    public function run()
    {
        $url = dirname($_SERVER['SCRIPT_NAME']);
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        // Remove "todo-list" prefix from URI
        $uri = preg_replace('/^' . trim($url, '/') . '\//', '', $uri);

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($uri, $requestMethod);
    }

    public function getRouter()
    {
        return $this->router;
    }
}
