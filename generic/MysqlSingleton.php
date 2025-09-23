<?php
namespace generic;

use PDO;
use PDOException;

class MysqlSingleton
{
    private static $instance = null; // Armazena a instância única da classe (padrão Singleton)
    private $connection; // Conexão PDO com o banco

    // Configurações do banco
    private $host = 'localhost';
    private $database = 'sysmeal';
    private $username = 'root';
    private $password = '';

    // Construtor privado -> impede que a classe seja instanciada fora dela mesma
    private function __construct()
    {
        try {
            // Cria a conexão PDO com configurações padrão
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Erros lançam exceções
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Retorna resultados como array associativo
                ]
            );
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage()); // Encerra caso dê erro
        }
    }

    // Método estático que retorna a instância única (Singleton)
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(); // Cria a instância apenas uma vez
        }
        return self::$instance;
    }

    // Método genérico para executar queries
    public function executar($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query); // Prepara a query

            // Faz bindValue de todos os parâmetros enviados
            foreach ($params as $key => $value) {
                $tipo = PDO::PARAM_STR;
                if (is_int($value)) {
                    $tipo = PDO::PARAM_INT;
                }
                if (is_bool($value)) {
                    $tipo = PDO::PARAM_BOOL;
                }
                if (is_null($value)) {
                    $tipo = PDO::PARAM_NULL;
                }

                // Permite usar tanto ":id" => 1 quanto [0 => "teste"]
                $paramKey = is_string($key) ? $key : $key + 1;
                $stmt->bindValue($paramKey, $value, $tipo);
            }

            $stmt->execute(); // Executa a query

            // Identifica o tipo da query e retorna imediatamente
            $tipoQuery = strtoupper(strtok(trim($query), " "));

            if ($tipoQuery === "SELECT" || $tipoQuery === "SHOW") {
                return $stmt->fetchAll();
            }

            if ($tipoQuery === "INSERT") {
                return $this->connection->lastInsertId();
            }

            return $stmt->rowCount(); // UPDATE, DELETE ou outras
        } catch (PDOException $e) {
            die("Erro ao executar query: " . $e->getMessage());
        }
    }

    // Retorna a conexão PDO bruta (caso precise usar diretamente)
    public function getConnection()
    {
        return $this->connection;
    }
}
