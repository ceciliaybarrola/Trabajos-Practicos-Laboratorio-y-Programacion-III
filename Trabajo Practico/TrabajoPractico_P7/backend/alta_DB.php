<?php 
if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(!isset($_SESSION["DNIEmpleado"]))
	header("Location: ../login.html");

require_once "empleado.php";

if(isset($_POST["hdnModificar"]))
{
    try{
        $user = 'root';
        $pass = '';
        $conectionString='mysql:host=localhost;dbname=fabrica';
        $pdo = new PDO($conectionString, $user, $pass);
        $sentencia = $pdo->prepare('SELECT * FROM empleados WHERE DNI = :dni');
        $sentencia->execute(array("dni" => $_POST["hdnModificar"]));
        while($fila = $sentencia->fetch()){
            $empleado = new Empleado($fila['nombre'],$fila['apellido'],$fila['DNI'],$fila['sexo'],$fila['legajo'],$fila['sueldo'],$fila['turno']);
            $empleado->SetPathFoto($fila['ruta_foto']);
        }


    }catch(PDOException $exception){
        echo "Error: ". $exception->getMessage();
    }
}
?>
<?php echo (isset($_POST["hdnModificar"]) ? "<h2>Modificacion Empleados</h2>" : "<h2>Alta Empleados</h2>"); ?>
<table align="center">
    <tr>
        <td colspan="2"><h4>Datos Personales</h4></td>
    </tr>
    <tr>
        <td colspan="2"><hr /></td>
    </tr>
    <tr>                  
        <td>DNI</td>					
        <td  style="text-align:left;padding-left:15px">                        
            <input <?php echo (isset($_POST["hdnModificar"]) ? 'style="color: grey;" value='. $empleado->GetDni() .' readonly': '');?> 
                title="DNI"  type="number" name="txtDni" id="txtDni" size="10" min="1000000" max="55000000" required> 
            <span style="display:none;color: orange;" name="spnDni" id="spnDni">*</span>
        </td>
    </tr>
    <tr>
        <td>Apellido:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input <?php if(isset($_POST["hdnModificar"]))echo ('value="'. $empleado->GetApellido().'"');?> 
                title="Apellido" type="text" name="txtApellido" id="txtApellido" required>
            <span style="display:none;color: orange;" name="spnApellido" id="spnApellido">*</span>             
        </td>
    </tr>
    <tr>
        <td>Nombre:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input <?php if(isset($_POST["hdnModificar"]))echo ('value="'. $empleado->GetNombre().'"');?> 
                title="Nombre" type="text" name="txtNombre" id="txtNombre" required>
            <span style="display:none;color: orange;" name="spnNombre" id="spnNombre">*</span>
        </td>
    </tr>
    <tr>
        <td>Sexo:</td>					
        <td style="text-align:left;padding-left:15px">
            <select id="cboSexo" name="cboSexo" >
                <option value="---">Seleccione</option>
                <option value="F" <?php if(isset($_POST["hdnModificar"]) && $empleado->GetSexo() == "F")echo ('selected="selected"');?>>Femenino</option>
                <option value="M" <?php if(isset($_POST["hdnModificar"]) && $empleado->GetSexo() == "M")echo ('selected="selected"');?>>Masculino</option>
            </select>					
            <span style="display:none;color: orange;" name="spnSexo" id="spnSexo">*</span><br> 
        </td>
    </tr>
    <tr>
        <td colspan="2"><h4>Datos Laborales</h4></td>
    </tr>
    <tr>
        <td colspan="2"><hr /></td>
    </tr>
    <tr>
        <td>Legajo:</td>					
        <td  style="text-align:left;padding-left:15px">
        <input <?php echo (isset($_POST["hdnModificar"]) ? 'style="color: grey;" value='. $empleado->GetLegajo() .' readonly': '');?>  
            title="Legajo"  type="number" name="txtLegajo" id="txtLegajo" size="6" min="100" max="550" required>                                      
            <span style="display:none;color: orange;" name="spnLegajo" id="spnLegajo">*</span>
            
        </td>
    </tr>
    <tr>
        <td>Sueldo:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input <?php if(isset($_POST["hdnModificar"]))echo ('value="'. $empleado->GetSueldo().'"');?> 
                title="Sueldo" type="number" name="txtSueldo" id="txtSueldo" min="8000" step="500" required>
            <span style="display:none;color: orange;" name="spnSueldo" id="spnSueldo">*</span>			
        </td>
    </tr>
    <tr>
        <td>Turno:</td>
    </tr>
    <tr>
        <td  style="text-align:left;padding-left:40px">
            <input type="radio" name="rdoTurno" id="rdoTurno" value="Ma&ntilde;ana" checked="checked" />						
        </td>
        <td>Ma&ntilde;ana</td>					
    </tr>
    <tr>
        <td  style="text-align:left;padding-left:40px">
            <input <?php if(isset($_POST["hdnModificar"]) && $empleado->GetTurno() == "Tarde")echo ('checked="checked"');?>
                type="radio" name="rdoTurno" id="rdoTurno" value="Tarde" />						
        </td>
        <td>Tarde</td>					
    </tr>
    <tr>
        <td  style="text-align:left;padding-left:40px">
            <input <?php if(isset($_POST["hdnModificar"]) && $empleado->GetTurno() == "Noche")echo ('checked="checked"');?> 
                type="radio" name="rdoTurno" id="rdoTurno" value="Noche" />						
        </td>
        <td>Noche</td>					
    </tr>
    <tr>
        <td>Foto:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input title="Foto" type="file" name="fileFoto" id="fileFoto" accept="image/*" required>
            <span style="display:none;color: orange;" name="spnFoto" id="spnFoto">*</span>
        </td>
    </tr>	
    <tr>
        <td colspan="2" style="text-align:center;">               
           <img id="default" <?php echo (isset($_POST["hdnModificar"]))?('src="'. $empleado->GetPathFoto().'"'): ' src="./fotos/default.png"';?> style="width:145px;height:126px;">                
           <input <?php echo isset($_POST["hdnModificar"])?('value="'. $empleado->GetPathFoto().'"'):'value="./fotos/default.png"';?>
                type="hidden" id="hdnDefault"  /> 
        </td>
    </tr>
         <script>
             // Obtener referencia al input y a la imagen
            const $seleccionArchivos = document.querySelector("#fileFoto"),
            $imagenPrevisualizacion = document.querySelector("#default");

            // Escuchar cuando cambie
            $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = $("#hdnDefault").val();                   
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
            })

        </script>   

    <tr>
        <td colspan="2"><hr /></td>
    </tr>				
    <tr>
        <td colspan="2" align="right">
            <input type="button" onclick="AdmimistrarLimpiar()" id="reset" value="Limpiar" />
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input 
                <?php echo (isset($_POST["hdnModificar"]) ? 'value="Modificar"' : ' value="Enviar" ');?>
                type="button" onclick="AdministrarValidaciones_DB()" id="btnEnviar"/>
        </td>
    </tr>
    <tr>												
        <td> 
            <input <?php if(isset($_POST["hdnModificar"]))echo ('value="Modificar"');?>
                type="hidden" name="hdnModificar" id="hdnModificar" value="" /> 
        </td>
    </tr>
</table>