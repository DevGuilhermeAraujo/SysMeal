<?php
namespace template;

use template\ITemplate;

class DoadorTemplate implements ITemplate {
    
    // Método genérico para renderizar qualquer view
    private function renderLayout($viewPath, $data = []) {
        extract($data);
        ob_start();
        include 'public/includes/header.php';
        include $viewPath;
        include 'public/includes/footer.php';
        echo ob_get_clean();
    }

    // Renderiza views dentro de /public/doador/
    public function render($view, $data = []) {
        $this->renderLayout("public/doador/{$view}.php", $data);
    }
    
    public function listar($doadores) {
        $this->render('listar', [
            'doadores' => $doadores,
            'titulo' => 'Lista de Doadores'
        ]);
    }
    
    public function formulario($dados = [], $erro = null, $edicao = false, $id = null) {
        $this->render('formulario', [
            'dados' => $dados,
            'erro' => $erro,
            'edicao' => $edicao,
            'id' => $id,
            'titulo' => $edicao ? 'Editar Doador' : 'Novo Doador'
        ]);
    }
    
    public function detalhes($doador) {
        $this->render('detalhes', [
            'doador' => $doador,
            'titulo' => 'Detalhes do Doador'
        ]);
    }
    
    // Usa o erro padrão de includes
    public function erro($mensagem) {
        $this->renderLayout('public/includes/erro.php', [
            'erro' => $mensagem,
            'titulo' => 'Erro'
        ]);
    }
}
?>
