<?php
class Router {
    private array $routes = [];

    /**
     * Registra una ruta con su controlador y método
     */
    public function add(string $path, string $controller, string $method = 'index'): void {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * Ejecuta la ruta solicitada
     */
    public function dispatch(string $uri): void {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
        $segments = explode('/', $uri);

        foreach ($this->routes as $route => $handler) {
            $routeSegments = explode('/', $route);

            if (count($segments) === count($routeSegments)) {
                $params = [];
                $matched = true;

                for ($i = 0; $i < count($segments); $i++) {
                    if ($routeSegments[$i] === $segments[$i]) {
                        continue;
                    } elseif (str_starts_with($routeSegments[$i], ':')) {
                        $paramName = ltrim($routeSegments[$i], ':');
                        $params[$paramName] = $segments[$i];
                    } else {
                        $matched = false;
                        break;
                    }
                }

                if ($matched) {
                    $controllerFile = __DIR__ . '/../controlador/' . $handler['controller'] . '.php';
                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
                        $controller = new $handler['controller']();
                        $method = $handler['method'];
                        if (method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], $params);
                            return;
                        } else {
                            http_response_code(500);
                            echo "Método '{$method}' no existe en {$handler['controller']}";
                            return;
                        }
                    } else {
                        http_response_code(500);
                        echo "Controlador '{$handler['controller']}' no encontrado";
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo "Ruta no encontrada: $uri";
    }
}
