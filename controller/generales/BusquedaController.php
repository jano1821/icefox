<?php
include('../../utility/AbstractClass.php');
class BusquedaController extends AbstractClass{
	private $rutaPersona='../../entity/mantenimiento/MantenimientoPersonaEntity.php';
	private $clasePersona='MantenimientoPersonaEntity';
	private $rutaVehiculo='../../controller/mantenimiento/MantenimientoVehiculoController.php';
	private $claseVehiculo='MantenimientoVehiculoController';

	private function invocarTabla($arrayDatos,$arrayTitulos){
		include('../../view/generales/BusquedaTabla.php');

		$busquedaTabla = new BusquedaTabla;
		$busquedaTabla -> mostrarBusquedaTabla($arrayDatos,$arrayTitulos);
	}

	public function ProcesarBusqueda($tablaBusqueda,$valor){
		$arrayDatos = array();
		if ($tablaBusqueda == "BUSQUEDA_PUNTO_VENTA"){
			$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPersona,$this->clasePersona);

			$resultadoPersonas = $mantenimientoPersonaEntity -> obtenerListaPuntosDeVentaConDepositoLiquidado($valor);

			while($row = $resultadoPersonas->fetch_array()){
				$arrayDatos[] = $row;
			}

			$arrayTitulos = array("Acción","Código","Razón Social");

			$this -> invocarTabla($arrayDatos,$arrayTitulos);
		}

		if ($tablaBusqueda == "BUSQUEDA_PUNTO_VENTA_LIQUIDADOS"){
			$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPersona,$this->clasePersona);

			$resultadoPersonas = $mantenimientoPersonaEntity -> obtenerListaPuntosDeVentaConLiquidaciones($valor);

			while($row = $resultadoPersonas->fetch_array()){
				$arrayDatos[] = $row;
			}

			$arrayTitulos = array("Acción","Código","Razón Social");

			$this -> invocarTabla($arrayDatos,$arrayTitulos);
		}

		if ($tablaBusqueda == "BUSQUEDA_VEHICULOS"){
			$mantenimientoVehiculoController = parent::_declaraEntity(parent::getConnection(),$this->rutaVehiculo,$this->claseVehiculo);

			$resultadoVehiculos = $mantenimientoVehiculoController -> buscarVehiculoPorPlaca($valor);

			while($row = $resultadoVehiculos->fetch_array()){
				$arrayDatos[] = $row;
			}

			$arrayTitulos = array("Acción","Código","Placa","Cliente");

			$this -> invocarTabla($arrayDatos,$arrayTitulos);
		}

		if ($tablaBusqueda == "BUSQUEDA_CLIENTES"){
			$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPersona,$this->clasePersona);

			$resultadoClientes = $mantenimientoPersonaEntity -> obtenerListaPersonaTabla($valor,'','S','','C',0,0);

			while($row = $resultadoClientes->fetch_array()){
				$arrayDatos[] = $row;
			}

			$arrayTitulos = array("Acción","Código","Cliente");

			$this -> invocarTabla($arrayDatos,$arrayTitulos);
		}
	}
}
?>