<?php

class View
{
    public function getInput(string $mensaje): string
    {
        echo "\n\033[1;36m$mensaje\033[0m ";
        return trim(fgets(STDIN));
    }

    public function showMessage(string $message): void
    {
        echo "\n\033[1;31m$message\033[0m\n"; // rojo: error o alerta
    }

    public function showSuccess(string $message): void
    {
        echo "\n\033[1;32m$message\033[0m\n"; // verde: éxito
    }

    public function showInfo(string $message): void
    {
        echo "\n\033[1;34m$message\033[0m\n"; // azul: informativo
    }

    public function showWarning(string $message): void
    {
        echo "\n\033[1;33m⚠️ $message\033[0m\n"; // amarillo: advertencia
    }

   public function mostrar(string $texto): void
    {
        echo $texto;
    }
}


