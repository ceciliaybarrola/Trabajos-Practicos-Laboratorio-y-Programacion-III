<?php
require "empleado.php";

class Fabrica
{
    private int $cantidadMaxima;
    private array $empleados;
    private string $razonSocial;

    public function __construct(string $razonSocial)
    {
        $this->cantidadMaxima = 5;
        $this->empleados= array();
        $this->razonSocial = $razonSocial;
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
}
