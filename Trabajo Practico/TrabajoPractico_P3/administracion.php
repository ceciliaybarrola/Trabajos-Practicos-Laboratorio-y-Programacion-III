<?php
require "./backend/fabrica.php";

// $empleado = new Empleado($_POST["txtNombre"], $_POST["txtApellido"], $_POST["txtDni"], $_POST["cboSexo"], $_POST["txtLegajo"], $_POST["txtSueldo"], $_POST["rdoTurno"]);

// $archivo = fopen("./backend/archivos/empleados.txt", "a");

// if( fwrite($archivo, $empleado->ToString()))
// {        
//     echo '<a href="mostrar.php">El Empleado se cargo correctamente al archivo. Mostrar Archivo</a>';
// }
// else
// {
//     echo '<a href="index.html">Error al cargar el empleado al archivo. Volver a la pagina principal</a>';
// }

// fclose($archivo)

$empleado = new Empleado($_POST["txtNombre"], $_POST["txtApellido"], $_POST["txtDni"], $_POST["cboSexo"], $_POST["txtLegajo"], $_POST["txtSueldo"], $_POST["rdoTurno"]);
$fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);

$fabrica->TraerDeArchivo("./backend/archivos/empleados.txt");

if($fabrica->AgregarEmpleado($empleado))
{
    $fabrica->GuardarEnArchivo("./backend/archivos/empleados.txt");
    echo '<a href="mostrar.php">El Empleado se cargo correctamente al archivo. Mostrar Archivo</a>';
}
else
{
    echo '<a href="index.html">Error al cargar el empleado al archivo. Volver a la pagina principal</a>';
}



?>