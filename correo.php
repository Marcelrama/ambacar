<?php
if(isset($_POST))
{
    
    
    if ($_POST) {


		$server = "localhost";
    	$user = "abr06sb3_root";
    	$password = "smartbrands1";
    	$database = "abr06sb3_landing";

		$mysqli = new mysqli($server, $user, $password, $database);
		$mysqli->set_charset("utf8");
		
		if ($mysqli->connect_errno) {
		    printf("Falló la conexión: %s\n", $mysqli->connect_error);
		    exit();
		}

		setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
		
		
		
		$fecha = '';
		/*obteniendo fecha del servidor*/
		$result = $mysqli->query('SELECT NOW()');
		while ($row = $result->fetch_array()) {
			$fecha = new DateTime($row[0]);
		}

		$anio = strftime("%Y", $fecha->getTimestamp());
		$mes = strftime("%B", $fecha->getTimestamp());

		$val = $mysqli->query("select 1 from ambacar_".$mes."_".$anio);



		if($val !== FALSE)
		{
			

			foreach (array_keys($_POST) as $parametro ) {
				$nuevo = preg_split( "/_/", $parametro);
				$mysqli->query("select ".$nuevo[0]." from ambacar_".$mes."_".$anio) or $mysqli->query("alter table ambacar_".$mes."_".$anio." add ".$nuevo[0]." varchar (".$nuevo[1].")");

				$array = array();
				$result = $mysqli->query("DESCRIBE ambacar_".$mes."_".$anio);

				while ($row = $result->fetch_array()) {
					$array[] = $row[0];
				}
			}

			if($array[count($array) - 1 ] == 'fecha'){
				//
			}
			else{
				$mysqli->query("alter table ambacar_".$mes."_".$anio." MODIFY fecha datetime AFTER ".$array[count($array) - 1 ]);
			}

			

		}else{

		   // sql to create table
			$sql = "CREATE TABLE ambacar_".$mes."_".$anio." (
			id INT(6) AUTO_INCREMENT PRIMARY KEY,";

			foreach (array_keys($_POST) as $parametro ) {

				$nuevo = preg_split( "/_/", $parametro);
				$sql .= $nuevo[0] . " VARCHAR(".$nuevo[1].")," ;
			}

			$sql .= "fecha datetime NOT NULL)";
			

			if ($mysqli->query($sql) === TRUE) {
			    
			} else {
			    echo "Error creating table: " . $mysqli->error;
			}
			
			
		}


		///guardar los datos


		$query = "INSERT INTO ambacar_".$mes."_".$anio."(";	
		foreach (array_keys($_POST) as $parametro ) {
			$nuevo = preg_split( "/_/", $parametro);
			$query .= $nuevo[0].", ";	
		}
		$query .= " fecha) VALUES(";
		foreach (array_keys($_POST) as $parametro ) {
			$query .= "'$_POST[$parametro]', ";	
		}
		$query.= "now())";


		if ($mysqli->query($query) === TRUE) {
		    //
		} else {
		    echo "Error insert data: " . $mysqli->error;
		}

		$mysqli->close();

	}



	$subject = 'Contacto - Landingpage Ambacar';
	$message =
	"<!DOCTYPE html>
	<html lang='es'>
	<head>
		<meta charset='UTF-8'>
		<title>Document</title>
		<style>
			body{width:100%;text-align:center;}
			table{margin:auto;max-width: 600px;}
			p{font-size: 16px;color:#7D7D7D;margin-bottom:0;}
		</style>
	</head>
	<body>
		<table cellpadding='0' cellpadding='0'>
			<tr>
				<td colspan='3'><center><h1>Landing Ambacar - Formulario de Contacto</h1></center></td>
			</tr>";


	foreach (array_keys($_POST) as $parametro ) {
		$nuevo = preg_split( "/_/", $parametro);
		$message .=	
			"<tr>
				<td width='150'><p>".$nuevo[0]."</p></td>
				<td width='20' align='center'><p>:</p></td>
				<td><p>" . $_POST[$parametro] . "</p></td>
			</tr>";
	}

	$message .=		
			"
		</table>
	</body>
	</html>";

	//$to      = 'mlluncor@sb360.com.pe';//
	$to      = 'rchuquisuta@smartbrands.com.pe';    
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: web@smartbrands.com.pe' . "\r\n" .
			'Reply-To: web@smartbrands.com.pe' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	if( @mail($to, $subject, $message, $headers)){
		header('Location: gracias.html');
	}
}
?>