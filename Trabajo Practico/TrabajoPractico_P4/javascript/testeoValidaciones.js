"use strict";
function AdministrarValidaciones(evento) {
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    AdministrarSpanError("spnNombre", ValidarCamposVacios("txtNombre"));
    AdministrarSpanError("spnLegajo", ValidarCamposVacios("txtLegajo"));
    AdministrarSpanError("spnSueldo", ValidarCamposVacios("txtSueldo"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico(document.getElementById("txtDni").valueAsNumber, 1000000, 55000000));
    AdministrarSpanError("spnLegajo", ValidarRangoNumerico(document.getElementById("txtLegajo").valueAsNumber, 100, 550));
    AdministrarSpanError("spnSexo", ValidarCombo("cboSexo", "---"));
    AdministrarSpanError("spnSueldo", (ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()) >= document.getElementById("txtSueldo").valueAsNumber));
    var form = document.getElementById("formLogin");
    if (!VerificarValidacionesIndex()) {
        evento.preventDefault();
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
//# sourceMappingURL=testeoValidaciones.js.map