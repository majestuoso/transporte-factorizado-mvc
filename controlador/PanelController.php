<?php

require_once(__DIR__ . '/../vista/View.php');

class PanelController
{
    public function cliente(): void
    {
        session_start();
        if ($_SESSION['rol'] !== 'cliente') {
            die("Acceso denegado");
        }

        $view = new View();
        $view->render('panel_cliente.tpl', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    public function personal(): void
    {
        session_start();
        if ($_SESSION['rol'] !== 'personal') {
            die("Acceso denegado");
        }

        // ✅ Detectar si hay una subvista solicitada
        $seccion = $_GET['seccion'] ?? null;
        $accion = $_GET['accion'] ?? null;

        $subvista = null;
        if ($seccion && $accion) {
            $subvista = "{$seccion}/{$accion}.tpl";
        }

        $view = new View();
        $view->render('panel_personal.tpl', [
            'usuario' => $_SESSION['usuario'],
            'subvista' => $subvista,
            'seccion' => $seccion
        ]);
    }

    public function servicios(): void
    {
        $view = new View();
        $view->render('servicios.tpl');
    }

    public function nosotros(): void
    {
        $view = new View();
        $view->render('nosotros.tpl');
    }

    public function noticias(): void
    {
        $view = new View();
        $view->render('noticias.tpl');
    }

    public function contacto(): void
    {
        $view = new View();
        $view->render('contacto.tpl');
    }

    public function registro(): void
    {
        $view = new View();
        $view->render('registro.tpl');
    }
}
