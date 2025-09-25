<?php
namespace dao;

interface IDashboardDAO {
    public function getTotalDoacoes();
    public function getTotalDoadores();
    public function getSolicitacoesPendentes();
    public function getDoacoesPorCategoria();
}
