<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sty.css" type="text/css" />
    <title>logica</title>
</head>
<?php


if(isset($_GET["reiniciar"]))
{
	session_destroy();
	header("location:index.php");
}

if($_SESSION["inicio"])
{
	$U=$_SESSION["U"];
	$m=$_SESSION["m"];
	$_SESSION["g"]=$U*$m/(max($U,$m));
	$_SESSION["h"]=$U*$m/(($U+$m)/2);
	$_SESSION["p"]=$_SESSION["g"]+$_SESSION["h"];
	$_SESSION["x"]=($U*$m)-($_SESSION["g"]*3+$_SESSION["h"]*2+$_SESSION["p"])/2;
	$_SESSION["cont"]=0;
	
	for($i=0;$i<$U;$i++)
		for($j=0;$j<$m;$j++)
			$_SESSION["matriz1"][$i][$j]=0;
			
	for($i=0;$i<$U;$i++)
		for($j=0;$j<$m;$j++)
			$_SESSION["matriz2"][$i][$j]=0;
	
	$i=0;	
	while($i<$_SESSION["g"])
	{
		do
		{
			$sentido=rand(1,2);
			$posi=rand(0,$U);
			$posj=rand(0,$m);
			if($sentido==1 && $posi>0 && $posi<$U && $_SESSION["matriz1"][$posi-1][$posj]==0 && $_SESSION["matriz1"][$posi][$posj]==0 && $_SESSION["matriz1"][$posi+1][$posj]==0)
			{
				$_SESSION["matriz1"][$posi-1][$posj]=1;
				$_SESSION["matriz1"][$posi][$posj]=1;
				$_SESSION["matriz1"][$posi+1][$posj]=1;
				break;
			}
			
			if($sentido==2 && $posj>0 && $posj<$m && $_SESSION["matriz1"][$posi][$posj-1]==0 && $_SESSION["matriz1"][$posi][$posj]==0 && $_SESSION["matriz1"][$posi][$posj+1]==0)
			{
				$_SESSION["matriz1"][$posi][$posj-1]=1;
				$_SESSION["matriz1"][$posi][$posj]=1;
				$_SESSION["matriz1"][$posi][$posj+1]=1;
				break;
			}
			
		}while(true);
		$i++;
	}
	
	$i=0;	
	while($i<$_SESSION["h"])
	{
		do
		{
			$sentido=rand(1,2);
			$posi=rand(0,$U);
			$posj=rand(0,$m);
			if($sentido==1 && $posi>0 && $_SESSION["matriz1"][$posi-1][$posj]==0 && $_SESSION["matriz1"][$posi][$posj]==0)
			{
				$_SESSION["matriz1"][$posi-1][$posj]=1;
				$_SESSION["matriz1"][$posi][$posj]=1;
				break;
			}
			
			if($sentido==2 && $posj>0 && $_SESSION["matriz1"][$posi][$posj-1]==0 && $_SESSION["matriz1"][$posi][$posj]==0)
			{
				$_SESSION["matriz1"][$posi][$posj-1]=1;
				$_SESSION["matriz1"][$posi][$posj]=1;
				break;
			}
			
		}while(true);
		$i++;
	}
	
	$i=0;	
	while($i<$_SESSION["p"])
	{
		do
		{			
			$posi=rand(0,$U);
			$posj=rand(0,$m);
			if($_SESSION["matriz1"][$posi][$posj]==0)
			{				
				$_SESSION["matriz1"][$posi][$posj]=1;
				break;
			}
		}while(true);
		$i++;
	}
		
	$_SESSION["inicio"]=false;	
}

if(isset($_GET["fila"]) && isset($_GET["columna"]) && $_SESSION["cont"]<$_SESSION["x"])
{
	if($_SESSION["matriz1"][$_GET["fila"]][$_GET["columna"]]==1)
	{
		$_SESSION["matriz2"][$_GET["fila"]][$_GET["columna"]]=1;
		$_SESSION["cont"]++;
	}
	
	if($_SESSION["matriz1"][$_GET["fila"]][$_GET["columna"]]==0)
	{
		$_SESSION["matriz2"][$_GET["fila"]][$_GET["columna"]]=2;
		$_SESSION["matriz1"][$_GET["fila"]][$_GET["columna"]]=2;
		$_SESSION["cont"]++;
	}
}

if($_SESSION["cont"]>=$_SESSION["x"])
{
	echo "Haz Perdido";
}

?>
<body>
<form id="form1" name="form1" method="get" action="">
  <p>Jugador: <?php echo $_SESSION["nombre"]; ?></p>
  <p>jugadas restantes: <?php echo $_SESSION["x"]-$_SESSION["cont"]; ?></p>
  <p>naves de 3 casillas: <?php echo $_SESSION["g"]; ?></p>
  <p>naves de 2 casillas: <?php echo $_SESSION["h"]; ?></p>
  <p>naves de 1 casilla: <?php echo $_SESSION["p"]; ?></p>
  <table border="1">
    <?php
  for($i=0;$i<$_SESSION["U"];$i++)
  {
  ?>
    <tr>
    <?php
	for($j=0;$j<$_SESSION["m"];$j++)
	{
		if($_SESSION["matriz2"][$i][$j]==0)
		{
		?>
   	  <td><a href="logica.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/azul.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz2"][$i][$j]==1)
		{
		?>
	  <td><a href="logica.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/rojo.jpg"/></a></td>
    	<?php
		}
		if($_SESSION["matriz2"][$i][$j]==2)
		{
		?>
	  <td><a href="logica.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/bom.gif"/></a></td>
    	<?php
		}
	}
	?>
    </tr>
    <?php
  }
  ?>
</table>
  <p>
    <input type="submit" name="reiniciar" id="reiniciar" value="reiniciar" />
  </p>
</form>
</body>
</html>