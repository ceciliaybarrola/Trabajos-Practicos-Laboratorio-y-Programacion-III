<?php

require_once __DIR__ . '/vendor/autoload.php';
include_once "fabrica.php";
session_start();

header('content-type:application/pdf');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);

$mpdf->SetHeader('Cecilia Ybarrola || {PAGENO}{nbpg}');
$mpdf->SetProtection(array(),$_SESSION['DNIEmpleado'],"MyPassword");
$mpdf->SetFooter("https://host-usuarios2.000webhostapp.com/login.html");

$fabrica = new Fabrica("fabrica S.A",7);
$fabrica->TraerDeArchivo("./archivos/empleados.txt");
$array = $fabrica->GetEmpleados();

$tablaEmpleados = '<table class="table" border="1" align="center">
            <thead>
                <tr>
                    <th>  Nombre     </th>
                    <th>  Apellido   </th>
                    <th>  Dni        </th>
                    <th>  Sexo       </th>
                    <th>  Legajo     </th>
                    <th>  Sueldo     </th>
                    <th>  Turno      </th>
                    <th>  Foto       </th>
                </tr> 
            </thead>';   	

foreach ($fabrica->GetEmpleados() as $empleado){
    $tablaEmpleados .= "<tr>
                    <td>".$empleado->GetNombre()."</td>
                    <td>".$empleado->GetApellido()."</td>
                    <td>".$empleado->GetDni()."</td>
                    <td>".$empleado->GetSexo()."</td>
                    <td>".$empleado->GetLegajo()."</td>
                    <td>".$empleado->GetSueldo()."</td>
                    <td>".$empleado->GetTurno()."</td>
                    <td>"."<img src='{$empleado->GetPathFoto()}' width='90px' height='90px'></td>
                </tr>";
}

$tablaEmpleados .= '</table>';

$mpdf->WriteHTML("<h3>Listado de empleados</h3>");
$mpdf->WriteHTML("<br>");

$mpdf->WriteHTML($tablaEmpleados);


$mpdf->Output('mi_pdf.pdf', 'I');