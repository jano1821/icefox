<?php

include('../../utility/AbstractSession.php');
class ReporteEntity extends AbstractSession {
    private $conexion;

    public function ReporteEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerGrupoReporte() {
        $modulo = "ReporteEntity.obtenerGrupoReporte";

        $consulta = "select grupo, ";
        $consulta .= "descripcion ";
        $consulta .= "FROM v_listagruporeportes ";
        $consulta .= "order by grupo asc;";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function obtenerSubGrupoReporte($grupo) {
        $modulo = "ReporteEntity.obtenerSubGrupoReporte";

        $consulta = "select prov.codSubGrupo, "; //fila0
        $consulta .= "prov.descripcionSubgrupo "; //fila1
        $consulta .= "from subgruporeporte prov ";
        $consulta .= "where prov.codGrupo = " . $grupo . "; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function obtenerReportes($subgrupo) {
        $modulo = "ReporteEntity.obtenerReportes";

        $consulta = "select prov.reporte, "; //fila0
        $consulta .= "prov.descReporte "; //fila1
        $consulta .= "from v_listareportes prov ";
        $consulta .= "where prov.subGrupo = " . $subgrupo . "; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function obtenerParametros($codReporte) {
        $modulo = "ReporteEntity.obtenerParametros";

        $consulta = "select prov.parametro, "; //fila0
        $consulta .= "prov.nombre, "; //fila1
        $consulta .= "prov.etiqueta, "; //fila2
        $consulta .= "prov.reporte, "; //fila3
        $consulta .= "prov.tipo, "; //fila4
        $consulta .= "prov.tamanio "; //fila5
        $consulta .= "from v_listaparametros prov ";
        $consulta .= "where prov.reporte = " . $codReporte . "; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function obtenerIdentificadorReporte($codReporte) {
        $modulo = "ReporteEntity.obtenerIdentificadorReporte";

        $consulta = "select prov.idReporte "; //fila0
        $consulta .= "from v_listareportes prov ";
        $consulta .= "where prov.reporte = " . $codReporte . "; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}
?>

