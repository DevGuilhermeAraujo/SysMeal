<?php
namespace service;

use Exception;
use dao\mysql\InstituicaoDAO;
use model\Instituicao;

class InstituicaoService {
    private $instituicaoDAO;
    
    public function __construct() {
        $this->instituicaoDAO = new instituicaoDAO();
    }
    
    public function criarInstituicao($dados) {
        // Validar dados de entrada
        if (empty($dados['nome'])) {
            throw new Exception("Nome é obrigatório");
        }
        
        if (empty($dados['endereco'])) {
            throw new Exception("Endereco é obrigatório");
        }
        
        // Criar objeto Instituicao
        $instituicao = new Instituicao(
            null,
            $dados['nome'],
            $dados['endereco']
        );
        
        // Validar objeto
        $validation = $instituicao->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }
        
        // Salvar no banco
        return $this->instituicaoDAO->create($instituicao);
    }
    
    public function listarTodos() {
        return $this->instituicaoDAO->findAll();
    }
    
    public function buscarPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID inválido");
        }
        
        $Instituicao = $this->instituicaoDAO->findById($id);
        
        if (!$Instituicao) {
            throw new Exception("Instituicao não encontrado");
        }
        
        return $Instituicao;
    }
    
    public function atualizarInstituicao($id, $dados) {
        // Buscar Instituicao existente
        $instituicao = $this->buscarPorId($id);
        
        // Atualizar dados
        if (!empty($dados['nome'])) $instituicao->setNome($dados['nome']);
        if (!empty($dados['endereco'])) $instituicao->setEndereco($dados['endereco']);
        
        // Validar
        $validation = $instituicao->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }
        
        // Salvar
        if ($this->instituicaoDAO->update($instituicao)) {
            return $instituicao;
        }
        
        throw new Exception("Erro ao atualizar instituicao");
    }
    
    public function excluirInstituicao($id) {
        // Verificar se Instituicao existe
        $this->buscarPorId($id);
        
        // TODO: Verificar se Instituicao tem doações ativas antes de excluir
        
        if (!$this->instituicaoDAO->delete($id)) {
            throw new Exception("Erro ao excluir Instituicao");
        }
        
        return true;
    }
    
    public function buscarPorEndereco($endereco) {
        if (empty($endereco)) {
            throw new Exception("Endereço é obrigatório");
        }
        
        return $this->instituicaoDAO->findByEndereco($endereco);
    }
}
?>