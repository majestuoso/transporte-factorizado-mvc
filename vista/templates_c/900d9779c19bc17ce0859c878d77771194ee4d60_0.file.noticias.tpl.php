<?php
/* Smarty version 3.1.48, created on 2025-10-22 14:58:22
  from '/opt/lampp/htdocs/transporte_refactorizado/vista/noticias.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68f8d4ee0a5d26_70696583',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '900d9779c19bc17ce0859c878d77771194ee4d60' => 
    array (
      0 => '/opt/lampp/htdocs/transporte_refactorizado/vista/noticias.tpl',
      1 => 1761135357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f8d4ee0a5d26_70696583 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
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
  <h2 class="text-warning">Noticias</h2>
  <p>Próximamente: integración con mapas y seguimiento en tiempo real.</p>

  <div class="text-center mt-4">
    <a href="?path=inicio" class="btn btn-outline-warning">⬅ Volver al inicio</a>
  </div>
</div>
<?php }
}
