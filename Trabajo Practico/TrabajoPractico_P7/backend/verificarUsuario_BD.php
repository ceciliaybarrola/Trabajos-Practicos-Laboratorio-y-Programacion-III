<?php

if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
    if(isset($_SESSION["DNIEmpleado"]))
        $_SESSION["DNIEmpleado"]=NULL;

}
try{
    $user = 'root';
    $pass = '';
    $conectionString='mysql:host=localhost;dbname=fabrica';
    $pdo = new PDO($conectionString, $user, $pass);
    $sentencia = $pdo->prepare('SELECT DNI FROM empleados WHERE DNI = :dni AND apellido = :apellido');
    $sentencia->bindValue(':dni', $_POST["txtDni"], PDO::PARAM_INT);
    $sentencia->bindValue(':apellido', $_POST["txtApellido"], PDO::PARAM_STR);
    $sentencia->execute();

    if($sentencia->fetchAll()){
        $_SESSION["DNIEmpleado"] = $_POST["txtDni"];   
    }
    $pdo = NULL;
}catch(PDOException $exception){
    echo "Error: ". $exception->getMessage();
}
header("Location: validarSesion_BD.php");
?>