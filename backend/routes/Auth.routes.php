<?php
    require_once __DIR__ . '/../controllers/AuthController.php';

    function registerAuthRoutes($method, $uri) {
        if ($method === 'POST' && $uri === '/proyecto-php-ad2025/backend/api/login') {
            AuthController::login();
        }
    }