<?php

namespace controller;

use Exception;
use service\DoacaoService;
use template\DoacaoTemplate;

class DoacaoController
{
    private DoacaoService $doacaoService;
    private DoacaoTemplate $doacaoTemplate;

    public function __construct()
    {
        $this->doacaoService = new DoacaoService();
        $this->doacaoTemplate = new DoacaoTemplate();
    }

    // Página inicial - lista todos as doações
    public function index()
    {
        $this->listar();
    }

    // Listar todos as doações
    public function listar()
    {
        try {
            $doacoesSemInstituicao = $this->doacaoService->listarSemInstituicao();
            $doacoesComInstituicao = $this->doacaoService->listarComInstituicao();

            $this->doacaoTemplate->listar($doacoesSemInstituicao, $doacoesComInstituicao);
        } catch (Exception $e) {
            $this->doacaoTemplate->erro($e->getMessage());
        }
    }

    // Exibir formulário de cadastro
    public function novo()
    {
        $doadores = (new \service\DoadorService())->listarTodos();

        $this->doacaoTemplate->formulario([], null, false, null, $doadores);
    }


    // Processar cadastro de uma nova doação
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /doacao/novo');
            exit;
        }

        try {
            $doacao = $this->doacaoService->criarDoacao($_POST);
            print_r($doacao);

            // Redirecionar com sucesso
            $_SESSION['sucesso'] = 'Doação efetuada com sucesso!';
            header('Location: /sysmeal/doacao/listar');
            exit;
        } catch (Exception $e) {
            // Exibir formulário com erro
            $this->doacaoTemplate->formulario($_POST, $e->getMessage());
        }
    }

    // Exibir detalhes de uma doação
    public function ver()
    {
        $id = $this->getId();

        try {
            $doacao = $this->doacaoService->buscarPorId($id);
            $this->doacaoTemplate->detalhes($doacao);
        } catch (Exception $e) {
            $this->doacaoTemplate->erro($e->getMessage());
        }
    }

    public function solicitar($id)
    {
        try {
            // Buscar a doação pelo ID
            $doacao = $this->doacaoService->buscarPorId($id);

            // Buscar todas as instituições para popular o select
            $instituicoes = (new \service\InstituicaoService())->listarTodos();

            // Reaproveita o formulário passando $solicitar = true
            $this->doacaoTemplate->formulario(
                $doacao->toArray(), // dados da doação
                null,               // nenhum erro inicial
                false,              // não é edição completa, só solicitar
                $id,                // id da doação
                [],                 // doadores vazios
                $instituicoes,      // instituições para o select
                true                // parâmetro $solicitar
            );
        } catch (Exception $e) {
            $this->doacaoTemplate->erro($e->getMessage());
        }
    }

    public function confirmarSolicitacao($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sysmeal/doacao/listar');
            exit;
        }

        try {
            $instituicaoId = $_POST['instituicao_id'] ?? null;
            if (!$instituicaoId) {
                throw new \Exception("Selecione uma instituição.");
            }

            $this->doacaoService->solicitarDoacao($id, $instituicaoId);

            $_SESSION['sucesso'] = "Solicitação de doação realizada com sucesso!";
            header('Location: /sysmeal/doacao/listar');
            exit;
        } catch (\Exception $e) {
            // Reexibir formulário com erro
            $doacao = $this->doacaoService->buscarPorId($id);
            $instituicoes = (new \service\InstituicaoService())->listarTodos();

            $this->doacaoTemplate->formulario(
                $doacao->toArray(),
                $e->getMessage(),
                false,
                $id,
                [],
                $instituicoes,
                true
            );
        }
    }

    // Exibir formulário de edição
    public function editar()
    {
        $id = $this->getId();
        try {
            $doacao = $this->doacaoService->buscarPorId($id);

            $doadores = (new \service\DoadorService())->listarTodos();
            $instituicoes = (new \service\InstituicaoService())->listarTodos();

            $this->doacaoTemplate->formulario($doacao->toArray(), null, true, $id, $doadores, $instituicoes);
        } catch (Exception $e) {
            $this->doacaoTemplate->erro($e->getMessage());
        }
    }

    // Processar atualização de doador
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /doacao/listar');
            exit;
        }

        $id = $this->getId();

        try {
            $doacao = $this->doacaoService->atualizarDoacao($id, $_POST);

            $_SESSION['sucesso'] = 'Doação atualizada com sucesso!';
            header('Location: /sysmeal/doacao/listar/' . $doacao->getId());
            exit;
        } catch (Exception $e) {
            $this->doacaoTemplate->formulario($_POST, $e->getMessage(), true, $id);
        }
    }

    // Excluir doador
    public function excluir()
    {
        $id = $this->getId();

        try {
            $this->doacaoService->excluirDoacao($id);

            $_SESSION['sucesso'] = 'Doação excluída com sucesso!';
            header('Location: /sysmeal/doacao/listar');
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = $e->getMessage();
            header('Location: /sysmeal/doacao/ver/' . $id);
            exit;
        }
    }

    // Método auxiliar para solicitar ID da URL
    private function getId()
    {
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
