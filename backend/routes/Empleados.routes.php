<?php
    require_once __DIR__ . '/../controllers/AuthController.php';

    function registerEmpleadoRoutes($method, $uri) {
        if ($method === 'GET' && $uri === '/proyecto-php-ad2025/backend/api/empleados') {
            EmpleadoController::getAll();
        }
        if ($method === 'POST' && $uri === '/proyecto-php-ad2025/backend/api/empleados') {
            EmpleadoController::create();
        }
        // api/empleado/6
        if ($method === 'PUT' && preg_match('#^//proyecto-php-ad2025/backend/api/empleados/(\d+)$#', $uri, $m)) {
            $id = $m[1];
            EmpleadoController::update($id);
        }
        if ($method === 'DELETE' && preg_match('#^//proyecto-php-ad2025/backend/api/empleados/(\d+)$#', $uri, $m)) {
            $id = $m[1];
            EmpleadoController::delete($id);
        }
    }