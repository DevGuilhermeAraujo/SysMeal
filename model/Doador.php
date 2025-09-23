<?php
namespace model;

class Doador
{
    private $id;
    private $nome;
    private $email;

    public function __construct($id = null, $nome = null, $email = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    //Getters
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    //Método para validar dados
    public function isValid()
    {
        $errors = [];

        if (empty($this->nome) || strlen($this->nome) < 2) {
            $errors[] = "Nome deve ter pelo menos 2 caracteres";
        }

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email inválido";
        }
        return empty($errors) ? true : $errors;
    }

    //método para converter array em objeto
    public static function fromArray($data)
    {
        $doador = new self();

        if (isset($data['id'])) $doador->setId($data['id']);
        if (isset($data['nome'])) $doador->setNome($data['nome']);
        if (isset($data['email'])) $doador->setEmail($data['email']);


        return $doador;
    }

    //Método para converter objeto em array
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email
        ];
    }
}
