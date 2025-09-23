<?php

namespace service;

use Exception;
use dao\mysql\DoacaoDAO;
use model\Doacao;

class DoacaoService
{
    private $doacaoDAO;

    public function __construct()
    {
        $this->doacaoDAO = new DoacaoDAO();
    }

    public function criarDoacao($dados)
    {
        // Validar dados obrigatórios
        if (empty($dados['descricao'])) {
            throw new Exception("Descrição é obrigatória");
        }
        if (empty($dados['doador_id'])) {
            throw new Exception("Doador é obrigatório");
        }

        // Criar objeto Doacao
        $doacao = new Doacao(
            null,                               // ID (auto increment no banco)
            $dados['doador_id'],                // Doador
            null,
            $dados['descricao'],                // Descrição
            $dados['data_doacao'] ?? date('Y-m-d') // Data (se não vier, usa a atual)
        );

        // Validar objeto
        $validation = $doacao->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }

        // Salvar no banco
        return $this->doacaoDAO->create($doacao);
    }

    public function listarTodos()
    {
        return $this->doacaoDAO->findAll();
    }

    public function listarSemInstituicao()
    {
        return $this->doacaoDAO->findAllSemInstituicao();
    }

    public function listarComInstituicao()
    {
        return $this->doacaoDAO->findAllComInstituicao();
    }


    public function buscarPorId($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID inválido");
        }

        $doador = $this->doacaoDAO->findById($id);

        if (!$doador) {
            throw new Exception("Doação não encontrada");
        }

        return $doador;
    }

    public function atualizarDoacao($id, $dados)
    {
        // Buscar doador existente
        $doacao = $this->buscarPorId($id);

        // Atualizar dados
        if (!empty($dados['descricao'])) $doacao->setDescricao($dados['descricao']);
        if (!empty($dados['data_doacao'])) $doacao->setDataDoacao($dados['data_doacao']);

        // Validar
        $validation = $doacao->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }

        // Salvar
        if ($this->doacaoDAO->update($doacao)) {
            return $doacao;
        }

        throw new Exception("Erro ao atualizar doador");
    }

    public function excluirDoacao($id)
    {
        // Verificar se doador existe
        $this->buscarPorId($id);

        // TODO: Verificar se doador tem doações ativas antes de excluir

        if (!$this->doacaoDAO->delete($id)) {
            throw new Exception("Erro ao excluir doador");
        }

        return true;
    }

    public function solicitarDoacao($doacaoId, $instituicaoId)
    {
        // Validar IDs
        if (empty($doacaoId) || !is_numeric($doacaoId)) {
            throw new Exception("ID da doação inválido.");
        }
        if (empty($instituicaoId) || !is_numeric($instituicaoId)) {
            throw new Exception("ID da instituição inválido.");
        }

        // Buscar a doação
        $doacao = $this->buscarPorId($doacaoId);

        // Aqui você pode definir algum status ou registrar a instituição que solicitou
        $doacao->setInstituicaoId($instituicaoId); // precisaria ter esse setter na model Doacao

        // Atualizar no banco
        if (!$this->doacaoDAO->update($doacao)) {
            throw new Exception("Erro ao registrar solicitação da doação.");
        }

        return $doacao;
    }
}
