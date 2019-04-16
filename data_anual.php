<?php

		header("Pragma: public");
        header("Expires: 0");
        $filename = "santabeatriz_".$_GET['data'].".xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-type: application/x-msdownload;");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


		$year = $_GET['data'];

		$server = "localhost";
    	$user = "abr06sb3_root";
    	$password = "smartbrands1";
    	$database = "abr06sb3_landing";

		$mysqli = new mysqli($server, $user, $password, $database);
		$mysqli->set_charset("utf8");

		if ($mysqli->connect_errno) {
		    printf("Fallo la conexión: \n", $mysqli->connect_error);
		    exit();
		}


		$meses = array('enero',
		              'febrero',
		              'marzo',
		              'abril',
		              'mayo',
		              'junio',
		              'julio',
		              'agosto',
		              'setiembre',
		              'octubre',
		              'noviembre',
		              'diciembre');

		$tablas = array();
		$result = $mysqli->query("SHOW TABLES like 'ambacar_%_$year' ");

		while ($row = $result->fetch_array()) {
			$tablas[] = $row[0];
		}

		$tabla_meses = array();
		foreach ($tablas as $t) {
			$array = explode("_", $t);
			$tabla_meses[] = $array[1];
		}
		$tabla_meses =  ordenar_meses($meses, $tabla_meses);

		$lista_columnas = ordenar_columnas($mysqli, $tablas);

		function ordenar_meses($array_meses_ord,$meses){
			$lista_ordenada = array();
			foreach ($array_meses_ord as $mes) {
				foreach ($meses as $item) {
					if($mes == $item){
						$lista_ordenada[] = $item; 
					}
				}
			}
			return $lista_ordenada;
		}

		function ordenar_columnas($mysqli, $tablas){
			$columnas = array();

			foreach ($tablas as $t) {
				$result = $mysqli->query("DESCRIBE ".$t);
				$array = array();
				while ($row = $result->fetch_array()) {
					$array[] = $row[0];
				}
				$columnas[] = $array;
			}

			$columnas_ini = $columnas[0];


			foreach ($columnas as $col_list) {
				foreach ($col_list as $col) {
					if (!in_array($col, $columnas_ini)) {
						array_splice($columnas_ini, count($columnas_ini)-1, 0, $col);
					}
				}
			}

			return $columnas_ini;
		}

		?>

			<table>
			<tr>
			<?php foreach ($lista_columnas as $cls) { ?>
				<th><?php echo $cls; ?></th>
			<?php } ?>
			</tr>

			<?php 
				$cont = 1;
				foreach ($tabla_meses as $tabla) {
					$datos = array();
					$query = "SELECT *  FROM ambacar_".$tabla."_$year ORDER BY id ASC";
					$result = $mysqli->query($query);

					while ($row = $result->fetch_array()) {
						$datos[] = $row;
					}

					foreach ($datos as $d ) {
						echo "<tr>";
						foreach ($lista_columnas as $c) {
							if($c == 'id'){
								echo "<td>".$cont."</td>";$cont++;
							}
							else if( $c == 'fecha' ){
				?>
							<td><?php echo date("d-m-Y", strtotime($d[$c])); ?></td>
				<?php
							}
							else{
			?>
							<td><?php echo utf8_decode($d[$c]); ?></td>
			<?php 		
							}
						}
						echo "</tr>";
					}
			
				} 
			?>
			</table>
<?php


?>