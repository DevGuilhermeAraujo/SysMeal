<?php
namespace template;

use template\ITemplate;

class InstituicaoTemplate implements ITemplate {
    
    // Método genérico para renderizar qualquer view
    private function renderLayout($viewPath, $data = []) {
        extract($data);
        ob_start();
        include 'public/includes/header.php';
        include $viewPath;
        include 'public/includes/footer.php';
        echo ob_get_clean();
    }

    // Renderiza views dentro de /public/instituicao/
    public function render($view, $data = []) {
        $this->renderLayout("public/instituicao/{$view}.php", $data);
    }
    
    public function listar($instituicoes) {
        $this->render('listar', [
            'instituicoes' => $instituicoes,
            'titulo' => 'Lista de Instituições'
        ]);
    }
    
    public function formulario($dados = [], $erro = null, $edicao = false, $id = null) {
        $this->render('formulario', [
            'dados' => $dados,
            'erro' => $erro,
            'edicao' => $edicao,
            'id' => $id,
            'titulo' => $edicao ? 'Editar Instituição' : 'Nova Instituição'
        ]);
    }
    
    public function detalhes($instituicao) {
        $this->render('detalhes', [
            'instituicao' => $instituicao,
            'titulo' => 'Detalhes da Instituição'
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
