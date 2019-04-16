<?php
	if ($_GET) {
		if (isset($_GET['data'])) {
		    
		    
		    header("Pragma: public");
            header("Expires: 0");
            $filename = $_GET['data'].".xls";
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header("Content-type: application/x-msdownload;");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: no-cache");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

			$table_data = $_GET['data'];

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

					$array = array();
					$result = $mysqli->query("DESCRIBE ".$table_data);

					while ($row = $result->fetch_array()) {
						$array[] = $row[0];
					}
?>
				<table class="table table-bordered table-sm small">
					<tr>
						<?php foreach ($array as $col_name) { ?>
						<th><?php echo $col_name; ?></th>
						<?php } ?>
					</tr>

					<?php

						$datos = array();
						$query = "SELECT * FROM ".$table_data." ORDER BY fecha ASC";
						$res = $mysqli->query($query);

						while ($row = $res->fetch_array()) {
							$datos[] = $row;
						}

						foreach ($datos as $d) {
						echo "<tr>";
							foreach ($array as $col_name) {
								if( $col_name == 'fecha' ){
					?>
								<td><?php echo date("d-m-Y", strtotime($d[$col_name])); ?></td>
					<?php
								}
								else{
					?>
								<td><?php echo utf8_decode($d[$col_name]); ?></td>

					<?php
								}
							}
						echo "</tr>";
						}
					?>



				</table>
<?php
		}
		else{
			exit();
		}
	}
	else{
		exit();
	}
?>