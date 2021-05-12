//// <reference path="../AJAX/administracionAjax.ts"/>
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
        // Ajax_AdministrarAlta();
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
    document.getElementById("hdnMostrar").value = dni.toString();
    // Ajax_AdministrarModificar();
}
function ValidarCamposVacios(idValor) {
    var elemento = document.getElementById(idValor).value;
    var flag = false;
    for (var i = 0; i < elemento.length; i++) {
        if (elemento[i] != " ") {
            flag = true;
            break;
        }
    }
    return elemento.length > 0 && flag;
}
function ValidarRangoNumerico(valor, minimo, maximo) {
    return (valor >= minimo && valor <= maximo);
}
function ValidarCombo(idValor, valorEvitar) {
    return document.getElementById(idValor).value !== valorEvitar;
}
function ObtenerTurnoSeleccionado() {
    var turnoSeleccionado = "";
    var turnosDisponibles = document.getElementsByName("rdoTurno");
    turnosDisponibles.forEach(function (element) {
        if (element.checked) {
            turnoSeleccionado = element.value;
        }
    });
    return turnoSeleccionado;
}
function ObtenerSueldoMaximo(turno) {
    var sueldoMaximo = 0;
    switch (turno) {
        case "Mañana":
            sueldoMaximo = 20000;
            break;
        case "Tarde":
            sueldoMaximo = 18500;
            break;
        case "Noche":
            sueldoMaximo = 25000;
            break;
    }
    return sueldoMaximo;
}
function AdministrarSpanError(id, retorno) {
    if (retorno) {
        document.getElementById(id).style.display = "none";
    }
    else {
        document.getElementById(id).style.display = "block";
    }
}
function VerificarValidacionesLogin() {
    return (document.getElementById("spnApellido").style.display == "none") &&
        (document.getElementById("spnDni").style.display == "none");
}
function VerificarValidacionesIndex() {
    return (document.getElementById("spnApellido").style.display == "none") &&
        (document.getElementById("spnDni").style.display == "none") &&
        (document.getElementById("spnNombre").style.display == "none") &&
        (document.getElementById("spnLegajo").style.display == "none") &&
        (document.getElementById("spnSueldo").style.display == "none") &&
        (document.getElementById("spnSexo").style.display == "none") &&
        (document.getElementById("spnFoto").style.display == "none");
}
