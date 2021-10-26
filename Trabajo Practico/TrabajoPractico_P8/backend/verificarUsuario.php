<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
    if(isset($_SESSION["DNIEmpleado"]))
        $_SESSION["DNIEmpleado"]=NULL;

}

require "empleado.php";

$archivo = fopen("./archivos/empleados.txt", "r");
while(!feof($archivo))
{
    $string = trim(fgets($archivo));
    $array = explode("-", $string);
    if($array[0] != null)
    {
        if($array[1] == $_POST["txtApellido"] && $array[2] == $_POST["txtDni"])
        {
            $_SESSION["DNIEmpleado"] = $_POST["txtDni"];          
            break;
        }
    }  
}

fclose($archivo);
header("Location: validarSesion.php");
?>