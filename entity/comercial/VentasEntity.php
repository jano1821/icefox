<?php
include('../../utility/AbstractSession.php');
class VentasEntity extends AbstractSession{
	private $conexion;

	public function VentasEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaVentasTabla($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta,$limite,$cantidad){
		$modulo="VentasEntity.obtenerListaVentasTabla";

		$fechaVentaInicial = str_replace('/', '-', $fechaVentaInicial);
		$fechaVentaInicial = date('Y-m-d', strtotime($fechaVentaInicial));
		$fechaVentaFinal = str_replace('/', '-', $fechaVentaFinal);
		$fechaVentaFinal = date('Y-m-d', strtotime($fechaVentaFinal));

		$consulta = "select venta, ";
		$consulta .= "certificado, ";
		$consulta .= "fechaVenta, ";
		$consulta .= "placa, ";
		$consulta .= "nomCliente, ";
		$consulta .= "nomPuntoVenta ";
		$consulta .= "FROM v_listaventas ";
		$consulta .= "WHERE certificado LIKE '%".$numeroCertificado."%' ";
		$consulta .= "AND placa LIKE '%".$numeroPlaca."%' ";
		if ($fechaVentaInicial!='' && $fechaVentaFinal!=''){
			$consulta .= "AND fechaVenta between '".$fechaVentaInicial."' ";
			$consulta .= "AND '".$fechaVentaFinal."' ";
		}
		$consulta .= "AND codPuntoVenta = '".$puntoVenta."' ";
		$consulta .= "order by venta desc ";
		$consulta .= "limit ".$limite.",".$cantidad.";";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function guardarVenta($fechaVenta,
                                     $fechaInicio,
                                     $fechaFinal,
                                     $hora,
                                     $cliente,
                                     $vehiculo,
                                     $comprobante,
                                     $comision,
                                     $liquidacion,
                                     $montoVenta){
            $modulo="VentasEntity.guardarVenta";
            
            
            
            return parent::finalyTransaction($modulo,$this->conexion,$consulta);
        }

	public function obtenerCantidadRegistros($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta){
		$modulo="VentasEntity.obtenerCantidadRegistros";

		$fechaVentaInicial = str_replace('/', '-', $fechaVentaInicial);
		$fechaVentaInicial = date('Y-m-d', strtotime($fechaVentaInicial));
		$fechaVentaFinal = str_replace('/', '-', $fechaVentaFinal);
		$fechaVentaFinal = date('Y-m-d', strtotime($fechaVentaFinal));

		$consulta = "select count(venta) cant ";
		$consulta .= "FROM v_listaventas ";
		$consulta .= "WHERE certificado LIKE '%".$numeroCertificado."%' ";
		$consulta .= "AND placa LIKE '%".$numeroPlaca."%' ";
		$consulta .= "AND codPuntoVenta = '".$puntoVenta."' ";
		if ($fechaVentaInicial!='' && $fechaVentaFinal!=''){
			$consulta .= "AND fechaVenta between '".$fechaVentaInicial."' ";
			$consulta .= "AND '".$fechaVentaFinal."' ";
		}

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>