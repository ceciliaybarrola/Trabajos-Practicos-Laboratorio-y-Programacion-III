<?php
require "./fabrica.php";
$uploadOk= false;
$empleado = new Empleado($_POST["txtNombre"], $_POST["txtApellido"], $_POST["txtDni"], $_POST["cboSexo"], $_POST["txtLegajo"], $_POST["txtSueldo"], $_POST["rdoTurno"]);
$fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);
$fabrica->TraerDeArchivo("./archivos/empleados.txt");

$tipoArchivo = pathinfo($_FILES["fileFoto"]["name"], PATHINFO_EXTENSION);
$nuevoNombreArchivo= "fotos/". $_POST["txtApellido"]. "-". $_POST["txtDni"].".". $tipoArchivo;

if (getimagesize($_FILES["fileFoto"]["tmp_name"]) !== FALSE && $_FILES["fileFoto"]["size"]<=1048576 && 
   ($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "gif" || $tipoArchivo == "png" || $tipoArchivo == "bmp"))
    {
        if($_POST["hdnModificar"]=="Modificar"){
            foreach($fabrica->GetEmpleados() as $item){
                if($item->GetDni() == $_POST["txtDni"] ){
                    $path = $item->GetPathFoto();
                    unlink($item->GetPathFoto());
                    $fabrica->EliminarEmpleado($item); 
                    $uploadOk = true;
                    break;
                }
            }
        } 
        else if(!file_exists($nuevoNombreArchivo)) {
            $uploadOk = true;
        }
    }

if($uploadOk && move_uploaded_file($_FILES["fileFoto"]["tmp_name"], "./".$nuevoNombreArchivo)){
    $empleado->SetPathFoto($nuevoNombreArchivo);
    
    if($fabrica->AgregarEmpleado($empleado)) {
        $fabrica->GuardarEnArchivo("./archivos/empleados.txt");
        include "mostrar.php";
    }
    else
    {
        echo("ERROR AL CARGAR EL EMPLEADO");
    }
}
else
{
    echo("ERROR AL CARGAR LA FOTO DEL EMPLEADO. Ingrese un archivo de imagen");
    include "mostrar.php";
}


?>