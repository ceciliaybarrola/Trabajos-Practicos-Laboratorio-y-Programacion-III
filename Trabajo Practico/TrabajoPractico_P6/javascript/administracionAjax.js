"use strict";
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
function Ajax_AdministrarModificar() {
    var ajax = new Ajax();
    var parametros = "hdnModificar=" + document.getElementById("hdnModificar").value;
    alert(parametros);
    ajax.Post("index.php", SuccessModificar, parametros, Fail);
}
function Ajax_AdministrarEliminar(parametroLegajo) {
    var ajax = new Ajax();
    ajax.Get("http://localhost/trabajo%20practico/trabajopractico_p6/backend/eliminar.php", Success, "legajo=" + parametroLegajo.toString(), Fail);
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
    ajax.Post_File("http://localhost/trabajo%20practico/trabajopractico_p6/backend/administracion.php", Success, arrayKey, arrayValue, "fileFoto");
}
function SuccessModificar(retorno) {
    alert("Se llego al success");
    console.log("se llego prro" + retorno);
    document.getElementById("divAlta").innerHTML = retorno;
}
function Success(retorno) {
    document.getElementById("divMostrar").innerHTML = retorno;
}
function Fail(retorno) {
    console.clear();
    console.log(retorno);
    alert("ERROR, no se realizo la peticion");
}
//# sourceMappingURL=administracionAjax.js.map