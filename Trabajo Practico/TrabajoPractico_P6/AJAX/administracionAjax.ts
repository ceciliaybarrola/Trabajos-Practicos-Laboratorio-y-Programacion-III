/// <reference path="ajax.ts" />

export function Ajax_AdministrarModificar()
{

}
export function Ajax_AdministrarEliminar()
{
    let ajax : Ajax = new Ajax();
    ajax.Get("http://localhost/trabajo%20practico/trabajopractico_p6/backend/eliminar.php", Success, "p=hola", Fail);
}
export function Ajax_AdministrarAlta()
{
    
}
export function Ajax_AdministrarMostrar()
{
    
}

function Success(retorno:string):void {
    console.clear();
    console.log(retorno);
}

function Fail(retorno:string):void {
    console.clear();
    console.log(retorno);
}