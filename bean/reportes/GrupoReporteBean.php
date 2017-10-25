<?php

class GrupoReporteBean {
    private $codGrupo;
    private $descripcionGrupo;

    function getCodGrupo() {
        return $this->codGrupo;
    }

    function getDescripcionGrupo() {
        return $this->descripcionGrupo;
    }

    function setCodGrupo($codGrupo) {
        $this->codGrupo = $codGrupo;
    }

    function setDescripcionGrupo($descripcionGrupo) {
        $this->descripcionGrupo = $descripcionGrupo;
    }
}
?>

