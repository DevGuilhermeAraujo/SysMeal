<?php
namespace template;

interface ITemplate {
    public function render($view, $data = []);
}
?>