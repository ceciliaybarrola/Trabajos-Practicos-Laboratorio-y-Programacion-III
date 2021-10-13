function AdministrarValidaciones()
{
    AdministrarSpanError("spnDni",ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnApellido",ValidarCamposVacios("txtApellido"));
    AdministrarSpanError("spnNombre",ValidarCamposVacios("txtNombre"));
    AdministrarSpanError("spnLegajo",ValidarCamposVacios("txtLegajo"));
    AdministrarSpanError("spnSueldo",ValidarCamposVacios("txtSueldo"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico((<HTMLInputElement> document.getElementById("txtDni")).valueAsNumber, 1000000,55000000));
    AdministrarSpanError("spnLegajo", ValidarRangoNumerico((<HTMLInputElement> document.getElementById("txtLegajo")).valueAsNumber, 100,550));
    AdministrarSpanError("spnSexo", ValidarCombo("cboSexo", "---"));
    AdministrarSpanError("spnSueldo", (ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()) >= (<HTMLInputElement> document.getElementById("txtSueldo")).valueAsNumber));
    AdministrarSpanError("spnFoto", ValidarCamposVacios("fileFoto"));

    if(VerificarValidacionesIndex())
    {   
        Ajax_AdministrarAlta();
    }

}
function AdministrarValidacionesLogin(evento : Event)
{
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico((<HTMLInputElement> document.getElementById("txtDni")).valueAsNumber, 1000000,55000000));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    
    var form= <HTMLFormElement> document.getElementById("formLogin");

    if(! VerificarValidacionesLogin())
    {   
        evento.preventDefault();
    }
}
function AdministrarModificar(dni : number) : void
{
    (<HTMLInputElement> document.getElementById("hdnModificar")).value= dni.toString();
    Ajax_AdministrarModificar(dni); 
}
function Limpiar()
{
    (<HTMLInputElement> document.getElementById("txtDni")).value = "";
    (<HTMLInputElement> document.getElementById("txtApellido")).value= "";
    (<HTMLInputElement> document.getElementById("txtNombre")).value= "";
    (<HTMLInputElement> document.getElementById("txtLegajo")).value= "";
    (<HTMLInputElement> document.getElementById("txtSueldo")).value= "";
    (<HTMLInputElement> document.getElementById("cboSexo")).value= "---";
    (<HTMLInputElement> document.getElementById("fileFoto")).defaultValue="";
}