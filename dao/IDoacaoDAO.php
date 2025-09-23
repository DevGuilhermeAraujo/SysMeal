<?php
namespace dao;

use model\Doacao;

interface IDoacaoDAO {
    public function create(Doacao $doacao);
    public function findById($id);
    public function findAll();
    public function update(Doacao $doacao);
    public function delete($id);
    public function findByDoadorId($doadorId);
    public function findByInstituicaoId($instituicaoId);
}
