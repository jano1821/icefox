<?php
include('../../utility/AbstractClass.php');
class LoginController extends AbstractClass{

	public function validarUsuario($usuario,$password){
		$contadorIntentos = 0;
		$cantidadIntentosMaximo = 0;
		$imagen = "";
		$estadoBloqueo = 'V';

		session_unset();

		include('../../entity/principal/LoginEntity.php');
		$loginEntity = new LoginEntity(parent::getConnection());
		$resultadoUsuario = $loginEntity->validarUsuario($usuario,$password);
		$cantResultado = mysqli_num_rows($resultadoUsuario);

		include('../../entity/general/GeneralesEntity.php');
		$generalesEntity = new GeneralesEntity(parent::getConnection(),false);
		$resultadoParametros = $generalesEntity -> obtenerParametro('URL_INICIAL');
		while($row = $resultadoParametros->fetch_array()){
			$_SESSION["URL"] = $row[0];
		}

		if($cantResultado==1){
			$_SESSION["autenticado"]='SI';
			$_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
			$loginEntity->actualizarIntentos($usuario,0,'V');


			if(parent::_sesionActiva()){

				while($row = $resultadoUsuario->fetch_array()){
					$_SESSION["usuario"] = $row[0];
				}

				include('../../view/principal/MenuPrincipalSistema.php');
				$menuPrincipalSistema = new MenuPrincipalSistema;
				$menuPrincipalSistema -> mostrarMenuPrincipalSistema($this->armarCuerpoMenuPrincipal($loginEntity,$usuario));
			}
		}else{
			$resultadoParametros = $generalesEntity -> obtenerParametro('CANTIDAD_INTENTOS');
			while($row = $resultadoParametros->fetch_array()){
				$cantidadIntentosMaximo = $row[0];
			}

			$resultadoUsuario = $loginEntity->obtenerCantidadIntentos($usuario);
			while($row = $resultadoUsuario->fetch_array()){
				$contadorIntentos = $row[0];
			}

			if($contadorIntentos+1 < $cantidadIntentosMaximo-1){
				$resultadoParametros = $generalesEntity -> obtenerParametro('ERROR_LOGUEO');
				while($row = $resultadoParametros->fetch_array()){
					$imagen = $row[0];
				}
				$estadoBloqueo = 'V';
			}elseif($contadorIntentos+1 == $cantidadIntentosMaximo-1){
				$resultadoParametros = $generalesEntity -> obtenerParametro('BLOQUEAR');
				while($row = $resultadoParametros->fetch_array()){
					$imagen = $row[0];
				}

				$estadoBloqueo = 'V';
			}elseif($contadorIntentos+1 >= $cantidadIntentosMaximo){
				$resultadoParametros = $generalesEntity -> obtenerParametro('BLOQUEADA');
				while($row = $resultadoParametros->fetch_array()){
					$imagen = $row[0];
				}
				$estadoBloqueo = 'B';
			}

			$loginEntity->actualizarIntentos($usuario,$contadorIntentos+1,$estadoBloqueo);

			$loginEntity->cerrarConexion();

			include('../../view/generales/ErrorLogueo.php');
			$errorLogueo = new ErrorLogueo;
			$errorLogueo -> mostrarErrorLogueo($_SESSION["URL"],$imagen);
		}
	}

	public function llamarMenuPrincipal(){

		include('../../entity/principal/LoginEntity.php');
		$loginEntity = new LoginEntity(parent::getConnection());

		include('../../view/principal/MenuPrincipalSistema.php');
		$menuPrincipalSistema = new MenuPrincipalSistema;
		$menuPrincipalSistema -> mostrarMenuPrincipalSistema($this->armarCuerpoMenuPrincipal($loginEntity,$_SESSION['usuario']));
	}

	private function armarCuerpoMenuPrincipal($loginEntity,$usuario){

		$menuPrincipal = '';

		$resultadoMenus = $loginEntity->obtenerMenuUsuario($usuario);
		while($row = $resultadoMenus->fetch_array()){
			$arrayMenu[] = $row;
		}

		$resultadoSubGrupos = $loginEntity -> obtenerSubGrupo($usuario);
		while($row = $resultadoSubGrupos->fetch_array()){
			$arraySubGrupos[] = $row;
		}

		$resultadoGrupos = $loginEntity -> obtenerGrupo($usuario);
		while($row = $resultadoGrupos->fetch_array()){
			$arrayGrupos[] = $row;
		}

		for ($grupo=0;$grupo<count($arrayGrupos);$grupo++){
			$menuPrincipal .= '<li><a href="#">'.$arrayGrupos[$grupo][1].'</a>';
			$menuPrincipal .= '<div class="cbp-hrsub">';
			$menuPrincipal .= '<div class="cbp-hrsub-inner">';

			for ($subGrupo=0;$subGrupo<count($arraySubGrupos);$subGrupo++){
				if ($arraySubGrupos[$subGrupo][3]==$arrayGrupos[$grupo][0]){
					$menuPrincipal .= '<div>';
					$menuPrincipal .= '<h4>'.$arraySubGrupos[$subGrupo][1].'</h4>';
					for ($menu=0;$menu<count($arrayMenu);$menu++){
						$menuPrincipal .= '<ul>';
						if ($arrayMenu[$menu][4]==$arraySubGrupos[$subGrupo][0]){
							//$menuPrincipal .= '<li><a href="'.$_SESSION["URL"].$arrayMenu[$menu][2].'">'.$arrayMenu[$menu][1].'</a></li>';
							$menuPrincipal.= '<li><a href="#" onclick="javascript:envioDatosMenu('.$arrayMenu[$menu][0].');">'.$arrayMenu[$menu][1].'</a></li>';
						}
						$menuPrincipal .= '</ul>';
					}
					$menuPrincipal .= '</div>';
				}
			}
			$menuPrincipal .= '</div>';
			$menuPrincipal .= '</div>';
			$menuPrincipal .= '</li>';
		}

		return $menuPrincipal;
	}
}
?>