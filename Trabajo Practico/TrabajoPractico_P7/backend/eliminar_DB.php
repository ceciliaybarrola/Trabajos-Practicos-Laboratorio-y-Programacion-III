<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=fabrica','root' , '');
        $sentencia = $pdo->prepare('SELECT ruta_foto FROM empleados WHERE legajo = :legajo');
        
        if($sentencia->execute(array("legajo" => $_GET["legajo"])))
        {    
            while($item = $sentencia->fetch()){
                if(file_exists($item[0]))
                {
                    unlink($item[0]);
                    break;
                }
            }               
            $sentencia = $pdo->prepare('DELETE FROM empleados WHERE legajo = :legajo');

            if( $sentencia->execute(array("legajo" => $_GET["legajo"])))
            {
                include "mostrar_DB.php";
            }     
        }             
    }catch(PDOException $e)
    {
        echo('ERROR: '. $e->getMessage());
    }
?>