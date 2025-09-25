<?php
namespace service;

use dao\mysql\DashboardDAO;
use Exception;

class DashboardService
{
    private $dashboardDAO;

    public function __construct()
    {
        // Se não for passado nenhum DAO, usa o padrão (MySQL)
        $this->dashboardDAO = new DashboardDAO();

    }

    public function getEstatisticas(): array
    {
        try {
            return [
                'total_doacoes' => $this->dashboardDAO->getTotalDoacoes(),
                'total_doadores' => $this->dashboardDAO->getTotalDoadores(),
                'solicitacoes_pendentes' => $this->dashboardDAO->getSolicitacoesPendentes(),
                'doacoes_por_categoria' => $this->dashboardDAO->getDoacoesPorCategoria(),
            ];
        } catch (Exception $e) {
            throw new Exception("Erro ao montar estatísticas do dashboard: " . $e->getMessage());
        }
    }
}
