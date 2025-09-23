<?php
namespace dao;

use model\Instituicao;

interface IInstituicaoDAO {
    public function create(Instituicao $instituicao);
    public function findById($id);
    public function findAll();
    public function update(Instituicao $instituicao);
    public function delete($id);
    public function findByEndereco($endereco);
}
?>