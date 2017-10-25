<?php
class SessionExpirada{
	public function mostrarSessionExpirada($URL){
?>
<html>
	<head>
		<title>Sesion Expirada</title>
	</head>
	<body>
		<form>
			<table width=400 height=300 align=center>
				<tr>
					<td align=center>
						<img src="../../images/SesionExpirada.png" alt="Sesion Finalizada">
					</td>
				</tr>
				<tr>
					<td align=center>
						<a href="<?php echo $URL; ?>">Volver al Login</a>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	}
};
?>