<?php

abstract class Persona
{
    private $apellido;
    private $dni;
    private $nombre;
    private $sexo;

    public function  __construct(string $nombre, string $apellido, int $dni, string $sexo)
    {
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->dni= $dni;
        $this->sexo= $sexo;
    }
    public function GetApellido()
    {
        return $this->apellido;
    }
    public function GetNombre()
    {
        return $this->nombre;
    }
    public function GetDni()
    {
        return $this->dni;
    }
    public function GetSexo()
    {
        return $this->sexo;
    }
    public abstract function Hablar(array $idioma);

    public function ToString()
    {
        return $this->nombre. "-".$this->apellido. "-". $this->dni."-". $this->sexo;
    }

}


?>