<?php
    require "./backend/empleado.php";

    $archivo = fopen("./backend/archivos/empleados.txt", "r");
    echo "<h2>ELIMINAR EMPLEADOS</h2><br>";

    while(!feof($archivo))
    {
        $string = trim(fgets($archivo));
        $array = explode("-", $string);
        if($array[0] != null)
        {
            $empleado= new Empleado($array[0],$array[1], $array[2], $array[3], $array[4], $array[5], $array[6]);
            echo $empleado->ToString() . ": ";
            echo '<a href="./eliminar.php?legajo='.$array[4].'">Eliminar Empleado.</a><br>';    
        }  
    }
    fclose($archivo);
    
    echo '<a href="index.html">Volver a la pagina principal...</a>';
?>
<!-- 
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Empleados</title>
		<script src="./javascript/funciones.js" ></script>
	</head>
	<body class="container"> 
        <h2>ELIMINAR EMPLEADOS</h2>	

		<form action="./eliminar.php" method="GET">
			<table align="center">
                     <?php
                    // require "./backend/empleado.php";
                    // $archivo = fopen("./backend/archivos/empleados.txt", "r");

                    // while(!feof($archivo))
                    // {
                    //     $string = trim(fgets($archivo));
                    //     $array = explode("-", $string);
                    //     if($array[0] != null)
                    //     {
                    //         $empleado= new Empleado($array[0],$array[1], $array[2], $array[3], $array[4], $array[5], $array[6]);
                    //         echo "<td>".$empleado->ToString(). ":</td>";                           
                    //         echo '<tr>
                    //                  <td colspan="2" align="right">
                    //                      <input type="submit" name="btnEliminar" id="btnEliminar" placeholder="Eliminar" value="' .$array[4]. '" />
                    //                  </td>
                    //               </tr>';
                    //     }  
                    // }
                    // fclose($archivo);
                    ?>
			</table>
		</form>
		
	</body>
</html> -->