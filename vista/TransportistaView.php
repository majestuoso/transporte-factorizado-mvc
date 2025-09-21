<?php

require_once(__DIR__ . '/View.php');

class TransportistaView extends View
{
    public function solicitarDatos(): array
    {
        $nombre = $this->getInput("Nombre:");
        $apellido = $this->getInput("Apellido:");
        $vehiculo = $this->getInput("Vehículo:");
        $disponible = $this->getInput("¿Está disponible? (1 = Sí, 0 = No):");
        $nota = $this->getInput("Nota (opcional):");

        return [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'vehiculo' => $vehiculo,
            'disponible' => $disponible === '1',
            'nota' => $nota
        ];
    }

    public function mostrarResumen(Transportista $t): void
    {
        echo "\n\033[1;32mTransportista registrado exitosamente:\033[0m\n";
        echo $t;
    }

   public function mostrarTransportistas(array $transportistas): void
{
    echo "\n\033[1;36m📋 Listado de Transportistas:\033[0m\n";
    printf("\033[1m🧍 %-4s | 👤 %-20s | 🚚 %-20s | 🔄 %-6s | ✅ %-6s | 🗒️ %-30s\033[0m\n", "ID", "Nombre", "Vehículo", "Turno", "Disp.", "Nota");
    echo str_repeat("-", 110) . "\n";

    foreach ($transportistas as $t) {
        printf(
            "🧍 %-4d | 👤 %-20s | 🚚 %-20s | 🔄 %-6d | %s | 🗒️ %-30s\n",
            $t->getId(),
            $t->getNombre() . ' ' . $t->getApellido(),
            ucfirst($t->getVehiculo()),
            $t->getTurno(),
            $t->isDisponible() ? "✅ Sí " : "❌ No ",
            $this->iconoNota($t->getNota())
        );
    }

    echo str_repeat("-", 110) . "\n";
}

private function iconoNota(?string $nota): string
{
    if (!$nota) return "Sin nota";

    $texto = strtolower($nota);
    if (str_contains($texto, 'peligros')) return "☣️ $nota";
    if (str_contains($texto, 'urgente')) return "⚡ $nota";
    if (str_contains($texto, 'curva') || str_contains($texto, 'novato')) return "⚠️ $nota";

    return $nota;

}
}
