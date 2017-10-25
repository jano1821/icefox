<?php
include('../../utility/AbstractClass.php');
class VentasController extends AbstractClass{
	private $rutaVentas='../../entity/comercial/VentasEntity.php';
	private $claseVentas='VentasEntity';
	/*private $rutaPersona='../../entity/mantenimiento/MantenimientoPersonaEntity.php';
	private $clasePersona='MantenimientoPersonaEntity';
	private $rutaEspecieValorada='../../entity/operaciones/EspeciesValoradasEntity.php';
	private $claseEspecieValorada='EspeciesValoradasEntity';
	private $rutaLote='../../entity/operaciones/LoteRegistroEntity.php';
	private $claseLote='LoteRegistroEntity';
	private $rutaDepositoProducto='../../entity/operaciones/DepositoProductoEntity.php';
	private $claseDepositoProducto='DepositoProductoEntity';*/

	private function procesarListaVentas($resultadoListaVentas){
		$arrayDatos = array();
		while($row = $resultadoListaVentas->fetch_array()){
			$arrayDatos[] = $row;
		}

		//$arrayTitulos = array("","Certificado","Fecha de Venta","Numero de Placa","Cliente","Punto de Venta");
		$arrayBotones = array("Editar","Anular","Vencido","Devuelto","Recojo");

                $arrayTitulos = array("","Certificado","Fecha de Venta","Numero de Placa","Cliente","Punto de Venta");
                $arrayBotones = array("Anular","Vencido","Devuelto","Recojo");
                $arrayFunciones = array();
                $arrayModal = array("obtenerParametros","Registrar Venta","","glyphicon glyphicon-record"); //separado

                $htmlTabla = parent::_armarTablaEspecialConFuncionesModalNew($arrayTitulos,
                                                                $arrayDatos,
                                                                '',
                                                                '',
                                                                false,
                                                                $arrayBotones,
                                                                $arrayFunciones,
                                                                $arrayModal);

//$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaVentas($htmlTabla,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas){
		include('../../view/comercial/TablaVentas.php');

		$tablaVentas = new TablaVentas;
		$tablaVentas -> mostrarTablaVentas($htmlTabla,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas);
	}

	/*private function enviaCabeceraDetalleTablaEspecieValorada($resultadoEspeciesValoradas){
		$arrayTitulos = array("","Numero Certificado","Tipo","Lote","Proveedor");
		$arrayBotones = array("Seleccionar");
		$arrayDatos = parent::_procesarLista($resultadoEspeciesValoradas);

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}*/

	private function obtenerCantidadPaginas($ventasEntity,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta,$cantidad){
		$result = $ventasEntity -> obtenerCantidadRegistros($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta);
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

	/*private function obtenerCantidadPaginasEspeciesValoradas($especiesValoradasEntity,$cantidad,$numeroCertificado){
		$result = $especiesValoradasEntity -> obtenerCantidadRegistros($numeroCertificado);
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
	}*/

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

	public function obtenerListaVentas($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$direccion){
		$ventasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaVentas,$this->claseVentas);

		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());

		$cantPaginas = $this -> obtenerCantidadPaginas($ventasEntity,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta,$cantidad);

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

		/*$arrayEmpleados = array();
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

		$limite=$cantidad*($pagina-1);
		$resultadoListaVentas = $ventasEntity -> obtenerListaVentasTabla($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$puntoVenta,$limite,$cantidad);

		$ventasEntity->cerrarConexion();

		$htmlTabla = $this->procesarListaVentas($resultadoListaVentas);

		$this -> invocarTablaVentas($htmlTabla,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas);
	}

	public function guardarVenta($pagina){
		$ventasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaVentas,$this->claseVentas);
		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());
		//$id="";
		$cantPaginas = $this -> obtenerCantidadPaginas($ventasEntity,'','','','','',$cantidad);

		/*if ($validatorForm=='N'){

			if ($metodo=='I'){
				$id = $depositosEntity -> insertarDeposito($serie,$numero,$gestor,$punto,$fecha,$estadoRegistro);
				if ($id!=null && $id!="" && $id>0){
					$depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaDepositoProducto,$this->claseDepositoProducto);

					for ($i=0;$i<count($especiesValoradas);$i++){
						$depositoProductoEntity -> insertarProductos($id,$especiesValoradas[$i],'S');
					}
				}
			}else{
				for ($i=0;$i<$cantidadRegistros;$i++){
					$poliza = $numero+$i;
					$depositosEntity -> insertarDeposito($serie,$numero+$i,$gestor,$punto,$fecha,$estadoRegistro);
				}
			}
		}else if ($validatorForm=='M'){
			$depositosEntity -> modificarDeposito($codigo,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro);

			$depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaDepositoProducto,$this->claseDepositoProducto);
			$depositoProductoEntity -> modificarProductos($codigo);

			for ($i=0;$i<count($especiesValoradas);$i++){
				$depositoProductoEntity -> insertarProductos($codigo,$especiesValoradas[$i],'S');
			}
		}*/

		/*$arrayEmpleados = array();
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

		$limite=$cantidad*($pagina-1);
		echo $limite;

		$resultadoListaVentas = $ventasEntity -> obtenerListaVentasTabla('','','','','',$limite,$cantidad);

		$ventasEntity->cerrarConexion();

		$htmlTabla = $this->procesarListaVentas($resultadoListaVentas);

		$this -> invocarTablaVentas($htmlTabla,'','','','','','',$pagina,$cantPaginas);
	}

	/*public function mostrarBusquedaEspeciesValoradas($especies,$numeroCertificado,$pagina,$direccion){
		$resultadoCarga='';
		$especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEspecieValorada,$this->claseEspecieValorada);

		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());

		$cantPaginas = $this -> obtenerCantidadPaginasEspeciesValoradas($especiesValoradasEntity,$cantidad,$numeroCertificado);

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

		$arrayProveedores = array();
		$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPersona,$this->clasePersona);
		$resultadoListaProveedores = $mantenimientoPersonaEntity -> obtenerListaProveedores('','S');

		while($row = $resultadoListaProveedores->fetch_array() ){
			$arrayProveedores[] = $row;
		}

		$limite=$cantidad*($pagina-1);
		$resultadoListaEspecieValorada = $especiesValoradasEntity -> obtenerListaEspecieValoradaSeleccion($especies,$numeroCertificado,$limite,$cantidad);
		$especiesValoradasEntity->cerrarConexion();

		$htmlTabla = $this->enviaCabeceraDetalleTablaEspecieValorada($resultadoListaEspecieValorada);

		include('../../view/operaciones/FormDetalleEspeciesValoradas.php');
		$formDetalleEspeciesValoradas = new FormDetalleEspeciesValoradas;
		$formDetalleEspeciesValoradas -> mostrarFormDetalleEspeciesValoradas($especies,$htmlTabla,$numeroCertificado,$pagina,$cantPaginas,$resultadoCarga);
	}*/
};
?>