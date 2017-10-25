<?php
include('../../utility/AbstractClass.php');
class RegistroEspeciesValoradasLiquidadasController extends AbstractClass{
	private $rutaRegistroEspeciesValoradasLiquidadas='../../entity/comercial/RegistroEspeciesValoradasLiquidadasEntity.php';
	private $claseRegistroEspeciesValoradasLiquidadas='RegistroEspeciesValoradasLiquidadasEntity';

	private function procesarListaRegistroEspeciesValoradasLiquidadas($resultadoListaRegistroEspeciesValoradasLiquidadas){
		$arrayDatos = array();
		while($row = $resultadoListaRegistroEspeciesValoradasLiquidadas->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Certificado","Punto de Venta");
		$arrayBotones = array("Anular","Vencido","Devuelto","Recogido");
		$arrayFunciones = array("Anular","Vencido","Devolver","Recoger");
		$arrayModal = array("registrar","Registrar","","glyphicon glyphicon-record");//separado

		$htmlTabla = parent::_armarTablaEspecialConFuncionesModalNew($arrayTitulos,$arrayDatos,'','',false,$arrayBotones,$arrayFunciones,$arrayModal);

		return $htmlTabla;
	}

	private function invocarTablaRegistroEspeciesValoradasLiquidadas($htmlTabla,$numeroCertificado,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas){
		include('../../view/comercial/TablaRegistroEspeciesValoradasLiquidadas.php');

		$tablaRegistroEspeciesValoradasLiquidadas = new TablaRegistroEspeciesValoradasLiquidadas;
		$tablaRegistroEspeciesValoradasLiquidadas -> mostrarTablaRegistroEspeciesValoradasLiquidadas($htmlTabla,$numeroCertificado,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas);
	}

	private function enviaCabeceraDetalleTablaEspecieValorada($resultadoEspeciesValoradas){
		$arrayTitulos = array("","Numero Certificado","Tipo","Lote","Proveedor");
		$arrayBotones = array("Seleccionar");
		$arrayDatos = parent::_procesarLista($resultadoEspeciesValoradas);

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function obtenerCantidadPaginas($registroEspeciesValoradasLiquidadasEntity,$numeroCertificado,$codigoPuntoVenta,$puntoVenta,$cantidad){
		$result = $registroEspeciesValoradasLiquidadasEntity -> obtenerCantidadRegistros($numeroCertificado,$codigoPuntoVenta,$puntoVenta);
		$paginas = 0;

		$row = $result->fetch_assoc();

		if ($row["cant"]>0){
			$paginas = floor($row["cant"]/$cantidad);
			$resto = $row["cant"]%$cantidad;
		}else{
			$resto=1;
		}

		if ($resto > 0){
			$paginas++;
		}

		return $paginas;
	}

	public function mostrarFormularioVentas($codigo){
		/*$arrayDeposito = array();
		$arrayDepositoProducto = array();

		if ($codigo!=''){
			$depositosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaDespositos,$this->claseDepositos);
			$resultadoDesposito = $depositosEntity->obtenerDeposito($codigo);

			while($row = $resultadoDesposito->fetch_array()){
				$arrayDeposito[] = $row;
			}

			$depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaDepositoProducto,$this->claseDepositoProducto);
			$resultadoDespositoProducto = $depositoProductoEntity -> obtenerListaProductosPorDeposito($codigo);

			while($row = $resultadoDespositoProducto->fetch_array() ){
				$arrayDepositoProducto[] = $row;
			}
		}

		$arrayEmpleados = array();
		$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPersona,$this->clasePersona);
		$resultadoListaEmpleados = $mantenimientoPersonaEntity -> obtenerListaEmpleados('','S');

		while($row = $resultadoListaEmpleados->fetch_array() ){
			$arrayEmpleados[] = $row;
		}

		$arrayPuntoVenta = array();
		$resultadoListaPuntoVenta = $mantenimientoPersonaEntity -> obtenerListaPuntosDeVenta('','S');

		while($row = $resultadoListaPuntoVenta->fetch_array() ){
			$arrayPuntoVenta[] = $row;
		}*/



		include('../../view/comercial/FormVentas.php');
		$formVentas = new FormVentas;
		$formVentas -> mostrarFormVentas();//$arrayDepositoProducto,$arrayDeposito,$arrayEmpleados,$arrayPuntoVenta
	}

	public function obtenerListaRegistroEspeciesValoradasLiquidadas($numeroCertificado,$codigoPuntoVenta,$puntoVenta,$pagina,$direccion){
		$registroEspeciesValoradasLiquidadasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaRegistroEspeciesValoradasLiquidadas,$this->claseRegistroEspeciesValoradasLiquidadas);

		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());

		$cantPaginas = $this -> obtenerCantidadPaginas($registroEspeciesValoradasLiquidadasEntity,$numeroCertificado,$codigoPuntoVenta,$puntoVenta,$cantidad);
		if($direccion=='-1'){
			if ($pagina==1){
				echo '<script language="javascript">alert("No hay registros anteriores");</script>';
			}else{
				$pagina=$pagina-1;
			}
		}

		if($direccion=='1'){
			if ($pagina>=$cantPaginas){
				echo '<script language="javascript">alert("No hay registros posteriores");</script>';
			}else{
				$pagina=$pagina+1;
			}
		}

		$limite=$cantidad*($pagina-1);
		$resultadoListaRegistroEspeciesValoradasLiquidadas = $registroEspeciesValoradasLiquidadasEntity -> obtenerListaRegistroEspeciesValoradasLiquidadasTabla($numeroCertificado,$codigoPuntoVenta,$puntoVenta,$limite,$cantidad);

		$registroEspeciesValoradasLiquidadasEntity->cerrarConexion();

		$htmlTabla = $this->procesarListaRegistroEspeciesValoradasLiquidadas($resultadoListaRegistroEspeciesValoradasLiquidadas);

		$this -> invocarTablaRegistroEspeciesValoradasLiquidadas($htmlTabla,$numeroCertificado,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas);
	}

	function cambioEstadoEspecieValoradaLiquidada($producto,$estadoRegistro){
		if ($producto==''){
			echo '<script language="javascript">alert("No se ha Seleccionado un Producto Válido");</script>';
		}else{
			$registroEspeciesValoradasLiquidadasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaRegistroEspeciesValoradasLiquidadas,$this->claseRegistroEspeciesValoradasLiquidadas);

			$registroEspeciesValoradasLiquidadasEntity -> registrarEstados($producto,$estadoRegistro);

			echo '<script language="javascript">alert("Operacion Realizada con exito';

			$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());

			$cantPaginas = $this -> obtenerCantidadPaginas($registroEspeciesValoradasLiquidadasEntity,'','','',$cantidad);

			$limite=0;
			$resultadoListaRegistroEspeciesValoradasLiquidadas = $registroEspeciesValoradasLiquidadasEntity -> obtenerListaRegistroEspeciesValoradasLiquidadasTabla('','','',$limite,$cantidad);

			$registroEspeciesValoradasLiquidadasEntity->cerrarConexion();

			$htmlTabla = $this->procesarListaRegistroEspeciesValoradasLiquidadas($resultadoListaRegistroEspeciesValoradasLiquidadas);

			$this -> invocarTablaRegistroEspeciesValoradasLiquidadas($htmlTabla,'','','',1,$cantPaginas);
			}
	}
};
?>