<?php

require_once(__DIR__ . '/../librerias/libs/Smarty.class.php');

class View {
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = new Smarty();

        // ✅ Ruta corregida para cargar plantillas desde /vista
        $this->smarty->setTemplateDir(__DIR__ . '/../vista/');
        $this->smarty->setCompileDir(__DIR__ . '/../vista/templates_c/');

        // ✅ Desactivar caché para ver cambios al instante
        $this->smarty->setCaching(false);
    }

    public function render(string $template, array $data = []): void {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->display($template);
    }
}
