<?php
    require "./backend/empleado.php";

    echo "<title>HTML 5 – Listado de Empleads</title>";
    echo "<h2>ELIMINAR EMPLEADOS</h2><br>";
    echo '<form id="formLogin" >
            <table align="center">
                <tr>
                    <td colspan="2"><h4>Info</h4></td>
                </tr>
                <tr>
                    <td colspan="2"><hr/></td>
                </tr>';

    $archivo = fopen("./backend/archivos/empleados.txt", "r");
    while(!feof($archivo))
    {
        $string = trim(fgets($archivo));
        $array = explode("-", $string);
        if($array[0] != null)
        {
            $empleado= new Empleado($array[0],$array[1], $array[2], $array[3], $array[4], $array[5], $array[6]);
           
           echo '<tr>                  
                    <td>' .$empleado->ToString().':</td>					
                    <td  style="text-align:left;padding-left:15px">      
                    <a href="./eliminar.php?legajo='.$array[4].'">Eliminar Empleado.</a><br>                       
                    </td>
                </tr>';    
        }  
    }
    fclose($archivo);
    echo '      <tr>
                    <td colspan="2"><hr/></td>
                </tr>
          </table>
        </form>';

    echo '<a href="index.html">Alta Empleados</a>';
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