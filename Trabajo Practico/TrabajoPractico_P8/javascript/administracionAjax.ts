class Ajax {

    private _xhr: XMLHttpRequest;

    private static DONE : number;
    private static OK : number;

    public constructor() {
        this._xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }

    public Get = (ruta: string, success: Function, params: string = "", error?: Function):void => {
    
        let parametros:string = params.length > 0 ? params : "";
        ruta = params.length > 0 ? ruta + "?" + parametros : ruta;

        this._xhr.open('GET', ruta);
        this._xhr.send();

        this._xhr.onreadystatechange = () => {

            if (this._xhr.readyState === Ajax.DONE) {
                if (this._xhr.status === Ajax.OK) {
                    success(this._xhr.responseText);
                } else {
                    if (error !== undefined){
                        error(this._xhr.status);
                    }
                }
            }

        };
    };

    public Post = (ruta: string, success: Function, params: string = "", error?: Function):void => {

        let parametros:string = params.length > 0 ? params : "";

        this._xhr.open('POST', ruta, true);
        this._xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        this._xhr.send(parametros);

        this._xhr.onreadystatechange = ():void => {

            if (this._xhr.readyState === Ajax.DONE) {
                if (this._xhr.status === Ajax.OK) {
                    success(this._xhr.responseText);
                } else {
                    if (error !== undefined){
                        error(this._xhr.status);
                    }
                }
            }
        };
    };
    public Post_File = (ruta: string, success: Function, arrayKey: Array<string>, arrayValue: Array<any>, idFoto: any , error?: Function):void => {

        var foto;

        foto=(<HTMLInputElement> document.getElementById(idFoto));
        let form : FormData = new FormData();
        if(foto.files != null)
        {
            form.append(idFoto, foto.files[0]);
        }
        for(var i=0; i<arrayKey.length; i++)
        {
            form.append(arrayKey[i], arrayValue[i]);
        }
        this._xhr.open('POST', ruta, true);
        this._xhr.setRequestHeader("enctype", "multipart/form-data");
        this._xhr.send(form);

        this._xhr.onreadystatechange = ():void => {

            if (this._xhr.readyState === Ajax.DONE) {
                if (this._xhr.status === Ajax.OK) {
                    success(this._xhr.responseText);
                } else {
                    if (error !== undefined){
                        error(this._xhr.status);
                    }
                }
            }
        };
    };
    public GetXmlHttpRequest = () : XMLHttpRequest =>{
        return this._xhr;
    }
}
/***************************************************************************************/

function Ajax_AdministrarModificar(dni : number)
{
    let ajax : Ajax = new Ajax();
    
    var parametros : string = "hdnModificar="+dni;
    ajax.Post("../backend/alta.php",SuccessModificar,parametros,Fail);
}
 function Ajax_AdministrarEliminar(parametroLegajo : string)
{
    let ajax : Ajax = new Ajax();
    ajax.Get("../backend/eliminar.php", Success, "legajo="+parametroLegajo.toString(), Fail);

}
function Ajax_AdministrarAlta()
{
    let ajax : Ajax = new Ajax();
    var arrayKey : Array <string> = new Array("txtDni", "txtApellido", "txtNombre", "txtLegajo", "txtSueldo", "cboSexo", "rdoTurno", "hdnModificar");
    var arrayValue : Array<any> = new Array((<HTMLInputElement> document.getElementById("txtDni")).value,
                                            (<HTMLInputElement> document.getElementById("txtApellido")).value,
                                            (<HTMLInputElement> document.getElementById("txtNombre")).value,
                                            (<HTMLInputElement> document.getElementById("txtLegajo")).value,
                                            (<HTMLInputElement> document.getElementById("txtSueldo")).value,
                                            (<HTMLInputElement> document.getElementById("cboSexo")).value,
                                            ObtenerTurnoSeleccionado(),
                                            (<HTMLInputElement> document.getElementById("hdnModificar")).value);

    ajax.Post_File("../backend/administracion.php",Success,arrayKey, arrayValue, "fileFoto");
}

function SuccessModificar(retorno:string):void {
    (<HTMLDivElement>document.getElementById("divAlta")).innerHTML = retorno;
}
function Success(retorno:string):void {
    (<HTMLDivElement>document.getElementById("divMostrar")).innerHTML = retorno;
}

function Fail(retorno:string):void {
    alert(retorno);
}
