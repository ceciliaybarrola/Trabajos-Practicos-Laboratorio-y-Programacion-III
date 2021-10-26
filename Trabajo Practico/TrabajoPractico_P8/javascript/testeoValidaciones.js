"use strict";
function AdministrarValidaciones() {
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    AdministrarSpanError("spnNombre", ValidarCamposVacios("txtNombre"));
    AdministrarSpanError("spnLegajo", ValidarCamposVacios("txtLegajo"));
    AdministrarSpanError("spnSueldo", ValidarCamposVacios("txtSueldo"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico(document.getElementById("txtDni").valueAsNumber, 1000000, 55000000));
    AdministrarSpanError("spnLegajo", ValidarRangoNumerico(document.getElementById("txtLegajo").valueAsNumber, 100, 550));
    AdministrarSpanError("spnSexo", ValidarCombo("cboSexo", "---"));
    AdministrarSpanError("spnSueldo", (ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()) >= document.getElementById("txtSueldo").valueAsNumber));
    AdministrarSpanError("spnFoto", ValidarCamposVacios("fileFoto"));
    if (VerificarValidacionesIndex()) {
        Ajax_AdministrarAlta();
    }
}
function AdministrarValidacionesLogin(evento) {
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico(document.getElementById("txtDni").valueAsNumber, 1000000, 55000000));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    var form = document.getElementById("formLogin");
    if (!VerificarValidacionesLogin()) {
        evento.preventDefault();
    }
}
function AdministrarModificar(dni) {
    document.getElementById("hdnModificar").value = dni.toString();
    Ajax_AdministrarModificar(dni);
}
//# sourceMappingURL=testeoValidaciones.js.map