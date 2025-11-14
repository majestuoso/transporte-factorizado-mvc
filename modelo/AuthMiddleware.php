<?php
declare(strict_types=1);

class AuthMiddleware {
    public static function verificar(): void
    {
        session_start();

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            session_destroy();
            header('Location: index.php?path=inicio');
            exit();
        }
    }
}
