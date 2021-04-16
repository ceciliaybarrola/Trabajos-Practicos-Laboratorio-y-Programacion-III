<?php
require "fabrica.php";

$empleado1 = new Empleado("cecilia", "ybarrola",43407010, "f", 846263, 15369,"mañana");
$empleado2 = new Empleado("nahuel", "silva",19812365, "m", 3264961, 27369,"mañana");
$empleado3 = new Empleado("juan", "pepito",23655432, "m", 258714, 30000,"tarde");
$empleado4 = new Empleado("mateo", "morales",15789436, "m", 7896452, 35000,"tarde");
$empleado5 = new Empleado("melisa", "juarez",87955432, "f", 846236, 20000,"mañana");
$empleado6 = new Empleado("Esteban", "Martinez",465228563, "m", 1536542, 30000,"tarde");
$fabrica = new Fabrica("Restaurante Peperoni's S.A.");


echo "---------------TESTEO TO STRING --------------<br><br>";
echo $empleado1->ToString(). "<br>";
echo $empleado2->ToString(). "<br>";

echo "----------------TESTEO GETTERS ---------------<br><br>";
echo $empleado2->GetNombre(). "<br>";
echo $empleado2->GetApellido(). "<br>";
echo $empleado2->GetDni(). "<br>";
echo $empleado2->GetSexo(). "<br>";
echo $empleado2->GetLegajo(). "<br>";
echo $empleado2->GetSueldo(). "<br>";
echo $empleado2->GetTurno(). "<br>";

echo "----------- TESTEO METODO ABS HABLA ----------<br><br>";
echo $empleado2->Hablar(array("Español", "Portugues", "Guarani")). "<br><br>";

echo "----------- TESTEO AGREGAR A LA FABRICA ----------<br><br>";
$fabrica->AgregarEmpleado($empleado1);
$fabrica->AgregarEmpleado($empleado2);
$fabrica->AgregarEmpleado($empleado2);
//empleado repetido que no se debe agregar
$fabrica->AgregarEmpleado($empleado3);
$fabrica->AgregarEmpleado($empleado4);
$fabrica->AgregarEmpleado($empleado5);
if($fabrica->AgregarEmpleado($empleado6)== false)
    echo "Fabrica llena <br>";
echo $fabrica->ToString(). "<br>";

echo "----------- TESTEO ELIMINAR EN LA FABRICA ----------<br><br>";
$fabrica->EliminarEmpleado($empleado3);
$fabrica->EliminarEmpleado($empleado5);
echo $fabrica->ToString(). "<br>";

echo "------------- TESTEO CALCULAR SUELDOS -------------<br><br>";
echo $fabrica->CalcularSueldos();

?>