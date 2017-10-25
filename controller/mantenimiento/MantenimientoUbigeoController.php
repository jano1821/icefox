<?php
include('../../utility/AbstractClass.php');
class MantenimientoUbigeoController extends AbstractClass{
	private $rutaEntityUbigeo = "../../entity/mantenimiento/MantenimientoUbigeoEntity.php";
	private $claseEntityUbigeo= "MantenimientoUbigeoEntity";

	public function obtenerListaDepartamentos(){
		$mantenimientoUbigeoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityUbigeo,$this->claseEntityUbigeo);
		$resultadoListaDepartamentos = $mantenimientoUbigeoEntity->obtenerDepartamentos();
		$arrayDepartamentos = parent::_procesarLista($resultadoListaDepartamentos);

		$mantenimientoUbigeoEntity->cerrarConexion();

		return $arrayDepartamentos;
	}

	public function obtenerListaProvincias($codigoDepartamento,$codigoSeleccion){
		$mantenimientoUbigeoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityUbigeo,$this->claseEntityUbigeo);
		$resultadoListaProvincias = $mantenimientoUbigeoEntity->obtenerProvincias($codigoDepartamento);
		$arrayProvincias = parent::_procesarLista($resultadoListaProvincias);
		$mantenimientoUbigeoEntity->cerrarConexion();

		$comboDinamico = parent::_armarCombo($arrayProvincias,'Provincia','provincia','Seleccionar Provincia','obtenerDistritos(this.value);',$codigoSeleccion);

		return $comboDinamico;
	}

	public function obtenerListaDistritos($codigoProvincia,$codigoSeleccion){
		$mantenimientoUbigeoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityUbigeo,$this->claseEntityUbigeo);
		$resultadoListaDistritos = $mantenimientoUbigeoEntity->obtenerDistritos($codigoProvincia);
		$arrayDistritos = parent::_procesarLista($resultadoListaDistritos);
		$mantenimientoUbigeoEntity->cerrarConexion();

		$comboDinamico = parent::_armarCombo($arrayDistritos,'Distrito','distrito','Seleccionar Distrito','',$codigoSeleccion);

		return $comboDinamico;
	}
};
?>