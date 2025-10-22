<?php
/* Smarty version 3.1.48, created on 2025-10-22 14:54:20
  from '/opt/lampp/htdocs/transporte_refactorizado/vista/servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68f8d3fc375e14_03024129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04b3d74037a91b23b529299fd76f0e20cad6ba4b' => 
    array (
      0 => '/opt/lampp/htdocs/transporte_refactorizado/vista/servicios.tpl',
      1 => 1761135339,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f8d3fc375e14_03024129 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="?path=inicio">🚍 Transporte</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="?path=servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="?path=nosotros">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="?path=noticias">Noticias</a></li>
        <li class="nav-item"><a class="nav-link" href="?path=contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">
  <h2 class="text-success">Nuestros Servicios</h2>
  <ul class="list-group">
    <li class="list-group-item">Gestión de rutas y viajes</li>
    <li class="list-group-item">Registro de transportistas</li>
    <li class="list-group-item">Panel administrativo</li>
    <li class="list-group-item">Consultas y reportes</li>
  </ul>

  <div class="text-center mt-4">
    <a href="?path=inicio" class="btn btn-outline-success">⬅ Volver al inicio</a>
  </div>
</div>
<?php }
}
