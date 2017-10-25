<?php

class CatalogoConstraintBean {
    private $valor;
    private $descripcion;

    function getValor() {
        return $this->valor;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
?>

