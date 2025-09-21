<?php

class RutaView extends View
{
    public function solicitarDatos(): array
    {
        $nombre = $this->getInput("Nombre de la ruta:");
        $distancia = $this->getInput("Distancia en km:");
        $nota = $this->getInput("Nota (opcional):");

        return compact('nombre', 'distancia', 'nota');
    }

    public function mostrarResumen(Ruta $ruta): void
    {
        echo "\n\033[1;32mRuta registrada exitosamente:\033[0m\n";
        echo $ruta;
    }

   public function mostrarRutas(array $rutas): void
{
    if (empty($rutas)) {
        $this->mostrar("\033[1;31m⚠️ No hay rutas registradas.\033[0m\n");
        return;
    }

    $this->mostrar("\n\033[1;35m🛣️ Listado de Rutas:\033[0m\n");
    printf("\033[1m%-4s | %-20s | %-10s | %-30s\033[0m\n", "ID", "Nombre", "Distancia", "Nota");
    echo str_repeat("-", 70) . "\n";

    foreach ($rutas as $ruta) {
        $nota = $ruta->getNota() ?? "Sin nota";
        $notaAzul = "\033[1;34m{$nota}\033[0m";

        printf(
            "%-4d | %-20s | %-10s | %-30s\n",
            $ruta->getId(),
            $ruta->getNombre(),
            $ruta->getDistancia() . " km",
            $notaAzul
        );
    }

    echo str_repeat("-", 70) . "\n";
}
}
