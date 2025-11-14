<?php
/* Smarty version 3.1.48, created on 2025-11-13 20:09:22
  from '/opt/lampp/htdocs/transporte/vista/servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69162ce2d18005_75418887',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83e1b4863e84f2f96136cd5d1b59cf92e59c94e2' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/servicios.tpl',
      1 => 1761632595,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69162ce2d18005_75418887 (Smarty_Internal_Template $_smarty_tpl) {
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
