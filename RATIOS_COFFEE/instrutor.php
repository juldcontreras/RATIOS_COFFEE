


<?php 
include_once'conexion.php';
	session_start();
	if (!isset($_SESSION['rol'])) 
		{
			header('location: login.php');
		}
	else
		{
			if ($_SESSION['rol'] !=2)
				{
					header('location: login.php');
				}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Instruc</title>
</head>
<body>
	<h1>Instructor</h1>
	<form action="login.php" method="POST">
		<input type="submit" value="CerrarSesion" name="cerrar_sesion">
	</form>
</body>
</html>