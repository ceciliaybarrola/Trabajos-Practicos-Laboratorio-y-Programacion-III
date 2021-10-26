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
function AdministrarValidaciones_DB() {
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
        Ajax_AdministrarAlta_DB();
    }
}
function AdministrarValidacionesLogin(evento, boton) {
    AdministrarSpanError("spnDni", ValidarCamposVacios("txtDni"));
    AdministrarSpanError("spnDni", ValidarRangoNumerico(document.getElementById("txtDni").valueAsNumber, 1000000, 55000000));
    AdministrarSpanError("spnApellido", ValidarCamposVacios("txtApellido"));
    if (!VerificarValidacionesLogin()) {
        evento.preventDefault();
    }
    else if (boton == 'BD') {
        document.getElementById("formLogin").action = "./backend/verificarUsuario_BD.php";
    }
    else {
        document.getElementById("formLogin").action = "./backend/verificarUsuario.php";
    }
}
function AdministrarModificar(dni) {
    document.getElementById("hdnModificar").value = dni.toString();
    Ajax_AdministrarModificar(dni);
}
function AdministrarModificar_DB(dni) {
    document.getElementById("hdnModificar").value = dni.toString();
    Ajax_AdministrarModificar_DB(dni);
}
function Limpiar() {
    if (document.getElementById("hdnModificar").value != "Modificar") {
        document.getElementById("txtDni").value = "";
        document.getElementById("txtLegajo").value = "";
    }
    document.getElementById("txtApellido").value = "";
    document.getElementById("txtNombre").value = "";
    document.getElementById("txtSueldo").value = "";
    document.getElementById("cboSexo").value = "---";
    document.getElementById("fileFoto").defaultValue = "";
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
var Ajax = /** @class */ (function () {
    function Ajax() {
        var _this = this;
        this.Get = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            ruta = params.length > 0 ? ruta + "?" + parametros : ruta;
            _this._xhr.open('GET', ruta);
            _this._xhr.send();
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.Post = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            _this._xhr.open('POST', ruta, true);
            _this._xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            _this._xhr.send(parametros);
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.Post_File = function (ruta, success, arrayKey, arrayValue, idFoto, error) {
            var foto;
            foto = document.getElementById(idFoto);
            var form = new FormData();
            if (foto.files != null) {
                form.append(idFoto, foto.files[0]);
            }
            for (var i = 0; i < arrayKey.length; i++) {
                form.append(arrayKey[i], arrayValue[i]);
            }
            _this._xhr.open('POST', ruta, true);
            _this._xhr.setRequestHeader("enctype", "multipart/form-data");
            _this._xhr.send(form);
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.GetXmlHttpRequest = function () {
            return _this._xhr;
        };
        this._xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }
    return Ajax;
}());
/***************************************************************************************/
function Ajax_AdministrarModificar(dni) {
    var ajax = new Ajax();
    var parametros = "hdnModificar=" + dni;
    ajax.Post("../backend/alta.php", SuccessModificar, parametros, Fail);
}
function Ajax_AdministrarModificar_DB(dni) {
    var ajax = new Ajax();
    var parametros = "hdnModificar=" + dni;
    ajax.Post("../backend/alta_DB.php", SuccessModificar, parametros, Fail);
}
function Ajax_AdministrarEliminar(parametroLegajo) {
    var ajax = new Ajax();
    ajax.Get("../backend/eliminar.php", Success, "legajo=" + parametroLegajo.toString(), Fail);
}
function Ajax_AdministrarEliminar_DB(parametroLegajo) {
    var ajax = new Ajax();
    ajax.Get("../backend/eliminar_DB.php", Success, "legajo=" + parametroLegajo.toString(), Fail);
}
function Ajax_AdministrarAlta() {
    var ajax = new Ajax();
    var turnoSeleccionado;
    (document.getElementsByName("rdoTurno")).forEach(function (element) {
        if (element.checked) {
            turnoSeleccionado = element.value;
        }
    });
    var arrayKey = new Array("txtDni", "txtApellido", "txtNombre", "txtLegajo", "txtSueldo", "cboSexo", "rdoTurno", "hdnModificar");
    var arrayValue = new Array(document.getElementById("txtDni").value, document.getElementById("txtApellido").value, document.getElementById("txtNombre").value, document.getElementById("txtLegajo").value, document.getElementById("txtSueldo").value, document.getElementById("cboSexo").value, turnoSeleccionado, document.getElementById("hdnModificar").value);
    ajax.Post_File("../backend/administracion.php", Success, arrayKey, arrayValue, "fileFoto");
}
function Ajax_AdministrarAlta_DB() {
    var ajax = new Ajax();
    var turnoSeleccionado;
    (document.getElementsByName("rdoTurno")).forEach(function (element) {
        if (element.checked) {
            turnoSeleccionado = element.value;
        }
    });
    var arrayKey = new Array("txtDni", "txtApellido", "txtNombre", "txtLegajo", "txtSueldo", "cboSexo", "rdoTurno", "hdnModificar");
    var arrayValue = new Array(document.getElementById("txtDni").value, document.getElementById("txtApellido").value, document.getElementById("txtNombre").value, document.getElementById("txtLegajo").value, document.getElementById("txtSueldo").value, document.getElementById("cboSexo").value, turnoSeleccionado, document.getElementById("hdnModificar").value);
    ajax.Post_File("../backend/administracion_DB.php", Success, arrayKey, arrayValue, "fileFoto");
}
function SuccessModificar(retorno) {
    document.getElementById("divAlta").innerHTML = retorno;
}
function Success(retorno) {
    document.getElementById("divMostrar").innerHTML = retorno;
}
function Fail(retorno) {
    alert(retorno);
}
