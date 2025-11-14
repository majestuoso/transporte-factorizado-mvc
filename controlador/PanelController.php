<?php

class PanelController
{
    public function personal(): void
    {
        session_start();
        if ($_SESSION['rol'] !== 'personal') {
            die("Acceso denegado");
        }

        $seccion = $_GET['seccion'] ?? null;
        $accion  = $_GET['accion'] ?? null;

        $subvista = null;
        if ($seccion && $accion) {
            $subvista = "{$seccion}/{$accion}.tpl";
        }

        $view = new View();
        $view->render('panel_personal.tpl', [
            'usuario'  => $_SESSION['usuario'],
            'subvista' => $subvista,
            'seccion'  => $seccion
        ]);
    }

   public function transportista(): void
{
    session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'transportista') {
        header("Location: ?path=inicio");
        exit;
    }

    // Buscar datos del transportista logueado
    $transportistaModel = new TransportistaModel();
    // Podés buscar por usuario o por nombre según lo que guardes en sesión
    $datos = $transportistaModel->buscarPorUsuario($_SESSION['usuario']);

    // Buscar viajes recientes del transportista
    $viajeModel = new ViajeModel();
    $viajes = $viajeModel->listarPorTransportista($datos->getId());

    $view = new View();
    $view->render('panel_transportista.tpl', [
        'usuario' => $_SESSION['usuario'],
        'nombre'  => $_SESSION['nombre'] ?? '',
        'datos'   => $datos,
        'viajes'  => $viajes
    ]);
}



    // Páginas estáticas
    public function servicios(): void { (new View())->render('servicios.tpl'); }
    public function nosotros(): void { (new View())->render('nosotros.tpl'); }
    public function noticias(): void { (new View())->render('noticias.tpl'); }
    public function contacto(): void { (new View())->render('contacto.tpl'); }
    public function registro(): void { (new View())->render('registro.tpl'); }
}
