<?php 
require "fabrica.php";

if(isset($_POST["hdnModificar"]))
{
	$fabrica = new Fabrica("fabrica de empanadas S.A", 7);
	$fabrica->TraerDeArchivo("./archivos/empleados.txt");
	foreach($fabrica->GetEmpleados() as $item){
		if($item->GetDni() == $_POST["hdnModificar"]){
			$empleado = $item;
			break;
		}
	}
}

echo (isset($_POST["hdnModificar"]) ? "<h2>Modificacion Empleados</h2>" : "<h2>Alta Empleados</h2>"); 
			
echo('<table align="left">
    <tr>
        <td colspan="2"><h4>Datos Personales</h4></td>
    </tr>
    <tr>
        <td colspan="2"><hr /></td>
    </tr>
    <tr>                  
        <td>DNI</td>					
        <td  style="text-align:left;padding-left:15px">                        
            <input ');echo (isset($_POST["hdnModificar"]) ? 'style="color: grey;" value='. $empleado->GetDni() .' readonly': '');
            echo('title="DNI"  type="number" name="txtDni" id="txtDni" size="10" min="1000000" max="55000000" required> 
            <span style="display:none;color: orange;" name="spnDni" id="spnDni">*</span>
        </td>
    </tr>
    <tr>
        <td>Apellido:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input ');
            if(isset($_POST["hdnModificar"]))
            echo ('value="'. $empleado->GetApellido().'"');
            echo ('title="Apellido" type="text" name="txtApellido" id="txtApellido" required>
            <span style="display:none;color: orange;" name="spnApellido" id="spnApellido">*</span>             
        </td>
    </tr>
    <tr>
        <td>Nombre:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input ');
            if(isset($_POST["hdnModificar"]))
            echo ('value="'. $empleado->GetNombre().'"');
            echo(' title="Nombre" type="text" name="txtNombre" id="txtNombre" required>
            <span style="display:none;color: orange;" name="spnNombre" id="spnNombre">*</span>
        </td>
    </tr>
    <tr>
        <td>Sexo:</td>					
        <td style="text-align:left;padding-left:15px">
            <select id="cboSexo" name="cboSexo" >
                <option value="---">Seleccione</option>
                <option value="F" ');
                if(isset($_POST["hdnModificar"]) && $empleado->GetSexo() == "F")
                echo ('selected="selected"');
                echo('>Femenino</option>
                <option value="M"');
                if(isset($_POST["hdnModificar"]) && $empleado->GetSexo() == "M")
                echo ('selected="selected"');
                echo('>Masculino</option>
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
        <input ');
        echo (isset($_POST["hdnModificar"]) ? 'style="color: grey;" value='. $empleado->GetLegajo() .' readonly': '');
        echo('title="Legajo"  type="number" name="txtLegajo" id="txtLegajo" size="6" min="100" max="550" required>                                      
            <span style="display:none;color: orange;" name="spnLegajo" id="spnLegajo">*</span>         
        </td>
    </tr>
    <tr>
        <td>Sueldo:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input ');
             if(isset($_POST["hdnModificar"]))echo ('value="'. $empleado->GetSueldo().'"');
             echo(' title="Sueldo" type="number" name="txtSueldo" id="txtSueldo" min="8000" step="500" required>
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
            <input ');
            if(isset($_POST["hdnModificar"]) && $empleado->GetTurno() == "Tarde"){
                echo ('checked="checked"');
            }
            echo(' type="radio" name="rdoTurno" id="rdoTurno" value="Tarde" />						
        </td>
        <td>Tarde</td>					
    </tr>
    <tr>
        <td  style="text-align:left;padding-left:40px">
            <input ');
            if(isset($_POST["hdnModificar"]) && $empleado->GetTurno() == "Noche"){
                echo ('checked="checked"');
            }
            echo(' type="radio" name="rdoTurno" id="rdoTurno" value="Noche" />						
        </td>
        <td>Noche</td>					
    </tr>

    <tr>
        <td>Foto:</td>					
        <td  style="text-align:left;padding-left:15px">
            <input title="Foto" type="file" name="fileFoto" id="fileFoto" required>
            <span style="display:none;color: orange;" name="spnFoto" id="spnFoto">*</span>
        </td>
    </tr>			
    <tr>
        <td colspan="2"><hr /></td>
    </tr>				
    <tr>
        <td colspan="2" align="right">
            <input type="reset" value="Limpiar" />
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input ');
                echo (isset($_POST["hdnModificar"]) ? 'value="Modificar"' : ' value="Enviar" ');
                echo (' type="button" onclick="AdministrarValidaciones()" id="btnEnviar"/>
        </td>
    </tr>
    <tr>												
        <td> 
            <input ');
            if(isset($_POST["hdnModificar"])){
                echo ('value="Modificar"');
            }
            echo(' type="hidden" name="hdnModificar" id="hdnModificar" value="" /> 
        </td>
    </tr>
</table> ');

?>

