<?php
class BusquedaTabla{
	public function mostrarBusquedaTabla($arrayDatos,$arrayTitulos){
		?>
		<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		.wrapper {
		  display: grid;
		  grid-template-columns: 50px 100px 290px;
		  grid-gap: 2px;
		  background-color: #fff;
		  color: #444;
		}

		.boxhead {
		  background-color: #444;
		  color: #fff;
		  border-radius: 5px;
		  padding: 5px;
		  font-size: 10px;
		  font-family: Verdana, Arial, Helvetica, sans-serif;
		}

		.boxbody {
		  background-color: #E0E6F8;
		  color: #151515;
		  border-radius: 5px;
		  padding: 5px;
		  font-size: 10px;
		  font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		</style>
	</head>
	<body>

		<div class="wrapper">
		<?php
		for ($i=0;$i<count($arrayTitulos);$i++){
			?>
			<div class="boxhead"><?php echo $arrayTitulos[$i];?></div>
			<?php
		}

		for ($i=0;$i<count($arrayDatos);$i++){
		?>
			<div class="boxbody" align="center"><a href="#" onClick="seleccionar('<?php echo $arrayDatos[$i][0];?>','<?php echo $arrayDatos[$i][1];?>');"><img src="../../images/select.png" width="25" height="20" border="0"></a></div>
		<?php
			for($e=0;$e<2;$e++){
			?>
				<div class="boxbody"><?php echo $arrayDatos[$i][$e];?></div>
			<?php
			}
		}
		?>
		</div>


	</body>
	<script type="text/javascript">
			function seleccionar(codigo,descripcion){
				window.parent.agregarAnterior(codigo,descripcion)
			}


		</script>
</html>
		<?php
	}
}
?>