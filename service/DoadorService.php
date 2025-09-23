<?php
namespace service;

use Exception;
use dao\mysql\DoadorDAO;
use model\Doador;

class DoadorService {
    private $doadorDAO;
    
    public function __construct() {
        $this->doadorDAO = new DoadorDAO();
    }
    
    public function criarDoador($dados) {
        // Validar dados de entrada
        if (empty($dados['nome'])) {
            throw new Exception("Nome é obrigatório");
        }
        
        if (empty($dados['email'])) {
            throw new Exception("Email é obrigatório");
        }
        
        // Verificar se email já existe
        if ($this->doadorDAO->findByEmail($dados['email'])) {
            throw new Exception("Este email já está cadastrado");
        }
        
        // Criar objeto Doador
        $doador = new Doador(
            null,
            $dados['nome'],
            $dados['email']
        );
        
        // Validar objeto
        $validation = $doador->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }
        
        // Salvar no banco
        return $this->doadorDAO->create($doador);
    }
    
    public function listarTodos() {
        return $this->doadorDAO->findAll();
    }
    
    public function buscarPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID inválido");
        }
        
        $doador = $this->doadorDAO->findById($id);
        
        if (!$doador) {
            throw new Exception("Doador não encontrado");
        }
        
        return $doador;
    }
    
    public function atualizarDoador($id, $dados) {
        // Buscar doador existente
        $doador = $this->buscarPorId($id);
        
        // Verificar se email já existe (se mudou)
        if (!empty($dados['email']) && $dados['email'] !== $doador->getEmail()) {
            $doadorExistente = $this->doadorDAO->findByEmail($dados['email']);
            if ($doadorExistente && $doadorExistente->getId() !== $doador->getId()) {
                throw new Exception("Este email já está cadastrado");
            }
        }
        
        // Atualizar dados
        if (!empty($dados['nome'])) $doador->setNome($dados['nome']);
        if (!empty($dados['email'])) $doador->setEmail($dados['email']);
        
        // Validar
        $validation = $doador->isValid();
        if ($validation !== true) {
            throw new Exception("Dados inválidos: " . implode(", ", $validation));
        }
        
        // Salvar
        if ($this->doadorDAO->update($doador)) {
            return $doador;
        }
        
        throw new Exception("Erro ao atualizar doador");
    }
    
    public function excluirDoador($id) {
        // Verificar se doador existe
        $this->buscarPorId($id);
        
        // TODO: Verificar se doador tem doações ativas antes de excluir
        
        if (!$this->doadorDAO->delete($id)) {
            throw new Exception("Erro ao excluir doador");
        }
        
        return true;
    }
    
    public function buscarPorEmail($email) {
        if (empty($email)) {
            throw new Exception("Email é obrigatório");
        }
        
        return $this->doadorDAO->findByEmail($email);
    }
}
?>