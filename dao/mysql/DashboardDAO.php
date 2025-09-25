<?php
namespace dao\mysql;

use dao\IDashboardDAO;
use generic\MysqlSingleton;
use PDOException;
use Exception;

class DashboardDAO implements IDashboardDAO
{
    private $db;

    public function __construct()
    {
        $this->db = MysqlSingleton::getInstance();
    }

    public function getTotalDoacoes()
    {
        $sql = "SELECT COUNT(*) as total FROM doacoes";
        try {
            $result = $this->db->executar($sql);
            return (int)($result[0]['total'] ?? 0);
        } catch (PDOException $e) {
            throw new Exception("Erro ao contar doações: " . $e->getMessage());
        }
    }

    public function getTotalDoadores()
    {
        $sql = "SELECT COUNT(*) as total FROM doadores";
        try {
            $result = $this->db->executar($sql);
            return (int)($result[0]['total'] ?? 0);
        } catch (PDOException $e) {
            throw new Exception("Erro ao contar doadores: " . $e->getMessage());
        }
    }

    public function getSolicitacoesPendentes()
    {
        // ⚠️ No seu schema não existe "status". 
        // Aqui vou considerar "pendente" como doações SEM instituição vinculada.
        $sql = "SELECT COUNT(*) as total FROM doacoes WHERE instituicao_id IS NULL";
        try {
            $result = $this->db->executar($sql);
            return (int)($result[0]['total'] ?? 0);
        } catch (PDOException $e) {
            throw new Exception("Erro ao contar solicitações pendentes: " . $e->getMessage());
        }
    }

    public function getDoacoesPorCategoria()
    {
        // ⚠️ No seu schema também não existe "categoria".
        // Se a ideia for agrupar, podemos usar a instituição como "categoria".
        $sql = "
            SELECT i.nome as categoria, COUNT(d.id) as total 
            FROM doacoes d
            LEFT JOIN instituicoes i ON d.instituicao_id = i.id
            GROUP BY i.nome
        ";
        try {
            $result = $this->db->executar($sql);
            $categorias = [];
            foreach ($result as $row) {
                $categoria = $row['categoria'] ?? 'Sem Instituição';
                $categorias[$categoria] = (int)$row['total'];
            }
            return $categorias;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar doações por categoria: " . $e->getMessage());
        }
    }
}
