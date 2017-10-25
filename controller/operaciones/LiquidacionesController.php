<?php
include('../../utility/AbstractClass.php');
class LiquidacionesController extends AbstractClass{
	private $rutaLiquidaciones='../../entity/operaciones/LiquidacionesEntity.php';
	private $claseLiquidaciones='LiquidacionesEntity';
	private $rutaEspecieValorada='../../entity/operaciones/EspeciesValoradasEntity.php';
	private $claseEspecieValorada='EspeciesValoradasEntity';
	private $rutaPersona='../../entity/mantenimiento/MantenimientoPersonaEntity.php';
	private $clasePersona='MantenimientoPersonaEntity';
	private $rutaLiquidacionProductoEntity='../../entity/operaciones/LiquidacionProductoEntity.php';
	private $claseLiquidacionProducto='LiquidacionProductoEntity';

	private function procesarListaLiquidaciones($resultadoListaLiquidaciones){
		$arrayDatos = array();
		while($row = $resultadoListaLiquidaciones->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Serie","Numero","Gestor de Campo","Punto de venta");
		$arrayBotones = array("Editar","Eliminar");

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaLiquidaciones($htmlTabla,$arrayEmpleados,$arrayPuntoVenta,$serie,$numero,$empleado,$puntoVenta,$pagina,$cantPaginas){
		unset($_SESSION['listaDetalleEVLiquidar']);
		unset($_SESSION['arrayPuntoVenta']);

		include('../../view/operaciones/TablaLiquidaciones.php');

		$tablaLiquidaciones = new TablaLiquidaciones;
		$tablaLiquidaciones -> mostrarTablaLiquidaciones($htmlTabla,$arrayEmpleados,$arrayPuntoVenta,$serie,$numero,$empleado,$puntoVenta,$pagina,$cantPaginas);
	}

	private function enviaCabeceraDetalleTablaEspecieValorada($resultadoEspeciesValoradas){
		$arrayTitulos = array("","Numero Certificado","Tipo","Lote","Proveedor");
		$arrayBotones = array("Seleccionar");
		$arrayDatos = parent::_procesarLista($resultadoEspeciesValoradas);

		//$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);
		$htmlTabla = parent::_armarTablaEspecial($arrayTitulos,$arrayDatos,'',true,false,$arrayBotones);


		return $htmlTabla;
	}

	private function obtenerCantidadPaginas($liquidacionEntity,$serie,$numero,$empleado,$puntoVenta,$cantidad){
		$result = $liquidacionEntity -> obtenerCantidadRegistros($serie,$numero,$empleado,$puntoVenta);
		$paginas = 0;

		$row = $result->fetch_assoc();

		if ($row["cant"]>0){
			$paginas = floor($row["cant"]/$cantidad);
			$resto = $row["cant"]%$cantidad;
		}else{
			$resto = 1;
		}

		if ($resto > 0){
			$paginas++;
		}

		return $paginas;
	}

	private function obtenerCantidadPaginasEspeciesValoradas($especies,$especiesValoradasEntity,$cantidad,$numeroCertificado,$puntoVenta){
		$result = $especiesValoradasEntity -> obtenerCantidadEspeciesValoradasLiquidaciones($especies,$numeroCertificado,$puntoVenta);
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

	public function mostrarRegistroLiquidaciones($codigo){
		$arrayLiquidacion = array();
		$arrayVenta = array();
		if ($codigo!=''){
			$liquidacionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidaciones,$this->claseLiquidaciones);
			$resultadoLiquidacion = $liquidacionEntity->obtenerLiquidacion($codigo);

			while($row = $resultadoLiquidacion->fetch_array()){
				$arrayLiquidacion[] = $row;
			}

			$ventasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidacionProductoEntity,$this->claseLiquidacionProducto);
			$resultadoVentas = $ventasEntity -> obtenerListaProductosPorLiquidacion($codigo);

			while($row = $resultadoVentas->fetch_array() ){
				$arrayVenta[] = $row;
			}

			if (count($arrayVenta)>0){
				$_SESSION['listaDetalleEVLiquidar'] = $arrayVenta;
			}
		}else{
			if (isset($_SESSION['listaDetalleEVLiquidar'])){
				foreach ($_SESSION['listaDetalleEVLiquidar'] as $key) {
					$arrayVenta[] = $key;
				}
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
		}

		if (isset($_SESSION['arrayPuntoVenta']) && count($arrayLiquidacion)<=0){
			$arrayLiquidacion[0][3]=$_SESSION['arrayPuntoVenta'][1];
			$arrayLiquidacion[0][0]='';
			$arrayLiquidacion[0][1]='';
			$arrayLiquidacion[0][2]='';
			$arrayLiquidacion[0][4]='';
			$arrayLiquidacion[0][5]='';
			$arrayLiquidacion[0][6]='';
			$arrayLiquidacion[0][7]='';
			$arrayLiquidacion[0][8]='';
			$arrayLiquidacion[0][9]='';
			$arrayLiquidacion[0][10]='';
		}

		include('../../view/operaciones/FormLiquidaciones.php');
		$formLiquidaciones = new FormLiquidaciones;
		$formLiquidaciones -> mostrarFormLiquidaciones($arrayVenta,$arrayLiquidacion,$arrayEmpleados,$arrayPuntoVenta);
	}

	public function obtenerListaLiquidaciones($serie,$numero,$empleado,$puntoVenta,$pagina,$direccion){
		$liquidacionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidaciones,$this->claseLiquidaciones);

		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());

		$cantPaginas = $this -> obtenerCantidadPaginas($liquidacionEntity,$serie,$numero,$empleado,$puntoVenta,$cantidad);

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
		}

		$limite=$cantidad*($pagina-1);
		$resultadoListaLiquidaciones = $liquidacionEntity -> obtenerListaLiquidacionesTabla($serie,$numero,$empleado,$puntoVenta,$limite,$cantidad);

		$liquidacionEntity->cerrarConexion();

		$htmlTabla = $this->procesarListaLiquidaciones($resultadoListaLiquidaciones);

		$this -> invocarTablaLiquidaciones($htmlTabla,$arrayEmpleados,$arrayPuntoVenta,$serie,$numero,$empleado,$puntoVenta,$pagina,$cantPaginas);
	}

	public function guardarLiquidacion($especiesValoradas,$validatorForm,$codigo,$metodo,$cantidadRegistros,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro,$pagina){
		$liquidacionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidaciones,$this->claseLiquidaciones);
		$cantidad = parent::_obtenerParametro('CANT_REG_PAG',parent::getConnection());
		$id="";

		$cantPaginas = $this -> obtenerCantidadPaginas($liquidacionEntity,'','','','',$cantidad);

		if ($validatorForm=='N'){

			if ($metodo=='I'){
				$id = $liquidacionEntity -> insertarLiquidacion($serie,$numero,$gestor,$punto,$fecha,$estadoRegistro);
				if ($id!=null && $id!="" && $id>0){
					$liquidacionProductoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidacionProductoEntity,$this->claseLiquidacionProducto);

					for ($i=0;$i<count($especiesValoradas);$i++){
						$liquidacionProductoEntity -> insertarLiquidacionProductos($id,$especiesValoradas[$i],'S');
						$liquidacionProductoEntity -> liquidarDepositos($especiesValoradas[$i]);
					}
				}
			}else{
				for ($i=0;$i<$cantidadRegistros;$i++){
					$liquidacionEntity -> insertarLiquidacion($serie,$numero+$i,$gestor,$punto,$fecha,$estadoRegistro);
				}
			}
		}else if ($validatorForm=='M'){
			$liquidacionEntity -> modificarLiquidacion($codigo,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro);
			$liquidacionProductoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaLiquidacionProductoEntity,$this->claseLiquidacionProducto);
			$liquidacionProductoEntity -> modificarProductos($codigo);

			for ($i=0;$i<count($especiesValoradas);$i++){
				$liquidacionProductoEntity -> insertarLiquidacionProductos($codigo,$especiesValoradas[$i],'S');
				$liquidacionProductoEntity -> liquidarDepositos($especiesValoradas[$i]);
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
		}

		$limite=$cantidad*($pagina-1);
		$resultadoListaLiquidaciones = $liquidacionEntity -> obtenerListaLiquidacionesTabla('','','','',$limite,$cantidad);

		$liquidacionEntity->cerrarConexion();

		$htmlTabla = $this->procesarListaLiquidaciones($resultadoListaLiquidaciones);

		$this -> invocarTablaLiquidaciones($htmlTabla,$arrayEmpleados,$arrayPuntoVenta,'','','','',$pagina,$cantPaginas);
	}

	public function mostrarBusquedaEspeciesValoradas($especies,$puntoVenta,$resultadoCarga,$codigoPuntoVenta){
		$especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEspecieValorada,$this->claseEspecieValorada);


		$resultadoListaEspecieValorada = $especiesValoradasEntity -> obtenerListaEspecieValoradaSeleccionLiquidacion($especies,$codigoPuntoVenta);
		$especiesValoradasEntity->cerrarConexion();


		$htmlTabla = $this->enviaCabeceraDetalleTablaEspecieValorada($resultadoListaEspecieValorada);

		include('../../view/operaciones/FormDetalleEspeciesValoradasLiquidacion.php');
		$formDetalleEspeciesValoradas = new FormDetalleEspeciesValoradasLiquidacion;
		$formDetalleEspeciesValoradas -> mostrarFormDetalleEspeciesValoradas($especies,$htmlTabla,$puntoVenta,$resultadoCarga,$codigoPuntoVenta);
	}
};
?>