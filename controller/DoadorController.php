<?php

namespace controller;

use Exception;
use service\DoadorService;
use template\DoadorTemplate;

class DoadorController
{
    private DoadorService $doadorService;
    private DoadorTemplate $doadorTemplate;

    public function __construct()
    {
        $this->doadorService = new DoadorService();
        $this->doadorTemplate = new DoadorTemplate();
    }

    // Página inicial - lista todos os doadores
    public function index()
    {
        $this->listar();
    }

    // Listar todos os doadores
    public function listar()
    {
        try {
            $doadores = $this->doadorService->listarTodos();
            $this->doadorTemplate->listar($doadores);
        } catch (Exception $e) {
            $this->doadorTemplate->erro($e->getMessage());
        }
    }

    // Exibir formulário de cadastro
    public function novo()
    {
        $this->doadorTemplate->formulario();
    }

    // Processar cadastro de novo doador
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /doador/novo');
            exit;
        }

        try {
            $doador = $this->doadorService->criarDoador($_POST);
            print_r($doador);

            // Redirecionar com sucesso
            $_SESSION['sucesso'] = 'Doador cadastrado com sucesso!';
            header('Location: /sysmeal/doador/listar');
            exit;
        } catch (Exception $e) {
            // Exibir formulário com erro
            $this->doadorTemplate->formulario($_POST, $e->getMessage());
        }
    }

    // Exibir detalhes de um doador
    public function ver()
    {
        $id = $this->getId();

        try {
            $doador = $this->doadorService->buscarPorId($id);
            $this->doadorTemplate->detalhes($doador);
        } catch (Exception $e) {
            $this->doadorTemplate->erro($e->getMessage());
        }
    }

    // Exibir formulário de edição
    public function editar()
    {
        $id = $this->getId();

        try {
            $doador = $this->doadorService->buscarPorId($id);
            $this->doadorTemplate->formulario($doador->toArray(), null, true);
        } catch (Exception $e) {
            $this->doadorTemplate->erro($e->getMessage());
        }
    }

    // Processar atualização de doador
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /doador/listar');
            exit;
        }

        $id = $this->getId();

        try {
            $doador = $this->doadorService->atualizarDoador($id, $_POST);

            $_SESSION['sucesso'] = 'Doador atualizado com sucesso!';
            header('Location: /sysmeal/doador/listar/' . $doador->getId());
            exit;
        } catch (Exception $e) {
            $this->doadorTemplate->formulario($_POST, $e->getMessage(), true, $id);
        }
    }

    // Excluir doador
    public function excluir()
    {
        $id = $this->getId();

        try {
            $this->doadorService->excluirDoador($id);

            $_SESSION['sucesso'] = 'Doador excluído com sucesso!';
            header('Location: /sysmeal/doador/listar');
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = $e->getMessage();
            header('Location: /sysmeal/doador/ver/' . $id);
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
