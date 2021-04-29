<?php
require "./fabrica.php";
$uploadOk= false;
$empleado = new Empleado($_POST["txtNombre"], $_POST["txtApellido"], $_POST["txtDni"], $_POST["cboSexo"], $_POST["txtLegajo"], $_POST["txtSueldo"], $_POST["rdoTurno"]);
$fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);
$fabrica->TraerDeArchivo("./archivos/empleados.txt");

if($_POST["hdnModificar"]=="Modificar")
{
    foreach($fabrica->GetEmpleados() as $item){
        if($item->GetDni() == $_POST["txtDni"] ){
            $path = $item->GetPathFoto();
            unlink($item->GetPathFoto());
            $fabrica->EliminarEmpleado($item); 
            break;
        }
    }
}

$tipoArchivo = pathinfo($_FILES["fileFoto"]["name"], PATHINFO_EXTENSION);
$nuevoNombreArchivo= "fotos/". $_POST["txtApellido"]. "-". $_POST["txtDni"].".". $tipoArchivo;

if(getimagesize($_FILES["fileFoto"]["tmp_name"]) !== FALSE && $_FILES["fileFoto"]["size"]<=1000000 && !file_exists($nuevoNombreArchivo))
{
	if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "gif" || $tipoArchivo == "png" || $tipoArchivo == "bmp") {

		$uploadOk = true;
	}
}

if($uploadOk && move_uploaded_file($_FILES["fileFoto"]["tmp_name"], "./".$nuevoNombreArchivo))
{
    $empleado->SetPathFoto($nuevoNombreArchivo);
    
    if($fabrica->AgregarEmpleado($empleado)) {
        $fabrica->GuardarEnArchivo("./archivos/empleados.txt");
        echo '<a href="mostrar.php">El Empleado se cargo correctamente al archivo. Mostrar Archivo</a>';
    } else {
        echo '<a href="../index.php">Error al cargar el empleado al archivo. Volver a la pagina principal</a>';
    }
} else {
    echo '<a href="../index.php">Error al cargar validar la foto. Volver a la pagina principal</a>';
}



?>