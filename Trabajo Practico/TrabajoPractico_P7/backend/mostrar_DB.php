<?php
if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(!isset($_SESSION["DNIEmpleado"]))
	header("Location: ../login.html");
require_once 'empleado.php';
try{
    $user = 'root';
    $pass = '';
    $conectionString='mysql:host=localhost;dbname=fabrica';
    $pdo = new PDO($conectionString, $user, $pass);
    $sentencia = $pdo->prepare('SELECT * FROM empleados');
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();

    echo '<h2>Listado de empleados</h2><table align="right"><tr><td><input type="hidden" name="hdnMostrar" id="hdnMostrar" value="" /> </td></tr><tr><td colspan="2"><h4>Info</h4></td></tr><tr><td colspan="2"><hr/></td></tr>';
    
    foreach($resultado as $item)
    {    		
        $empleado = new Empleado($item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6]);
        $empleado->SetPathFoto($item[7]);

        echo'<tr>                  
             <td>' .$empleado->ToString().':</td>	
             <td><img src="./'.$empleado->GetPathFoto().'" width="90px" height="90px"/></td>				
             <td  style="text-align:left;padding-left:15px">  
             <input type="button" onclick="Ajax_AdministrarEliminar_DB('.($empleado->GetLegajo()).')" id="btnEliminar" value="Eliminar" />                          
             </td>
             <td colspan="2" align="right">
             <input type="button" onclick="AdministrarModificar_DB('.$empleado->GetDni().')" id="btnModificar" value="Modificar" />
             </td>';      
    }
    echo '<tr><td colspan="2"><hr/></td></tr></table></tr>';
}catch(PDOException $exception){
    echo "Error: ". $exception->getMessage();
}

$pdo = NULL;
?>