<?php
require "./backend/fabrica.php";
echo "<h2>ELIMINAR EMPLEADOS</h2><br>";

$retorno= false;


$archivo = fopen("./backend/archivos/empleados.txt", "r");
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
    $fabrica = new Fabrica("mc donalds SA", 7);
    $fabrica->TraerDeArchivo("./backend/archivos/empleados.txt");
    if($fabrica->EliminarEmpleado($empleado))
    {
        echo "Empleado eliminado correctamente, se precederá a actualizar el archivo...<br>";
        $fabrica->GuardarEnArchivo("./backend/archivos/empleados.txt");
    }

}

echo '<a href="index.html">Volver a la pagina principal...</a><br>';
echo '<a href="mostrar.php">Volver a la pagina mostrar...</a><br>';
?>