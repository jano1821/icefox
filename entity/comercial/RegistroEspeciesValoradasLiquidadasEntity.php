<?php

include('../../utility/AbstractSession.php');
class RegistroEspeciesValoradasLiquidadasEntity extends AbstractSession {
    private $conexion;

    public function RegistroEspeciesValoradasLiquidadasEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerListaRegistroEspeciesValoradasLiquidadasTabla($numeroCertificado,
                            $codigoPuntoVenta,
                            $puntoVenta,
                            $limite,
                            $cantidad) {
        $modulo = "RegistroEspeciesValoradasLiquidadasEntity.obtenerListaRegistroEspeciesValoradasLiquidadasTabla";

        $consulta = "select producto, ";
        $consulta .= "certificado, ";
        $consulta .= "razon_social ";
        $consulta .= "FROM v_listaregistroespeciesvaloradasliquidadas ";
        $consulta .= "WHERE (puntoVenta = '" . $codigoPuntoVenta . "' ";
        $consulta .= "or razon_social LIKE '%" . $puntoVenta . "%') ";
        $consulta .= "and certificado like '%" . $numeroCertificado . "%' ";
        $consulta .= "order by producto desc ";
        $consulta .= "limit " . $limite . "," . $cantidad . ";";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function registrarEstados($producto,
                            $estadoRegistro) {
        $modulo = "RegistroEspeciesValoradasLiquidadasEntity.registrarEstados";

        $consulta = "call prc_actualizarEstadoProducto( ";
        $consulta .= $producto . ", ";
        $consulta .= "'" . $estadoRegistro . "', ";
        $consulta .= "'" . $_SESSION['usuario'] . "'); ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }
    /* public function modificarDeposito($codigo,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro){
      $modulo="DepositosEntity.modificarDeposito";

      $fecha = str_replace('/', '-', $fecha);
      $fecha = date('Y-m-d', strtotime($fecha));

      $consulta = "update Deposito ";
      $consulta .= "set serieDeposito='".$serie."', ";
      $consulta .= "numeroDeposito='".$numero."', ";
      $consulta .= "puntoVenta='".$punto."', ";
      $consulta .= "empleado='".$gestor."', ";
      $consulta .= "fecha='".$fecha."', ";
      $consulta .= "estadoRegistro = '".$estadoRegistro."', ";
      $consulta .= "fechaModificacion=CURDATE(), ";
      $consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
      $consulta .= "where codDeposito = '".$codigo."';";

      return parent::finalyTransaction($modulo,$this->conexion,$consulta);
      }

      public function obtenerDeposito($codigo){
      $modulo="DepositosEntity.obtenerDeposito";

      $consulta = "select codDeposito, ";//0
      $consulta .= "serieDeposito, ";//1
      $consulta .= "numeroDeposito, ";//2
      $consulta .= "puntoVenta, ";//3
      $consulta .= "empleado, ";//4
      $consulta .= "fecha, ";//5
      $consulta .= "estadoRegistro, ";//6
      $consulta .= "fechaInsercion, ";//7
      $consulta .= "usuarioInsercion, ";//8
      $consulta .= "fechaModificacion, ";//9
      $consulta .= "usuarioModificacion ";//10
      $consulta .= "from Deposito ";
      $consulta .= "where codDeposito = '".$codigo."';";

      return parent::finalyTransaction($modulo,$this->conexion,$consulta);
      } */

    public function obtenerCantidadRegistros($numeroCertificado,
                            $codigoPuntoVenta,
                            $puntoVenta) {
        $modulo = "RegistroEspeciesValoradasLiquidadasEntity.obtenerCantidadRegistros";

        $consulta = "select count(producto) cant ";
        $consulta .= "FROM v_listaregistroespeciesvaloradasliquidadas ";
        $consulta .= "WHERE (puntoVenta = '" . $codigoPuntoVenta . "' ";
        $consulta .= "or razon_social LIKE '%" . $puntoVenta . "%') ";
        $consulta .= "and certificado like '%" . $numeroCertificado . "%'; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}
?>