<?php
    session_start();
    if(!isset($_SESSION["DNIEmpleado"]))
        header("Location: login.html");

    require "./backend/fabrica.php";

    echo '<title>HTML 5 – Listado de Empleads</title>
            <script src="./javascript/funciones.js" ></script>
            <h2>ELIMINAR EMPLEADOS</h2><br>';
    echo '<div style="text-align:right;padding-right: 50px;">
              <a href="./backend/cerrarSesion.php">Cerrar sesion.</a><br>
          </div>';
    echo '<form id="formMostrar" method="POST" action="index.php">
            <table align="center">
                <tr>												
                    <td> <input type="hidden" name="hdnMostrar" id="hdnMostrar" value="" /> </td>
                </tr>
                <tr>
                    <td colspan="2"><h4>Info</h4></td>
                </tr>
                <tr>
                    <td colspan="2"><hr/></td>
                </tr>';
                $fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);
                $fabrica->TraerDeArchivo("./backend/archivos/empleados.txt");
                $array = $fabrica->GetEmpleados();
                foreach($array as $empleado)
                {           
                    echo'<tr>                  
                             <td>' .$empleado->ToString().':</td>	
                             <td><img src="./backend/'.$empleado->GetPathFoto().'" width="90px" height="90px"/></td>				
                             <td  style="text-align:left;padding-left:15px">      
                             <a href="./backend/eliminar.php?legajo='.$empleado->GetLegajo().'">Eliminar Empleado.</a><br>                       
                             </td>
                             <td colspan="2" align="right">
                                <input type="button" onclick="AdministrarModificar('.$empleado->GetDni().')" id="btnModificar" value="Modificar" />
                             </td>
                         </tr>';    

                }

            echo'<tr>
                    <td colspan="2"><hr/></td>
                </tr>
          </table>
        </form>';

    echo '<a href="index.php">Alta Empleados</a>';
    ?>
