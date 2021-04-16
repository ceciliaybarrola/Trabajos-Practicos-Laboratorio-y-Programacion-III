function ValidarCamposVacios(idValor:string) : boolean
{   
    return ((<HTMLInputElement> document.getElementById(idValor)).value).length > 0;
}

function ValidarRangoNumerico(valor:number, minimo:number, maximo:number): boolean
{
    return (valor >= minimo && valor <= maximo);
}

function ValidarCombo(idValor:string, valorEvitar:string): boolean
{
    return (<HTMLInputElement> document.getElementById(idValor)).value !== valorEvitar;
}
function ObtenerTurnoSeleccionado(): string
{
    var turnoSeleccionado : string = "";
    var turnosDisponibles = document.getElementsByName("rdoTurno");

    turnosDisponibles.forEach(element => {
        if((<HTMLInputElement> element).checked)
        {
            turnoSeleccionado = (<HTMLInputElement> element).value;
        }
    });
        
    return turnoSeleccionado;
}
function ObtenerSueldoMaximo(turno:string): number
{
    var sueldoMaximo:number = 0;

    switch(turno)
    {
        case "Mañana":
            sueldoMaximo = 20000;
            break;
        case "Tarde" :
            sueldoMaximo = 18500;
            break;
        case "Noche" :
            sueldoMaximo = 25000;
            break;
    }

    return sueldoMaximo;
}
function AdministrarSpanError(id : string, retorno : boolean): void
{
    if(retorno)
    {
        ( <HTMLSpanElement> document.getElementById(id)).style.display = "none";        
    }
    else
    {
        ( <HTMLSpanElement> document.getElementById(id)).style.display = "block";
    }
}



