<?php 
include_once'conexion.php';
	session_start();
	if (!isset($_SESSION['rol'])) 
		{
			header('location: login.php');
		}
	else
		{
			if ($_SESSION['rol'] !=1)
				{
					header('location: login.php');
				}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invita</title>
	<link rel="stylesheet" type="text/css" href="estiloinv.css">
</head>
<body>
	<h1><font color="white">Invitado</font></h1>





<?php
$conexion=mysqli_connect("localhost","root","","crud") or die ("Problemas en la conexion");

//echo "conxion exitosa";
 ?>

<!-- <head>
	<title>Manejo de crud en php</title>
</head> -->
<body >
	<h1 align="center"><font color="white"> Consulta de usuarios</font></h1>
	<!-- <h1> formulario Crud</h1>
	<form method="POST" action="formulario.php" align="center">
		NOMNRE<input type="text" name="usuario"><br>
		CLAVE <input type="password" name="clave"><br>
		IDROL <input type="text" name="idrol"><br>
		EMAIL <input type="text" name="email"><br>	
		ENVIAR <input type="submit" name="insertar" value="insertar datos">
	</form> -->

<?php

if (isset($_POST['insertar'])) 

	{

		$usuario=$_POST['usuario'];
		$clave=  $_POST['clave'];
		$idrol=  $_POST['idrol'];
		$email=  $_POST['email'];

		$insertar="INSERT INTO usuarios(nomusuario,clave,idrol,email) values ('$usuario','$clave','$idrol','$email')";
		$ejecutar=mysqli_query($conexion,$insertar);
		if ($ejecutar) 
			{
				echo "<script>windows.open('formulario.php')</script>";
			}
	}
?>
<table border="3" align="center">
	<tr style="background-color: red">
		<th>ID</th>
		<th>USUARIOS</th>
		<th>PASSWORD</th>
		<th>IDROL</th>
		<th>EMAIL</th>

		<th>BORRAR</th>
		<th>EDITAR</th> 
	</tr>
	<?php
	$consulta="SELECT *FROM usuarios";
	$ejecutar=mysqli_query($conexion,$consulta);
	$i=0;
	while ($fila=mysqli_fetch_array($ejecutar) )
		{
			$id=	  $fila['id'];
			$usuario= $fila['nomusuario'];
			$password=$fila['clave'];
			$idrol=	  $fila['idrol'];
			$email=	  $fila['email'];
			$i++;
	?>
		<tr align="center">
			<td><?php echo $id ?> </td>
			<td><?php echo $usuario ?> </td>
			<td><?php echo $password ?> </td>
			<td><?php echo $idrol ?> </td>
			<td><?php echo $email ?> </td>

			<td><a href="formulario.php? editar= <?php echo $id; ?>">Editar</a> </td> 
			 <td><a href="formulario.php? borrar= <?php echo $id; ?>">Borrar</a> </td> 
		</tr>
<?php
		}
?>
</table>

<?php
if(isset($_GET['editar']))
	{
		include('editar.php');
	}
?>
<?php
if(isset($_GET['borrar']))
	{
		$borrar_id=$_GET['borrar'];
		$borrar="DELETE FROM usuarios WHERE id='$borrar_id'";
		$ejecutar=mysqli_query($conexion,$borrar);
		if ($ejecutar) 
		{
			echo "<script>windows.open('formulario.php')</script>";
		}
		else
		{
			echo "<script> alert('noooooooooooo')</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<h1>Administrador</h1>
<form action="login.php" method="POST">
	<input type="submit" value="CerrarSesion" name="cerrar_sesion">
</form>

</body>
</html>