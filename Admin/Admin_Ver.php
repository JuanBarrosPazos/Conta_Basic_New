<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
									master_index();
									ver_todo();
									info();
								}

elseif ($_SESSION['Nivel'] == 'admin'){

	master_index();

	require 'Inc_Logica_01.php';
	
} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'Inc_Show_Form_01_Val.php';
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";

	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	//$orden = $_POST['Orden'];
		
	if ($_SESSION['Nivel'] == 'admin')  { 
	$sqlb =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape'  ORDER BY `Nombre` ASC  ";
	$qb = mysqli_query($db, $sqlb);
				}
//	$sqlc =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
//	$qc = mysqli_query($db, $sqlc);
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS CONSULTA";

	global $formularioh;
	$formularioh = "<form name='ver' action='Admin_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=420px,height=580px')\">";

	global $formulariof;
	$formulariof = "<td colspan=5 class='BorderInf'>&nbsp;</td>
					<td colspan=2 align='center' class='BorderInf'>
						<input type='submit' value='VER DETALLES' />
						<input type='hidden' name='oculto2' value=1 />
					</td>
				</form>";

	global $formulariohi;
	$formulariohi = "";

	global $formulariofi;
	$formulariofi = "";

	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){

	global $titulo;
	$titulo = "CONSULTA USUARIOS";

	require 'Inc_Show_Form_01.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
			$ref = $_SESSION['ref'];
			$sqlb =  "SELECT * FROM `admin` WHERE `ref` = '$ref'";
			$qb = mysqli_query($db, $sqlb);
		}
	
	elseif ($_SESSION['Nivel'] == 'admin') { 
				$orden = $_POST['Orden'];
				$sqlb =  "SELECT * FROM `admin` ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
			}

			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "TODOS USUARIOS CONSULTA";
	
	global $formularioh;
	$formularioh = "<form name='ver' action='Admin_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=420px,height=580px')\">";

	global $formulariof;
	$formulariof = "<td colspan=5 class='BorderInf'>&nbsp;</td>
					<td colspan=2 align='center' class='BorderInf'>
						<input type='submit' value='VER DETALLES' />
						<input type='hidden' name='oculto2' value=1 />
					</td>
				</form>";
				
	global $formulariohi;
	$formulariohi = "";

	global $formulariofi;
	$formulariofi = "";

	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////
		
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../'.$_SESSION['menu'].'/Master_Index_Admin.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../cbj_Docs/log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>