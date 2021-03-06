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
        //INSTANCIO OBJETO FORMDATA
        let form : FormData = new FormData();

        //AGREGO PARAMETROS AL FORMDATA:

        //PARAMETRO RECUPERADO POR $_FILES
        if(foto.files != null)
        {
            form.append(idFoto, foto.files[0]);
        }
        for(var i=0; i<arrayKey.length; i++)
        {
            form.append(arrayKey[i], arrayValue[i]);
        }
        //METODO; URL; ASINCRONICO?
        this._xhr.open('POST', ruta, true);

        //ESTABLEZCO EL ENCABEZADO DE LA PETICION
        this._xhr.setRequestHeader("enctype", "multipart/form-data");

        //ENVIO DE LA PETICION
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

function Ajax_AdministrarModificar()
{
    let ajax : Ajax = new Ajax();
    
    var parametros : string = "hdnModificar="+(<HTMLInputElement> document.getElementById("hdnModificar")).value;
    ajax.Post("http://localhost/trabajo%20practico/trabajopractico_p6/backend/index.php",SuccessModificar,parametros,Fail);
}
 function Ajax_AdministrarEliminar(parametroLegajo : string)
{
    let ajax : Ajax = new Ajax();
    ajax.Get("http://localhost/trabajo%20practico/trabajopractico_p6/backend/eliminar.php", Success, "legajo="+parametroLegajo.toString(), Fail);

}
function Ajax_AdministrarAlta()
{
    let ajax : Ajax = new Ajax();
    var turnoSeleccionado;
    (document.getElementsByName("rdoTurno")).forEach(element => {
        if((<HTMLInputElement> element).checked)
        {
           turnoSeleccionado = (<HTMLInputElement> element).value;
        }
    });

    var arrayKey : Array <string> = new Array("txtDni", "txtApellido", "txtNombre", "txtLegajo", "txtSueldo", "cboSexo", "rdoTurno", "hdnModificar");
    var arrayValue : Array<any> = new Array((<HTMLInputElement> document.getElementById("txtDni")).value,
                                            (<HTMLInputElement> document.getElementById("txtApellido")).value,
                                            (<HTMLInputElement> document.getElementById("txtNombre")).value,
                                            (<HTMLInputElement> document.getElementById("txtLegajo")).value,
                                            (<HTMLInputElement> document.getElementById("txtSueldo")).value,
                                            (<HTMLInputElement> document.getElementById("cboSexo")).value,
                                            turnoSeleccionado,
                                            (<HTMLInputElement> document.getElementById("hdnModificar")).value);

    ajax.Post_File("http://localhost/trabajo%20practico/trabajopractico_p6/backend/administracion.php",Success,arrayKey, arrayValue, "fileFoto");
}

function SuccessModificar(retorno:string):void {

    alert ("success " + retorno);
}
function Success(retorno:string):void {
    (<HTMLDivElement>document.getElementById("divMostrar")).innerHTML = retorno;
}

function Fail(retorno:string):void {
    console.clear();
    console.log(retorno);
    alert("ERROR, no se realizo la peticion");
}
