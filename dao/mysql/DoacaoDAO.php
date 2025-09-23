<?php

namespace dao\mysql;

use dao\IDoacaoDAO;
use generic\MysqlSingleton;
use model\Doacao;
use PDOException;
use Exception;

class DoacaoDAO implements IDoacaoDAO
{
    private $db;

    public function __construct()
    {
        $this->db = MysqlSingleton::getInstance();
    }

    public function create(Doacao $doacao)
    {
        $sql = "INSERT INTO doacoes (doador_id, instituicao_id, descricao, data_doacao) VALUES (?, ?, ?, ?)";
        try {
            $result = $this->db->executar($sql, [
                $doacao->getDoadorId(),
                $doacao->getInstituicaoId(),
                $doacao->getDescricao(),
                $doacao->getDataDoacao()
            ]);
            return $result; // retorna o lastInsertId
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar doação: " . $e->getMessage());
        }
    }

    public function findById($id)
    {
        $sql = "SELECT doa.id, doa.descricao, doa.data_doacao, doa.doador_id, doad.nome AS nome_doador
            FROM doacoes doa
            JOIN doadores doad ON doa.doador_id = doad.id
            WHERE doa.id = :id";
        try {
            $result = $this->db->executar($sql, [':id' => $id]);
            if (empty($result)) {
                return null;
            }
            return Doacao::fromArray($result[0]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doação: " . $e->getMessage());
        }
    }


    public function findAll()
    {
        $sql = "SELECT doa.id, doa.descricao, doa.data_doacao, doad.nome 
        FROM doacoes doa 
        JOIN doadores doad ON doa.doador_id = doad.id";
        try {
            $result = $this->db->executar($sql);
            if (empty($result)) {
                return null;
            }
            return array_map(fn($row) => Doacao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações: " . $e->getMessage());
        }
    }

    public function findAllSemInstituicao()
    {
        $sql = "SELECT doa.id, doa.descricao, doa.data_doacao, doad.nome AS nome_doador
                FROM doacoes doa
                LEFT JOIN doadores doad ON doa.doador_id = doad.id
                WHERE doa.instituicao_id IS NULL";
        try {
            $result = $this->db->executar($sql);
            if (empty($result)) {
                return null;
            }
            return array_map(fn($row) => Doacao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações sem instituição: " . $e->getMessage());
        }
    }

    public function findAllComInstituicao()
    {
        $sql = "SELECT doa.id, doa.descricao, doa.data_doacao, inst.nome AS nome_instituicao 
            FROM doacoes doa
            JOIN instituicoes inst ON doa.instituicao_id = inst.id
            WHERE doa.instituicao_id IS NOT NULL";
        try {
            $result = $this->db->executar($sql);
            if (empty($result)) {
                return null;
            }
            return array_map(fn($row) => Doacao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações com instituição: " . $e->getMessage());
        }
    }


    public function update(Doacao $doacao)
    {
        $sql = "UPDATE doacoes SET doador_id = ?, instituicao_id = ?, descricao = ?, data_doacao = ? WHERE id = ?";
        try {
            return $this->db->executar($sql, [
                $doacao->getDoadorId(),
                $doacao->getInstituicaoId(),
                $doacao->getDescricao(),
                $doacao->getDataDoacao(),
                $doacao->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar doação: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM doacoes WHERE id = ?";
        try {
            return $this->db->executar($sql, [$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar doação: " . $e->getMessage());
        }
    }

    public function findByDoadorId($doadorId)
    {
        $sql = "SELECT * FROM doacoes WHERE doador_id = ?";
        try {
            $result = $this->db->executar($sql, [$doadorId]);
            if (empty($result)) {
                return null;
            }
            return array_map(fn($row) => Doacao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações por doador: " . $e->getMessage());
        }
    }

    public function findByInstituicaoId($instituicaoId)
    {
        $sql = "SELECT * FROM doacoes WHERE instituicao_id = ?";
        try {
            $result = $this->db->executar($sql, [$instituicaoId]);
            if (empty($result)) {
                return null;
            }
            return array_map(fn($row) => Doacao::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações por instituição: " . $e->getMessage());
        }
    }
}
