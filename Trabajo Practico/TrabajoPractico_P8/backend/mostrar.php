<?php
if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(!isset($_SESSION["DNIEmpleado"]))
	header("Location: ../login.html");

$fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);
$fabrica->TraerDeArchivo("./archivos/empleados.txt");
$array = $fabrica->GetEmpleados();

echo '<h2>Listado de empleados</h2>
        <table align="right">
            <tr>												
                <td> <input type="hidden" name="hdnMostrar" id="hdnMostrar" value="" /> </td>
            </tr>
            <tr>
                <td colspan="2"><h4>Info</h4></td>
            </tr>
            <tr>
                <td colspan="2"><hr/></td>
            </tr>  ';


foreach($array as $empleado)
{    		
        echo'<tr>                  
                <td>' .$empleado->ToString().':</td>	
                <td><img src="./'.$empleado->GetPathFoto().'" width="90px" height="90px"/></td>				
                <td  style="text-align:left;padding-left:15px">  
                    <input type="button" onclick="Ajax_AdministrarEliminar('.($empleado->GetLegajo()).')" id="btnEliminar" value="Eliminar" />                          
                </td>
                <td colspan="2" align="right">
                    <input type="button" onclick="AdministrarModificar('.$empleado->GetDni().')" id="btnModificar" value="Modificar" />
                </td>';      
}
echo '<tr>
        <td colspan="2"><hr/></td>
        </tr>
        </table>
    </tr>'
?>