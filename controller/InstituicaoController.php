<?php

namespace controller;

use Exception;
use service\InstituicaoService;
use template\InstituicaoTemplate;

class InstituicaoController
{
    private InstituicaoService $instituicaoService;
    private InstituicaoTemplate $instituicaoTemplate;

    public function __construct()
    {
        $this->instituicaoService = new InstituicaoService();
        $this->instituicaoTemplate = new InstituicaoTemplate();
    }

    // Página inicial - lista todos as instituições
    public function index()
    {
        $this->listar();
    }

    // Listar todos as instituições
    public function listar()
    {
        try {
            $instituicoes = $this->instituicaoService->listarTodos();
            $this->instituicaoTemplate->listar($instituicoes);
        } catch (Exception $e) {
            $this->instituicaoTemplate->erro($e->getMessage());
        }
    }

    // Exibir formulário de cadastro
    public function novo()
    {
        $this->instituicaoTemplate->formulario();
    }

    // Processar cadastro de nova instituição
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /instituicao/novo');
            exit;
        }

        try {
            $instituicao = $this->instituicaoService->criarInstituicao($_POST);
            print_r($instituicao);

            // Redirecionar com sucesso
            $_SESSION['sucesso'] = 'Instituição cadastrada com sucesso!';
            header('Location: /sysmeal/instituicao/listar');
            exit;
        } catch (Exception $e) {
            // Exibir formulário com erro
            $this->instituicaoTemplate->formulario($_POST, $e->getMessage());
        }
    }

    // Exibir detalhes de uma instituição
    public function ver()
    {
        $id = $this->getId();

        try {
            $instituicao = $this->instituicaoService->buscarPorId($id);
            $this->instituicaoTemplate->detalhes($instituicao);
        } catch (Exception $e) {
            $this->instituicaoTemplate->erro($e->getMessage());
        }
    }

    // Exibir formulário de edição
    public function editar()
    {
        $id = $this->getId();

        try {
            $instituicao = $this->instituicaoService->buscarPorId($id);
            $this->instituicaoTemplate->formulario($instituicao->toArray(), null, true);
        } catch (Exception $e) {
            $this->instituicaoTemplate->erro($e->getMessage());
        }
    }

    // Processar atualização de instituição
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /instituicao/listar');
            exit;
        }

        $id = $this->getId();

        try {
            $instituicao = $this->instituicaoService->atualizarInstituicao($id, $_POST);

            $_SESSION['sucesso'] = 'Instituição atualizada com sucesso!';
            header('Location: /sysmeal/instituicao/listar/' . $instituicao->getId());
            exit;
        } catch (Exception $e) {
            $this->instituicaoTemplate->formulario($_POST, $e->getMessage(), true, $id);
        }
    }

    // Excluir instituição
    public function excluir()
    {
        $id = $this->getId();

        try {
            $this->instituicaoService->excluirInstituicao($id);

            $_SESSION['sucesso'] = 'Instituição excluída com sucesso!';
            header('Location: /sysmeal/instituicao/listar');
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = $e->getMessage();
            header('Location: /sysmeal/instituicao/ver/' . $id);
            exit;
        }
    }

    // Método auxiliar para pegar ID da URL
    private function getId() {
        if (!isset($_GET['param'])) {
            throw new Exception("Parâmetro não fornecido");
        }
    
        $parts = explode('/', $_GET['param']); // ["doador", "excluir", "2"]
    
        if (isset($parts[2]) && is_numeric($parts[2])) {
            return (int)$parts[2];
        }
    
        throw new Exception("ID não fornecido ou inválido");
    }    
}
