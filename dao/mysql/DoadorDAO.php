<?php
namespace dao\mysql;

use dao\IDoadorDAO;
use generic\MysqlSingleton;
use model\Doador;
use PDOException;
use Exception;

class DoadorDAO implements IDoadorDAO
{
    private $db;

    public function __construct()
    {
        $this->db = MysqlSingleton::getInstance();
    }

    public function create(Doador $doador)
    {
        $sql = 'INSERT INTO doadores (nome, email) VALUES (?, ?)';
        try {
            $result = $this->db->executar($sql, [
                $doador->getNome(),
                $doador->getEmail()
            ]);

            return $result; // retorna o lastInsertId
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar doador: " . $e->getMessage());
        }
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM doadores WHERE id = ?";
        try {
            $result = $this->db->executar($sql, [$id]);
            if (empty($result)) {
                return null;
            }

            return Doador::fromArray($result[0]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doador: " . $e->getMessage());
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM doadores";
        try {
            $result = $this->db->executar($sql);

            if (empty($result)) {
                return null;
            }
            // transforma todos os registros em objetos Doador
            return array_map(fn($row) => Doador::fromArray($row), $result);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doadores: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM doadores WHERE id = ?";
        try {
            return $this->db->executar($sql, [$id]); // retorna true/false
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar doador: " . $e->getMessage());
        }
    }

    public function update(Doador $doador)
    {
        $sql = "UPDATE doadores SET nome = ?, email = ? WHERE id = ?";
        try {
            return $this->db->executar($sql, [
                $doador->getNome(),
                $doador->getEmail(),
                $doador->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar doador: " . $e->getMessage());
        }
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM doadores WHERE email = ?";
        try {
            $result = $this->db->executar($sql, [$email]);
            if (empty($result)) {
                return null;
            }

            return Doador::fromArray($result[0]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doador por e-mail: " . $e->getMessage());
        }
    }
}