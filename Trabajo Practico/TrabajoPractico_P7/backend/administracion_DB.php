<?php
require_once "./fabrica.php";
require_once "./empleado.php";
$uploadOk= false;

try{
    $pdo = new PDO('mysql:host=localhost;dbname=fabrica','root' , '');
}catch(PDOException $exception){
    echo "Error: ". $exception->getMessage();
}

$tipoArchivo = pathinfo($_FILES["fileFoto"]["name"], PATHINFO_EXTENSION);
$nuevoNombreArchivo= "fotos/". $_POST["txtApellido"]. "-". $_POST["txtDni"].".". $tipoArchivo;

if (getimagesize($_FILES["fileFoto"]["tmp_name"]) !== FALSE && $_FILES["fileFoto"]["size"]<=1048576 && 
   ($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "gif" || $tipoArchivo == "png" || $tipoArchivo == "bmp"))
    {
        if($_POST["hdnModificar"]=="Modificar"){
            $sentencia = $pdo->prepare('SELECT ruta_foto FROM empleados WHERE DNI = :dni');
            $uploadOk = $sentencia->execute(array("dni" => $_POST["txtDni"])); 
            while($item = $sentencia->fetch()){
                unlink($item[0]);  
            }
                
            $sentencia = $pdo->prepare('DELETE FROM empleados WHERE DNI = :dni');
            $uploadOk = $sentencia->execute(array("dni" => $_POST["txtDni"])); 

        } 
        else if(!file_exists($nuevoNombreArchivo)) {
            $uploadOk = true;
        }
    }

if($uploadOk && move_uploaded_file($_FILES["fileFoto"]["tmp_name"], "./".$nuevoNombreArchivo)){

    try{
        $sentencia = $pdo->prepare('INSERT INTO empleados (nombre, apellido, DNI, sexo, legajo, sueldo, turno, ruta_foto) VALUES (:nombre, :apellido, :dni, :sexo, :legajo, :sueldo, :turno, :ruta_foto)');
        $sentencia->bindParam(":dni", $_POST["txtDni"]);
        $sentencia->bindParam(":nombre", $_POST["txtNombre"]);
        $sentencia->bindParam(":apellido", $_POST["txtApellido"]);
        $sentencia->bindParam(":sexo", $_POST["cboSexo"]);
        $sentencia->bindParam(":legajo", $_POST["txtLegajo"]);
        $sentencia->bindParam(":sueldo", $_POST["txtSueldo"]);
        $sentencia->bindParam(":turno", $_POST["rdoTurno"]);
        $sentencia->bindParam(":ruta_foto", $nuevoNombreArchivo);
        $sentencia->execute();
        include "mostrar_DB.php";        
    }catch(PDOException $exception){
        echo "ERROR AL CARGAR EL EMPLEADO: resultado ".$exception->getMessage();
    }
}
else
{
    echo("ERROR AL CARGAR LA FOTO DEL EMPLEADO. Ingrese un archivo de imagen");
    include "mostrar_DB.php";
}


?>