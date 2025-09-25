<?php
// controller/HomeController.php
namespace controller;

use Exception;
use service\DashboardService;
use template\HomeTemplate;

class HomeController
{
    private DashboardService $dashboardService;
    private HomeTemplate $homeTemplate;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
        $this->homeTemplate = new HomeTemplate();
    }

    // Página inicial (dashboard)
    public function index()
    {
        try {
            $stats = $this->dashboardService->getEstatisticas();
            $this->homeTemplate->dashboard($stats);
        } catch (Exception $e) {
            $this->homeTemplate->erro($e->getMessage());
        }
    }
}
