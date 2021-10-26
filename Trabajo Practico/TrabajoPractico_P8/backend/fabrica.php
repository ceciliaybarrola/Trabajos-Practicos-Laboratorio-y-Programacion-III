<?php
require "empleado.php";
require "interfaces.php";
class Fabrica implements IArchivos
{
    private $cantidadMaxima;
    private $empleados;
    private $razonSocial;

    public function __construct(string $razonSocial, int $cantidadMaxima = 5)
    {
        $this->cantidadMaxima = $cantidadMaxima;
        $this->empleados= array();
        $this->razonSocial = $razonSocial;
    }
    public function GetEmpleados()
    {
        return $this->empleados;
    }
    public function AgregarEmpleado(Empleado $empleado)
    {
        $retorno = false;
        if(count($this->empleados) < $this->cantidadMaxima)
        {
            array_push($this->empleados, $empleado);          
            $this->EliminarEmpleadoRepetido();
            $retorno = true;
        }
        return $retorno;
    }
    public function EliminarEmpleado(Empleado $empleado)
    {
        $retorno = false;

        foreach($this->empleados as $key => $item)
        {
            if($item==$empleado)
            {
                unset($this->empleados[$key]);    
                $retorno = true;          
                break;
            }
        }
        return $retorno;
    }    
    private function EliminarEmpleadoRepetido()
    {
        $this->empleados=array_unique($this->empleados, SORT_REGULAR);
    }  
    public function CalcularSueldos()
    {
        $acumuladorSueldos=0;
        foreach($this->empleados as $item)
        {
            $acumuladorSueldos += $item->GetSueldo();
        }
        return $acumuladorSueldos;
    }  

    public function ToString()
    {
        $texto = $this->cantidadMaxima ."-". $this->razonSocial ."-";
        foreach($this->empleados as $item)
        {
            $texto .= $item->ToString() . "-";
        }
        return $texto;
    }

    // Recibe el nombre del archivo de texto donde se guardarán los
    // empleados de la fábrica (empleados.txt). Recorre el array de Empleados y sobreescribe en
    // el archivo de texto, utilizando el método ToString.
    public function GuardarEnArchivo(string $nombreArchivo)
    {
        $archivo = fopen($nombreArchivo, "w");

        foreach($this->empleados as $item)
        {
            fwrite($archivo, $item->ToString()."\r\n" );
        }

        fclose($archivo);
    }
    // Recibe el nombre del archivo de texto donde se encuentran los empleados
    // (empleados.txt). Por cada registro leído, genera un objeto de tipo Empleado y lo agrega a la
    // fábrica (utilizando el método AgregarEmpleado).
    public function TraerDeArchivo(string $nombreArchivo)  
    {
        $extensiones = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");

        $archivo = fopen($nombreArchivo, "r");
        while(!feof($archivo))
        {
            $string = trim(fgets($archivo));
            $array = explode("-", $string);
            if($array[0] != null)
            {
                $empleado= new Empleado($array[0],$array[1], $array[2], $array[3], $array[4], $array[5], $array[6]);
                $nombre = "./fotos/".$array[1]."-".$array[2];
                
                foreach($extensiones as $extension)
                {
                    if(file_exists($nombre . $extension))
                    {
                         $empleado->SetPathFoto("fotos/" .$array[1]."-".$array[2]. $extension);
                         break;
                    }
                }
                            
                $this->AgregarEmpleado($empleado);  
            }  
        }

        fclose($archivo);
    }
}
