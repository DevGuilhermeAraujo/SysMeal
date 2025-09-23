<?php
namespace template;

use template\ITemplate;

class HomeTemplate implements ITemplate {

    // Método genérico para renderizar qualquer view
    private function renderLayout($viewPath, $data = []) {
        extract($data);
        ob_start();
        include 'public/includes/header.php';
        include $viewPath;
        include 'public/includes/footer.php';
        echo ob_get_clean();
    }

    // Renderiza uma view normal dentro de home/
    public function render($view, $data = []) {
        $this->renderLayout("public/home/{$view}.php", $data);
    }

    public function dashboard($stats) {
        $this->render('dashboard', [
            'stats' => $stats,
            'titulo' => 'Dashboard',
            'hide_hero' => false
        ]);
    }

    public function erro($mensagem) {
        $this->renderLayout('public/includes/erro.php', [
            'erro' => $mensagem,
            'titulo' => 'Erro'
        ]);
    }
}
?>
