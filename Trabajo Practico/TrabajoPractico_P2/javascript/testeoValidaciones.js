"use strict";
function AdministrarValidaciones() {
    if (ValidarCamposVacios("txtDni")) {
        alert("El campo del dni esta lleno");
    }
    else {
        alert("ERROR. El campo del dni esta vacio");
    }
    if (ValidarCamposVacios("txtApellido")) {
        alert("El campo del apellido esta lleno");
    }
    else {
        alert("ERROR. El campo del apellido estan vacio");
    }
    if (ValidarCamposVacios("txtNombre")) {
        alert("El campo del nombre esta lleno");
    }
    else {
        alert("ERROR. El campo del nombre esta vacio");
    }
    if (ValidarCamposVacios("txtLegajo")) {
        alert("El campo del legajo esta lleno");
    }
    else {
        alert("ERROR. El campo del legajo esta vacio");
    }
    if (ValidarCamposVacios("txtSueldo")) {
        alert("El campo del sueldo esta lleno");
    }
    else {
        alert("ERROR. El campo del sueldo esta vacio");
    }
    if (ValidarRangoNumerico(document.getElementById("txtDni").valueAsNumber, 1000000, 55000000)) {
        alert("El rango del dni esta dentro de los valores especificados");
    }
    else {
        alert("ERROR. El rango del dni no esta dentro de los valores especificados");
    }
    if (ValidarRangoNumerico(document.getElementById("txtLegajo").valueAsNumber, 100, 550)) {
        alert("El rango numerico del legajo esta dentro de los valores especificados");
    }
    else {
        alert("ERROR. El rango numerico del legajo no esta dentro de los valores especificados");
    }
    if (ValidarCombo("cboSexo", "---")) {
        alert("El sexo seleccionado esta dentro de los valores validos");
    }
    else {
        alert("ERROR. El sexo seleccionado no esta dentro de los valores validos");
    }
    alert("El turno es " + ObtenerTurnoSeleccionado() + " y el sueldo maximo es: " + ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()));
}
//# sourceMappingURL=testeoValidaciones.js.map