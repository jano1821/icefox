<?php

include('../../utility/AbstractSession.php');
class MantenimientoVehiculoEntity extends AbstractSession {
    private $conexion;

    public function MantenimientoVehiculoEntity($conexion) {
        $this->conexion = $conexion;
    }
    /* public function obtenerListaRegistroEspeciesValoradasLiquidadasTabla($numeroCertificado,
      $codigoPuntoVenta,
      $puntoVenta,
      $limite,
      $cantidad) {
      $modulo = "RegistroEspeciesVehiculoEntity.obtenerListaRegistroEspeciesValoradasLiquidadasTabla";

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
      } */

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

    public function obtenerCantidadRegistrosVehiculo($numeroPlaca) {
        $modulo = "MantenimientoVehiculoEntity.obtenerCantidadRegistros";

        $consulta = "select count(vehiculo) cant ";
        $consulta .= "FROM v_listVehiculo ";
        $consulta .= "WHERE placa = '" . $numeroPlaca . "'; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function guardarVehiculoProc($tipoOperacion,
                            $codigo,
                            $nroAsientos,
                            $nroSerieMotor,
                            $nroRuedas,
                            $nroPuertas,
                            $usoVehiculo,
                            $anioFabricacion,
                            $claseVehiculo,
                            $nroPlaca,
                            $modeloVehiculo,
                            $persona,
                            $estadoRegistro) {
        $valorDevuelto = "";

        $consulta = "call prc_guardarvehiculo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,@repuesta); ";

        $sentencia = mysqli_prepare($this->conexion,
                                $consulta);
        if ($sentencia) {
            mysqli_stmt_bind_param($sentencia,
                                    'siisiissssiiss',
                                    $tipoOperacion,
                                    $codigo,
                                    $nroAsientos,
                                    $nroSerieMotor,
                                    $nroRuedas,
                                    $nroPuertas,
                                    $usoVehiculo,
                                    $anioFabricacion,
                                    $claseVehiculo,
                                    $nroPlaca,
                                    $modeloVehiculo,
                                    $persona,
                                    $estadoRegistro,
                                    $_SESSION['usuario']);

            mysqli_stmt_execute($sentencia);

            $select = mysqli_query($this->conexion,
                                    'SELECT @repuesta');
            $result = mysqli_fetch_assoc($select);
            $valorDevuelto = $result['@repuesta'];

            mysqli_stmt_close($sentencia);
        }

        return $valorDevuelto;
    }

    public function obtenerVehiculoPorPlaca($placa) {
        $modulo = "MantenimientoVehiculoEntity.obtenerVehiculoPorPlaca";

        $consulta = "select vehiculo, ";
        $consulta .= "placa ";
        $consulta .= "FROM v_listVehiculo ";
        $consulta .= "WHERE placa = '" . $placa . "'; ";

        return parent::finalyTransaction($modulo,
                                                        $this->conexion,
                                                        $consulta);
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}
?>