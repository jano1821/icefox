<?php
class ErrorLogueo
{
	public function mostrarErrorLogueo($URL,$imagen)
	{
?>
<html>
	<head>
		<title>Error de Logueo</title>
	</head>
	<body>
		<form>
			<table width=400 height=300 align=center>
				<tr>
					<td align=center>
						<img src="../../images/<?php echo $imagen;?>" alt="Error de Logueo">
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