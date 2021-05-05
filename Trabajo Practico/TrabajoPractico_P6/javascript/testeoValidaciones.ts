function AdministrarValidaciones(evento : Event)
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
    var form= <HTMLFormElement> document.getElementById("formLogin");

    if(! VerificarValidacionesIndex())
    {   
        evento.preventDefault();
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
