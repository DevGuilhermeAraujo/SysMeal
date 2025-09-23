<?php

namespace model;

class Doacao
{
    private $id;
    private $doador_id;
    private $instituicao_id;
    private $descricao;
    private $data_doacao;
    private $nomeDoador; // novo campo
    private $nomeInstituicao;

    public function __construct($id = null, $doador_id = null, $instituicao_id = null, $descricao = null, $data_doacao = null)
    {
        $this->id = $id;
        $this->doador_id = $doador_id;
        $this->instituicao_id = $instituicao_id;
        $this->descricao = $descricao;
        $this->data_doacao = $data_doacao;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getDoadorId()
    {
        return $this->doador_id;
    }
    public function getInstituicaoId()
    {
        return $this->instituicao_id;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getDataDoacao()
    {
        return $this->data_doacao;
    }
    public function getNomeDoador()
    {
        return $this->nomeDoador;
    }
    public function getNomeInstituicao()
    {
        return $this->nomeInstituicao;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setDoadorId($doador_id)
    {
        $this->doador_id = $doador_id;
    }
    public function setInstituicaoId($instituicao_id)
    {
        $this->instituicao_id = $instituicao_id;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function setDataDoacao($data_doacao)
    {
        $this->data_doacao = $data_doacao;
    }
    public function setNomeDoador($nome)
    {
        $this->nomeDoador = $nome;
    }
    public function setNomeInstituicao($nome)
    {
        $this->nomeInstituicao = $nome;
    }

    // Validação básica
    public function isValid()
    {
        $errors = [];

        if (empty($this->doador_id)) {
            $errors[] = "Doador é obrigatório";
        }

        // if (empty($this->instituicao_id)) {
        //     $errors[] = "Instituição é obrigatória";
        // }

        // if (empty($this->descricao) || strlen($this->descricao) < 5) {
        //     $errors[] = "Descrição deve ter pelo menos 5 caracteres";
        // }

        // if (empty($this->data_doacao)) {
        //     $errors[] = "Data da doação é obrigatória";
        // }

        return empty($errors) ? true : $errors;
    }

    // Converte array em objeto Doacao
    public static function fromArray($data)
    {
        $doacao = new self();

        if (isset($data['id'])) $doacao->setId($data['id']);
        if (isset($data['doador_id'])) $doacao->setDoadorId($data['doador_id']);
        if (isset($data['instituicao_id'])) $doacao->setInstituicaoId($data['instituicao_id']);
        if (isset($data['descricao'])) $doacao->setDescricao($data['descricao']);
        if (isset($data['data_doacao'])) $doacao->setDataDoacao($data['data_doacao']);
        if (isset($data['nome_doador'])) $doacao->setNomeDoador($data['nome_doador']); // seta o nome do doador
        if (isset($data['nome_instituicao'])) $doacao->setNomeInstituicao($data['nome_instituicao']); // seta o nome da instituição

        return $doacao;
    }

    // Converte objeto Doacao em array
    public function toArray()
    {
        return [
            'id' => $this->id,
            'doador_id' => $this->doador_id,
            'instituicao_id' => $this->instituicao_id,
            'descricao' => $this->descricao,
            'data_doacao' => $this->data_doacao
        ];
    }
}
