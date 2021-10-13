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
function AdministrarValidaciones_DB()
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
        Ajax_AdministrarAlta_DB();
    }
}
function AdministrarValidacionesLogin(evento : Event, boton : string)
{
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico((<HTMLInputElement> document.getElementById("txtDni")).valueAsNumber, 1000000,55000000));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    
    if(! VerificarValidacionesLogin())
    {   
        evento.preventDefault();
    }
    else if(boton == 'BD'){
        (<HTMLFormElement> document.getElementById("formLogin")).action= "./backend/verificarUsuario_BD.php";
    }
    else
    {
        (<HTMLFormElement> document.getElementById("formLogin")).action= "./backend/verificarUsuario.php";
    }
}
function AdministrarModificar(dni : number) : void
{
    (<HTMLInputElement> document.getElementById("hdnModificar")).value= dni.toString();
    Ajax_AdministrarModificar(dni);
    
}
function AdministrarModificar_DB(dni : number) : void
{
    (<HTMLInputElement> document.getElementById("hdnModificar")).value= dni.toString();
    Ajax_AdministrarModificar_DB(dni);
    
}
function AdministrarLimpiar()
{
    if((<HTMLInputElement>document.getElementById('hdnModificar')).value != 'Modificar')
    {
        (<HTMLInputElement>document.getElementById('txtDni')).value = '';
        (<HTMLInputElement>document.getElementById('txtLegajo')).value = '';        
    }
    (<HTMLInputElement>document.getElementById('txtApellido')).value = '';
    (<HTMLInputElement>document.getElementById('txtNombre')).value = '';
    (<HTMLInputElement>document.getElementById('txtSueldo')).value = '';
    (<HTMLInputElement>document.getElementById('cboSexo')).value = '---';


}