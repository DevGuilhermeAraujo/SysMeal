<?php
namespace dao;

use model\Doador;

interface IDoadorDAO {
    public function create(Doador $doador);
    public function findById($id);
    public function findAll();
    public function update(Doador $doador);
    public function delete($id);
    public function findByEmail($email);
}
?>