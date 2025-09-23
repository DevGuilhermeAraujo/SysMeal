<?php

namespace template;

use template\ITemplate;

class DoacaoTemplate implements ITemplate
{

    // Método genérico para renderizar qualquer view
    private function renderLayout($viewPath, $data = [])
    {
        extract($data);
        ob_start();
        include 'public/includes/header.php';
        include $viewPath;
        include 'public/includes/footer.php';
        echo ob_get_clean();
    }

    // Renderiza views dentro de /public/doacao/
    public function render($view, $data = [])
    {
        $this->renderLayout("public/doacao/{$view}.php", $data);
    }

    public function listar($doacoesSemInstituicao, $doacoesComInstituicao)
    {
        $this->render('listar', [
            'doacoesSemInstituicao' => $doacoesSemInstituicao,
            'doacoesComInstituicao' => $doacoesComInstituicao,
            'titulo' => 'Lista de Doações'
        ]);
    }


    public function formulario($dados = [], $erro = null, $edicao = false, $id = null, $doadores = [], $instituicoes = [], $solicitar = false)
    {
        $this->render('formulario', [
            'dados' => $dados,
            'erro' => $erro,
            'edicao' => $edicao,
            'id' => $id,
            'doadores' => $doadores,
            'instituicoes' => $instituicoes,
            'solicitar' => $solicitar, // adiciona a variável
            'titulo' => $edicao ? 'Editar Doação' : ($solicitar ? 'Solicitar Doação' : 'Nova Doação')
        ]);
    }


    public function detalhes($doacao)
    {
        $this->render('detalhes', [
            'doacao' => $doacao,
            'titulo' => 'Detalhes do Doação'
        ]);
    }

    // Usa o erro padrão de includes
    public function erro($mensagem)
    {
        $this->renderLayout('public/includes/erro.php', [
            'erro' => $mensagem,
            'titulo' => 'Erro'
        ]);
    }
}
