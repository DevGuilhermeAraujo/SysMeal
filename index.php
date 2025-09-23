<?php
// index.php - Front Controller
require_once './generic/Autoload.php';

// Configuração de exibição de erros para desenvolvimento
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicia a sessão
session_start();

// Pega o parâmetro da URL
$param = isset($_GET['param']) ? $_GET['param'] : 'home';

// Divide o parâmetro em partes (ex: doador/listar)
$parts = explode('/', $param);
$controller_name = isset($parts[0]) ? ucfirst($parts[0]) : 'Home';
$action = isset($parts[1]) ? $parts[1] : 'index';

try {
    // Monta o nome da classe do controller
    $controller_class = "controller\\" . $controller_name . 'Controller';


    // Verifica se a classe do controller existe
    if (class_exists($controller_class)) {
        $controller = new $controller_class();

        // Verifica se o método existe
        if (method_exists($controller, $action)) {

            // Extrai parâmetros adicionais da URL
            $params = array_slice($parts, 2); // tudo que vem depois do controller e da ação

            // Chama o método passando os parâmetros
            call_user_func_array([$controller, $action], $params);
        } else {
            throw new Exception("Ação '$action' não encontrada no controller '$controller_class'");
        }
    } else {
        throw new Exception("Controller '$controller_class' não encontrado");
    }
} catch (Exception $e) {
    // Em caso de erro, redireciona para página inicial ou exibe erro
    echo "<h1>Erro 404</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><a href='/'>Voltar ao início</a></p>";
}
