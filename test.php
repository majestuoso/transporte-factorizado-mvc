<?php
//echo "¡El navegador funciona!";
//function imprimirErrorHTML(string $mensaje): void {
   // echo "<p style='color: red; font-weight: bold;'>❌ ERROR: " . htmlspecialchars($mensaje) . "</p>";
//}

require_once(__DIR__ . '/librerias/libs/Smarty.class.php');

$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/vista/templates/');
$smarty->setCompileDir(__DIR__ . '/vista/templates_c/');
$smarty->setCacheDir(__DIR__ . '/vista/cache/');
$smarty->setConfigDir(__DIR__ . '/vista/configs/');

$smarty->assign('titulo', '¡Smarty funciona!');
$smarty->assign('mensaje', 'Tu instalación está lista para usar.');

$smarty->display('test.tpl');
