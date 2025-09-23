<?php
namespace model;

class Instituicao
{
    private $id;
    private $nome;
    private $endereco;

    public function __construct($id = null, $nome = null, $endereco = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
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
    public function getEndereco()
    {
        return $this->endereco;
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
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    //Método para validar dados
    public function isValid()
    {
        $errors = [];

        if (empty($this->nome) || strlen($this->nome) < 2) {
            $errors[] = "Nome deve ter pelo menos 2 caracteres";
        }

        return empty($errors) ? true : $errors;
    }

    //método para converter array em objeto
    public static function fromArray($data)
    {
        $instituicao = new self();

        if (isset($data['id'])) $instituicao->setId($data['id']);
        if (isset($data['nome'])) $instituicao->setNome($data['nome']);
        if (isset($data['endereco'])) $instituicao->setendereco($data['endereco']);


        return $instituicao;
    }

    //Método para converter objeto em array
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'endereco' => $this->endereco
        ];
    }
}
