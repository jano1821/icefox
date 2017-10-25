<?php
include('../../utility/AbstractClass.php');
class MantenimientoClasesController extends AbstractClass{
	private $rutaEntityClases = "../../entity/mantenimiento/MantenimientoClasesEntity.php";
	private $claseEntityClases= "MantenimientoClasesEntity";
	private $rutaEntityPersona = "../../entity/mantenimiento/MantenimientoPersonaEntity.php";
	private $claseEntityPersona= "MantenimientoPersonaEntity";
	private $rutaEntityTipoDocumento = "../../entity/mantenimiento/MantenimientoTipoDocumentoEntity.php";
	private $claseEntityTipoDocumento= "MantenimientoTipoDocumentoEntity";

	private function obtenerClases($codigo){
		$mantenimientoClasesEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityClases,$this->claseEntityClases);
		$resultadoListaClases = $mantenimientoClasesEntity -> obtenerClasePorPersona($codigo);
		$mantenimientoClasesEntity->cerrarConexion();

		$arrayClases = parent::_procesarLista($resultadoListaClases);

		return $arrayClases;
	}

	public function mostrarFormularioMantenimientoClases($codigo){

		$arrayClases = array();
		$arrayClases = $this->obtenerClases($codigo);

		include('../../view/mantenimientos/FormMantenimientoClases.php');
		$formMantenimientoClases = new FormMantenimientoClases;
		$formMantenimientoClases -> mostrarFormMantenimientoClases($arrayClases,$codigo);
	}

	public function guardarFormularioMantenimientoClases($codigo,$proveedor,$cliente,$empleado,$puntoVenta){
		$mantenimientoClasesEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityClases,$this->claseEntityClases);

		//***********************Proveedores****************************/
		if ($proveedor==0){
			$resultadoProveedor = $mantenimientoClasesEntity -> buscarClaseProveedor($codigo);
			$arrayProveedor = parent::_procesarLista($resultadoProveedor);
			if ($arrayProveedor[0][0]>0){
				$resultadoProveedor = $mantenimientoClasesEntity->evaluarDependenciasProveedores($codigo);
				$arrayProveedor = parent::_procesarLista($resultadoProveedor);
				if ($arrayProveedor[0][0]>0){
					echo '<script language="javascript">alert("La persona tiene dependencias de proveedor, no se puede deshabilitar esta clase");</script>';
				}else{
					$mantenimientoClasesEntity -> eliminarClaseProveedor($codigo);
				}
			}
		}else{
			$resultadoProveedor = $mantenimientoClasesEntity -> buscarClaseProveedor($codigo);
			$arrayProveedor = parent::_procesarLista($resultadoProveedor);
			if ($arrayProveedor[0][0]==0){
				$mantenimientoClasesEntity -> insertarClaseProveedor($codigo);
			}
		}

		/*****************************empleados**********************************/
		if ($empleado==0){
			$resultadoEmpleado = $mantenimientoClasesEntity -> buscarClaseEmpleado($codigo);
			$arrayEmpleado = parent::_procesarLista($resultadoEmpleado);
			if ($arrayEmpleado[0][0]>0){
				$resultadoEmpleado = $mantenimientoClasesEntity->evaluarDependenciasEmpleados($codigo);
				$arrayEmpleado = parent::_procesarLista($resultadoEmpleado);
				if ($arrayEmpleado[0][0]>0){
					echo '<script language="javascript">alert("La persona tiene dependencias de empleado, no se puede deshabilitar esta clase");</script>';
				}else{
					$mantenimientoClasesEntity -> eliminarClaseEmpleado($codigo);
				}
			}
		}else{
			$resultadoEmpleado = $mantenimientoClasesEntity -> buscarClaseEmpleado($codigo);
			$arrayEmpleado = parent::_procesarLista($resultadoEmpleado);
			if ($arrayEmpleado[0][0]==0){
				$mantenimientoClasesEntity -> insertarClaseEmpleado($codigo);
			}
		}

		/*****************************clientes*************************************/
		if ($cliente==0){
			$resultadoCliente = $mantenimientoClasesEntity -> buscarClaseCliente($codigo);
			$arrayCliente = parent::_procesarLista($resultadoCliente);
			if ($arrayCliente[0][0]>0){
				$resultadoCliente = $mantenimientoClasesEntity->evaluarDependenciasClientes($codigo);
				$arrayCliente = parent::_procesarLista($resultadoCliente);
				if ($arrayCliente[0][0]>0){
					echo '<script language="javascript">alert("La persona tiene dependencias de punto de venta, no se puede deshabilitar esta clase");</script>';
				}else{
					$mantenimientoClasesEntity -> eliminarClaseCliente($codigo);
				}
			}
		}else{
			$resultadoCliente = $mantenimientoClasesEntity -> buscarClaseCliente($codigo);
			$arrayCliente = parent::_procesarLista($resultadoCliente);
			if ($arrayCliente[0][0]==0){
				$mantenimientoClasesEntity -> insertarClaseCliente($codigo);
			}
		}

		/*****************************punto de venta*************************************/
		if ($puntoVenta==0){
			$resultadoPuntoVenta = $mantenimientoClasesEntity -> buscarClasePuntoVenta($codigo);
			$arrayPuntoVenta = parent::_procesarLista($resultadoPuntoVenta);
			if ($arrayPuntoVenta[0][0]>0){
				$resultadoPuntoVenta = $mantenimientoClasesEntity->evaluarDependenciasPuntoventa($codigo);
				$arrayPuntoVenta = parent::_procesarLista($resultadoPuntoVenta);
				if ($arrayPuntoVenta[0][0]>0){
					echo '<script language="javascript">alert("La persona tiene dependencias de punto de venta, no se puede deshabilitar esta clase");</script>';
				}else{
					$mantenimientoClasesEntity -> eliminarClasePuntoVenta($codigo);
				}
			}
		}else{
			$resultadoPuntoVenta = $mantenimientoClasesEntity -> buscarClasePuntoVenta($codigo);
			$arrayPuntoVenta = parent::_procesarLista($resultadoPuntoVenta);
			if ($arrayPuntoVenta[0][0]==0){
				$mantenimientoClasesEntity -> insertarClasePuntoVenta($codigo);
			}
		}

		/************************************invoca formulario***********************************/
		$mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityPersona,$this->claseEntityPersona);
		$mantenimientoTipoDocumentoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityTipoDocumento,$this->claseEntityTipoDocumento);

		$arrayTipoDocumento = array();

		$resultadoTipoDocumento = $mantenimientoTipoDocumentoEntity -> obtenerListaTiposDocumento('','');
		$arrayTipoDocumento = parent::_procesarLista($resultadoTipoDocumento);

		if($codigo==''){
			$arrayPersona = array();
		}else{
			$resultadoPersona = $mantenimientoPersonaEntity -> obtenerPersona($codigo);

			$arrayPersona = parent::_procesarLista($resultadoPersona);
		}

		$mantenimientoPersonaEntity->cerrarConexion();

		include('../../view/mantenimientos/FormMantenimientoPersona.php');
		$formMantenimientoPersona = new FormMantenimientoPersona;
		$formMantenimientoPersona -> mostrarFormMantenimientoPersona($arrayPersona,$arrayTipoDocumento);
	}
}
?>