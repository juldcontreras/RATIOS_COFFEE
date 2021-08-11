<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewpor" content="whidth_device_width, initial-scale=1.0">
<meta http-equiv="X-Compatible" content="ie-edge">
<head>
	<title>Login</title>
</head>
<body>
	<center><h1>Inicio de Sesion</h1>
	<form action="#" method="POST">
		Nombre Usuario<br><input type="text" name="nomusuario"><br>
		Contraseña    <br><input type="text" name="clave"><br>
		Sesion            <input type="submit" value="IniciarSesion"><br>
		Limipar			  <input type="reset" value="LimpiarCampos"><br>
	</form>
	</center>
<?php 
	include_once 'conexion.php';
	session_start();
	if (isset($_POST['cerrar_sesion'])) 
		{
			session_unset();
			session_destroy();
		}
	if (isset($_SESSION['rol'])) 
		{
			switch ($_SESSION['rol']) 
			{
				case 1:
					header('Location: administrador.php');
					break;
				case 2:
					header('Location: instructor.php');
					break;
				case 3:
					header('Location: aprendiz.php');
					break;
				case 4:
					header('Location: invitado.php');
					break;
				default:
					echo "no estoy en nada";
					break;
			}
		}
	if (isset($_POST['nomusuario']) && isset($_POST['clave'])) 
		{
			$username = $_POST['nomusuario'];
			$password = $_POST['clave'];
			$db = new Database();
			$query = $db->connect()->prepare('SELECT *FROM usuarios WHERE nomusuario= :nomusuario AND clave = :clave');
			$query->execute(['nomusuario' => $username, 'clave' => $password]);
			$arreglofila = $query->fetch(PDO::FETCH_NUM);
			if ($arreglofila == true) 
				{
				$rol = $arreglofila[3];
				$_SESSION['rol'] = $rol;
				switch ($rol) 
					{
					case 1:
						header('Location: administrador.php');
						break;
					case 2:
						header('Location: instructor.php');
						break;
					case 3:
						header('Location: aprendiz.php');
						break;
					case 4:
						header('Location: invitado.php');
						break;
					default:
						echo "no estoy en nada";
						break;
					}
				}
			else
				{
					echo "Nombre de usuario o contraseña invalido!";
				}
		}
?>
</body>
</html>