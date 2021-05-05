<?php
session_start();
require "./fabrica.php";

if(!isset($_SESSION["DNIEmpleado"]))
	header("Location: ../login.html");
if(isset($_POST["hdnMostrar"]))
{
	$fabrica = new Fabrica("fabrica de empanadas S.A", 7);
	$fabrica->TraerDeArchivo("./archivos/empleados.txt");
	foreach($fabrica->GetEmpleados() as $item){
		if($item->GetDni() == $_POST["hdnMostrar"]){
			$empleado = $item;
			break;
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../javascript/funciones.js" ></script>
    <title>Document</title>
</head>
<body>
<div align="center">
	<h1>Cecilia Ybarrola</h1>
	<hr>
</div>
<div align="left" class="container " id="divAlta" style="float: left;width: 40%; height:600px; overflow:auto;">		
	<form action="administracion.php" method="POST" enctype="multipart/form-data">
		<?php echo (isset($_POST["hdnMostrar"]) ? "<h2>Modificacion Empleados</h2>" : "<h2>Alta Empleados</h2>");?> 
			<table align="left">
				<tr>
					<td colspan="2"><h4>Datos Personales</h4></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
				<tr>                  
                    <td>DNI</td>					
					<td  style="text-align:left;padding-left:15px">                        
                        <input <?php echo (isset($_POST["hdnMostrar"]) ? 'style="color: grey;" value='. $empleado->GetDni() .' readonly': '');?> 
							title="DNI"  type="number" name="txtDni" id="txtDni" size="10" min="1000000" max="55000000" required> 
						<span style="display:none;color: orange;" name="spnDni" id="spnDni">*</span>
					</td>
				</tr>
				<tr>
                    <td>Apellido:</td>					
					<td  style="text-align:left;padding-left:15px">
                        <input <?php if(isset($_POST["hdnMostrar"]))echo ('value="'. $empleado->GetApellido().'"');?> 
							title="Apellido" type="text" name="txtApellido" id="txtApellido" required>
                   		<span style="display:none;color: orange;" name="spnApellido" id="spnApellido">*</span>             
					</td>
				</tr>
				<tr>
					<td>Nombre:</td>					
					<td  style="text-align:left;padding-left:15px">
                        <input <?php if(isset($_POST["hdnMostrar"]))echo ('value="'. $empleado->GetNombre().'"');?> 
							title="Nombre" type="text" name="txtNombre" id="txtNombre" required>
						<span style="display:none;color: orange;" name="spnNombre" id="spnNombre">*</span>
					</td>
				</tr>
				<tr>
					<td>Sexo:</td>					
                    <td style="text-align:left;padding-left:15px">
						<select id="cboSexo" name="cboSexo" >
                            <option value="---">Seleccione</option>
							<option value="F" <?php if(isset($_POST["hdnMostrar"]) && $empleado->GetSexo() == "F")echo ('selected="selected"');?>>Femenino</option>
							<option value="M" <?php if(isset($_POST["hdnMostrar"]) && $empleado->GetSexo() == "M")echo ('selected="selected"');?>>Masculino</option>
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
					<input <?php echo (isset($_POST["hdnMostrar"]) ? 'style="color: grey;" value='. $empleado->GetLegajo() .' readonly': '');?>  
						title="Legajo"  type="number" name="txtLegajo" id="txtLegajo" size="6" min="100" max="550" required>                                      
						<span style="display:none;color: orange;" name="spnLegajo" id="spnLegajo">*</span>
						
					</td>
				</tr>
				<tr>
					<td>Sueldo:</td>					
					<td  style="text-align:left;padding-left:15px">
                        <input <?php if(isset($_POST["hdnMostrar"]))echo ('value="'. $empleado->GetSueldo().'"');?> 
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
						<input <?php if(isset($_POST["hdnMostrar"]) && $empleado->GetTurno() == "Tarde")echo ('checked="checked"');?>
							type="radio" name="rdoTurno" id="rdoTurno" value="Tarde" />						
					</td>
                    <td>Tarde</td>					
				</tr>
				<tr>
                    <td  style="text-align:left;padding-left:40px">
						<input <?php if(isset($_POST["hdnMostrar"]) && $empleado->GetTurno() == "Noche")echo ('checked="checked"');?> 
							type="radio" name="rdoTurno" id="rdoTurno" value="Noche" />						
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
						<input 
							<?php echo (isset($_POST["hdnMostrar"]) ? 'value="Modificar"' : ' value="Enviar" ');?>
							type="submit" onclick="AdministrarValidaciones(event)" id="btnEnviar"/>
					</td>
				</tr>
				<tr>												
                    <td> 
						<input <?php if(isset($_POST["hdnMostrar"]))echo ('value="Modificar"');?>
							type="hidden" name="hdnModificar" id="hdnModificar" value="" /> 
					</td>
                </tr>
			</table>
		</form>  
    </div>
    <div align="left" class="container " id="divMostrar" style="float: right;height:600px; width: 60%; overflow:auto;">
		<h2>Listado de empleados</h2>
			<form id="formMostrar" method="POST" action="index.php">
                <table align="right">
                    <tr>												
                        <td> <input type="hidden" name="hdnMostrar" id="hdnMostrar" value="" /> </td>
                    </tr>
                    <tr>
                        <td colspan="2"><h4>Info</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr/></td>
                    </tr>
                    
                    <?php
                    $fabrica = new Fabrica("Fabrica de empanadas S.A.", 7);
                    $fabrica->TraerDeArchivo("./archivos/empleados.txt");
                    $array = $fabrica->GetEmpleados();
                    foreach($array as $empleado)
                    {    ///poner el eliminar como un boton       
						echo'<tr>                  
						<td>' .$empleado->ToString().':</td>	
						<td><img src="./'.$empleado->GetPathFoto().'" width="90px" height="90px"/></td>				
						<td  style="text-align:left;padding-left:15px">      
						<a href="./eliminar.php?legajo='.$empleado->GetLegajo().'">Eliminar Empleado.</a><br>                       
						</td>
						<td colspan="2" align="right">
						<input type="button" onclick="AdministrarModificar('.$empleado->GetDni().')" id="btnModificar" value="Modificar" />
						</td>
						</tr>';    
						
                    }
                    ?>
                    <tr>
                        <td colspan="2"><hr/></td>
                    </tr>
            </table>
            </form>

    </div>
	<div style=" width: 100%;text-align:left;padding-right: 50px;">
		<a href="./backend/cerrarSesion.php">Cerrar sesion.</a><br>
		<a href="../index.php">Alta Empleados</a>
	</div>
</body>
</html>