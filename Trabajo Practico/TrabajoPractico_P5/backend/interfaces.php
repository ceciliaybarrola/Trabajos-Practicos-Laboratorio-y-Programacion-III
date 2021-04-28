<?php
interface IArchivos
{
    public function GuardarEnArchivo(string $nombreArchivo);
    public function TraerDeArchivo(string $nombreArchivo);
}
?>