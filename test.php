<?php
echo "¡El navegador funciona!";
function imprimirErrorHTML(string $mensaje): void {
    echo "<p style='color: red; font-weight: bold;'>❌ ERROR: " . htmlspecialchars($mensaje) . "</p>";
}
