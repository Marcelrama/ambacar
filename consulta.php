<?php
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
	
	$fecha = '';
	/*obteniendo fecha del servidor*/
	$result = $mysqli->query('SELECT NOW()');
	while ($row = $result->fetch_array()) {
		$fecha = new DateTime($row[0]);
	}

	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');

	$ano = strftime("%Y", $fecha->getTimestamp());
	$mes = strftime("%B", $fecha->getTimestamp());
?>

<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Ambacar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"  crossorigin="anonymous">
	<meta name="robots" content="noindex" />
	<link rel="stylesheet" href="style.css">
	<style>
	    .bubblingG {
	text-align: center;
	width:140px;
	height:88px;
	margin: auto;
	
	margin: auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;

}

.bubblingG span {
	display: inline-block;
	vertical-align: middle;
	width: 18px;
	height: 18px;
	margin: 44px auto;
	background: rgb(150,147,150);
	border-radius: 88px;
		-o-border-radius: 88px;
		-ms-border-radius: 88px;
		-webkit-border-radius: 88px;
		-moz-border-radius: 88px;
	animation: bubblingG 1.165s infinite alternate;
		-o-animation: bubblingG 1.165s infinite alternate;
		-ms-animation: bubblingG 1.165s infinite alternate;
		-webkit-animation: bubblingG 1.165s infinite alternate;
		-moz-animation: bubblingG 1.165s infinite alternate;
}

#bubblingG_1 {
	animation-delay: 0s;
		-o-animation-delay: 0s;
		-ms-animation-delay: 0s;
		-webkit-animation-delay: 0s;
		-moz-animation-delay: 0s;
}

#bubblingG_2 {
	animation-delay: 0.3495s;
		-o-animation-delay: 0.3495s;
		-ms-animation-delay: 0.3495s;
		-webkit-animation-delay: 0.3495s;
		-moz-animation-delay: 0.3495s;
}

#bubblingG_3 {
	animation-delay: 0.699s;
		-o-animation-delay: 0.699s;
		-ms-animation-delay: 0.699s;
		-webkit-animation-delay: 0.699s;
		-moz-animation-delay: 0.699s;
}



@keyframes bubblingG {
	0% {
		width: 18px;
		height: 18px;
		background-color:rgba(120,120,120,0.97);
		transform: translateY(0);
	}

	100% {
		width: 42px;
		height: 42px;
		background-color:rgb(255,255,255);
		transform: translateY(-37px);
	}
}

@-o-keyframes bubblingG {
	0% {
		width: 18px;
		height: 18px;
		background-color:rgba(120,120,120,0.97);
		-o-transform: translateY(0);
	}

	100% {
		width: 42px;
		height: 42px;
		background-color:rgb(255,255,255);
		-o-transform: translateY(-37px);
	}
}

@-ms-keyframes bubblingG {
	0% {
		width: 18px;
		height: 18px;
		background-color:rgba(120,120,120,0.97);
		-ms-transform: translateY(0);
	}

	100% {
		width: 42px;
		height: 42px;
		background-color:rgb(255,255,255);
		-ms-transform: translateY(-37px);
	}
}

@-webkit-keyframes bubblingG {
	0% {
		width: 18px;
		height: 18px;
		background-color:rgba(120,120,120,0.97);
		-webkit-transform: translateY(0);
	}

	100% {
		width: 42px;
		height: 42px;
		background-color:rgb(255,255,255);
		-webkit-transform: translateY(-37px);
	}
}

@-moz-keyframes bubblingG {
	0% {
		width: 18px;
		height: 18px;
		background-color:rgba(120,120,120,0.97);
		-moz-transform: translateY(0);
	}

	100% {
		width: 42px;
		height: 42px;
		background-color:rgb(255,255,255);
		-moz-transform: translateY(-37px);
	}
}

#loadingDiv{
display:none;
position: fixed;
left: 0;
right: 0;
top: 0;
bottom: 0;
background: rgba(255,255,255,0.7);
z-index:9999;
}

.nav-bar{width: 300px;height: 100%;}
.main{width: calc(100% - 300px);}
.panel{height: 100%;}
body, html{height: 100%;}
nav button{cursor: pointer;}
nav button:focus{background-color:#dd4510 !important;color:white !important;}
.btn-excel{display: inline-block;margin: 5px;position:relative;}
.btn-excel > img{width: 44px;
padding: 5px;
border: 1px dashed #c8c8c8;
border-radius: 5px;}
.btn-excel:hover:after{
content: "";
position: absolute;
left: 0;
right: 0;
top: 0;
bottom: 0;
background: rgba(0,0,0,.1);
border-radius: 5px;
}
	</style>
</head>
<body>
    <div id="loadingDiv">
        <div class="bubblingG">
        	<span id="bubblingG_1">
        	</span>
        	<span id="bubblingG_2">
        	</span>
        	<span id="bubblingG_3">
        	</span>
        </div>
    </div> 
    
    
    
	<div class="panel d-flex">
		<div class="nav-bar mt-5">
			<img class="mb-2" src="http://smartbrands.com.pe/landing/ambacar/images/ambacar-logo.jpg" width="100%" height="auto">
			<nav class="flex">
				<?php
				    $meses = array('enero',
				              'febrero',
				              'marzo',
				              'abril',
				              'mayo',
				              'junio',
				              'julio',
				              'agosto',
				              'septiembre',
				              'octubre',
				              'noviembre',
				              'diciembre');
				              
					$tablas = array();
					$result = $mysqli->query("SHOW TABLES like 'ambacar%' ");

					while ($row = $result->fetch_array()) {
						$tablas[] = $row[0];
					}

				?>
				
				<?php 
				    foreach ($meses as $mess) { 
				        foreach ($tablas as $tabla) {
				            $nuevo = preg_split( "/_/", $tabla);
				            if($nuevo[1]  == $mess){
				?>
				    <button type="button" class="show-bd list-group-item list-group-item-action rounded-0 small" data-base="<?php echo $tabla; ?>"><?php echo $tabla; ?></button>
				<?php 
				            }
				        }
				    } 
				?>
			</nav>
			<a class="btn-excel m-0 mt-4 btn-block text-dark" style="text-decoration:none !important;border:1px dashed #2b2b2b;border-radius:3px;text-transform: uppercase;font-size: 12px;" href="#" nofollow><img style="border:none;" src="http://tmgi.pe/santabeatriz/images/excel.png"><span class="ml-3">Exportar por mes</span></a>
			<a class="btn-excel m-0 mt-3 btn-block text-dark" href="data_anual.php?data=2018" nofollow style="text-decoration:none !important;border:1px dashed black;border-radius:3px;text-transform: uppercase;font-size: 12px;"><img class"mr-3" style="border:none !important;" src="http://tmgi.pe/santabeatriz/images/excel.png"><span class="ml-3">Reporte 2018</span></a>
		</div>
		
		<div class="main">
			<div class="container mt-5">
				<h4 id="title" class="text-muted"><?php echo "ambacar_".$mes."_".$ano; ?></h4>
				<?php
					$array = array();
					$result = $mysqli->query("DESCRIBE ".$tablas[0]);

					while ($row = $result->fetch_array()) {
						$array[] = $row[0];
					}
				?>
				<div id="content-table">
					<table class="table table-bordered table-sm small">
						<tr>
							<?php foreach ($array as $col_name) { ?>
							<th><?php echo $col_name; ?></th>
							<?php } ?>
						</tr>

						<?php

							$datos = array();
							$query = "SELECT * FROM ambacar_".$mes."_".$ano." ORDER BY fecha ASC";
							$res = $mysqli->query($query);

							while ($row = $res->fetch_array()) {
								$datos[] = $row;
							}
							
							$cont = 1;

							foreach ($datos as $d) {
							echo "<tr>";
								foreach ($array as $col_name) {
									if( $col_name == 'fecha' ){
						?>
									<td><?php echo date("d-m-Y", strtotime($d[$col_name])); ?></td>
						<?php
									}
									elseif($col_name == 'id'){
										echo "<td>".$cont."</td>";$cont++;
									}
									else{
						?>
									<td><?php echo $d[$col_name]; ?></td>

						<?php
									}
								}
							echo "</tr>";
							}
						?>
					</table>
				</div>
				
			</div>
		</div>
		
	</div>
<?php
	if ($_GET) {
		
	}
?>

<script src="js/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script>
	$('.show-bd').click(function(){
		var data = $(this).attr('data-base');
		$('#content-table').load('data.php?data='+data);
		$('#title').text(data);
	});
	
	$('.btn-excel').click(function(){
	    window.location.href="http://smartbrands.com.pe/landing/ambacar/data2.php?data="+$('#title').text();
	});
	
	$(document).ajaxStart(function(){
          $("#loadingDiv").css("display","block");
        });
        $(document).ajaxComplete(function(){
          $("#loadingDiv").css("display","none");
        });
</script>
</body>
</html>
