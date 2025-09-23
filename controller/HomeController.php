<?php
// controller/HomeController.php
namespace controller;

use template\HomeTemplate;
use Exception;
use PDOException;

class HomeController {
    private $template;
    
    public function __construct() {
        $this->template = new HomeTemplate();
    }
    
    public function index() {
        try {
            // Buscar estatísticas gerais
            $stats = $this->getEstatisticas();
            $this->template->dashboard($stats);
        } catch (Exception $e) {
            $this->template->erro($e->getMessage());
        }
    }
    
    private function getEstatisticas() {
        $stats = [];
        try {
            
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar estatísticas: " . $e->getMessage());
        }
        
        return $stats;
    }
}
?>