<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Document</title>
</head>
<?php
if(isset($_POST["jugar"]))
{
	if(is_numeric($_POST["U"]) && is_numeric($_POST["U"]) && $_POST["U"]>4 && $_POST["U"]<21 && $_POST["U"]>4 && $_POST["U"]<21 && $_POST["nombre"]!=NULL)
	{
		$_SESSION["U"]=$_POST["U"];
		$_SESSION["m"]=$_POST["m"];
		$_SESSION["nombre"]=$_POST["nombre"];
		$_SESSION["inicio"]=true;
		header("location:logica.php");		
	}
	else
	{
		echo "Por favor ingrese numeros entre 5 y 20 y asegurese de escribir su nombre \n";	
	}
}
?>
<body>
<form id="form1" name="form1" method="post" action="">
  <p>Tamaño:
    <input name="U" type="text" id="textfield" size="10" />
    X
    <input name="m" type="text" id="textfield2" size="10" />
  </p>
  <p>Nombre:
    <input type="text" name="nombre" id="nombre" />
    <input type="submit" name="jugar" id="jugar" value="Jugar" />
  </p>
    
</body>
</html>