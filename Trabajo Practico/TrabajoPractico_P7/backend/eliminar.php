<?php
require "./fabrica.php";

$retorno= false;
$archivo = fopen("./archivos/empleados.txt", "r");
while(!feof($archivo))
{
    $string = trim(fgets($archivo));
    $array = explode("-", $string);
    if($array[0] != null)
    {
        if($array[4] == $_GET["legajo"])
        {
            $empleado= new Empleado($array[0],$array[1], $array[2], $array[3], $array[4], $array[5], $array[6]);
            $retorno= true;
            break;
        }
    }  
}
fclose($archivo);
if($retorno)
{    
    $extensiones = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
    $nombre = "./fotos/".$empleado->GetApellido()."-".$empleado->GetDni();
    
    foreach($extensiones as $extension)
    {
        if(file_exists($nombre . $extension))
        {
             unlink($nombre. $extension);
             break;
        }
    } 

    $fabrica = new Fabrica("mc donalds SA", 7);
    $fabrica->TraerDeArchivo("./archivos/empleados.txt");
    if($fabrica->EliminarEmpleado($empleado))
    {
        $fabrica->GuardarEnArchivo("./archivos/empleados.txt");
        include "mostrar.php";
    }

}

?>