<?php
namespace dao\mysql;

use dao\IInstituicaoDAO;
use generic\MysqlSingleton;
use model\Instituicao;
use PDOException;
use Exception;

class InstituicaoDAO implements IInstituicaoDAO
{
    private $db;

    public function __construct()
    {
        $this->db = MysqlSingleton::getInstance();
    }

    public function create(Instituicao $instituicao)
    {
        $sql = "INSERT INTO instituicoes (nome, endereco) VALUES (?, ?)";
        try {
            return $this->db->executar($sql, [
                $instituicao->getNome(),
                $instituicao->getEndereco()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar instituição: " . $e->getMessage());
        }
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM instituicoes WHERE id = ?";
        try {
            $result = $this->db->executar($sql, [$id]);
            if (empty($result)) {
                return null;
            }
            return Instituicao::fromArray($result[0]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar instituição: " . $e->getMessage());
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM instituicoes";
        try {
            $result = $this->db->executar($sql);
            if (empty($result)) {
                return [];
            }
            return array_map(fn($row) => Instituicao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar instituições: " . $e->getMessage());
        }
    }

    public function update(Instituicao $instituicao)
    {
        $sql = "UPDATE instituicoes SET nome = ?, endereco = ? WHERE id = ?";
        try {
            return $this->db->executar($sql, [
                $instituicao->getNome(),
                $instituicao->getEndereco(),
                $instituicao->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar instituição: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM instituicoes WHERE id = ?";
        try {
            return $this->db->executar($sql, [$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar instituição: " . $e->getMessage());
        }
    }

    public function findByEndereco($endereco)
    {
        $sql = "SELECT * FROM instituicoes WHERE endereco LIKE ?";
        try {
            $result = $this->db->executar($sql, ["%$endereco%"]);
            if (empty($result)) {
                return [];
            }
            return array_map(fn($row) => Instituicao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar instituições por endereço: " . $e->getMessage());
        }
    }
}
