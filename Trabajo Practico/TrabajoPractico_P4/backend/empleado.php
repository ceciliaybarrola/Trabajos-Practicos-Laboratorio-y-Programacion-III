<?php
require "persona.php";
class Empleado extends Persona
{
    protected int $legajo;
    protected float $sueldo;
    protected string $turno;

    public function  __construct(string $nombre, string $apellido, int $dni, string $sexo,int $legajo,float $sueldo,string $turno)
    {
        parent::__construct($nombre, $apellido, $dni, $sexo);
        $this->legajo= $legajo;
        $this->sueldo= $sueldo;
        $this->turno= $turno;
    }
    public function GetLegajo()
    {
        return $this->legajo;
    }
    public function GetSueldo()
    {
        return $this->sueldo;
    }
    public function GetTurno()
    {
        return $this->turno;
    }
    public function Hablar(array $idioma)
    {
        $texto = "El empleado habla ";
        foreach($idioma as $item)
        {
            $texto .= $item .", ";
        }
        return $texto;
    }
    public function ToString()
    {
        return parent::ToString()."-". $this->legajo . "-" . $this->sueldo . "-" . $this->turno;
    }
}
?>