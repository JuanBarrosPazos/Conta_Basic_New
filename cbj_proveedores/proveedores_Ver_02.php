<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

				
	global $nombre;
	global $apellido;
	
	$nombre = isset($_POST['Nombre']);
	$apellido = isset($_POST['Apellidos']);
							
							if($_POST['oculto2']){	process_form();
													info();
								} 
								
				}
					else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	$nombre = isset($_POST['Nombre']);
	$apellido = isset($_POST['Apellidos']);
	global $sesionref;
	$sesionref = $_SESSION['ref'];
	$sesionref = strtolower($sesionref);
	
	print("<table align='center' width=490px>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL PROVEEDOR
					</th>
				</tr>
				
				<tr>
					<td width=140px>
						ID
					</td>
					<td>"
						.$_POST['id'].
					"</td>
					<td rowspan='5' align='center' width='180px'>
<img src='../cbj_Docs/img_proveedores/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['rsocial'].
						
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td>"
						.$_POST['dni']." ".$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						MAIL
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
				
					<td>
						Direcci&oacute;n:
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 1:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 2:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
								
			</table>	
						");


			}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- PROVEEDORES DETALLES ".$ActionTime.".\n\tID: ".$_POST['id'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".";

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>