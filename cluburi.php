<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Adaugare / Modificare Cluburi si Echipe - Stafeta Muntilor</title>
<link href="css/bootstrap.css" rel="stylesheet" type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/font-awesome.css">
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="stafeta muntilor" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->


<link href="css/nav.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/main.js"></script> <!-- Resource jQuery -->
					<!-- chart -->
					<script src="js/Chart1.js"></script>
					<!-- //chart -->
</head>
<body>
	<div class="total-content">
		<div class="col-md-3 side-bar">
			<div class="logo text-center">
				<img src="images/logo.png" alt="" />
			</div>
		<?php include('meniu.php'); ?>
		</div>
		<div class="col-md-9 content">
				<div class="clearfix"></div>
			
			<div class="list_of_members">
		<?php include('top-dreapta.php'); ?>
			</div>
			<p class="home"><strong>Adaugare / Modificare Cluburi si Echipe - Stafeta Muntilor</strong></p>
			<div class="total-continut">

				<div class="organizator"><strong>Cluburi:</strong> 
					<div class="adauga"><a href="cluburi/adaugacluburi.php">ADAUGA</a></div> |
					<div class="modifica"><a href="cluburi/modificacluburi.php">MODIFICA </a></div> |
					<div class="modifica"><a href="cluburi/listacluburi.php">LISTA </a></div>
				</div>
				
				<div class="organizator"><strong>Categoria Open:</strong> 
					<div class="adauga"><a href="configurareopen/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurareopen/modifica.php">MODIFICA </a></div>
				</div>

				<div class="organizator"><strong>Categoria Family:</strong> 
					<div class="adauga"><a href="configurarefamily/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurarefamily/modifica.php">MODIFICA </a></div>
				</div>
				
				<div class="organizator"><strong>Categoria Juniori:</strong> 
					<div class="adauga"><a href="configurarejuniori/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurarejuniori/modifica.php">MODIFICA </a></div>
				</div>
				
				<div class="organizator"><strong>Categoria Feminin:</strong> 
					<div class="adauga"><a href="configurarefeminin/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurarefeminin/modifica.php">MODIFICA </a></div>
				</div>
				
				<div class="organizator"><strong>Categoria Veterani:</strong> 
					<div class="adauga"><a href="configurareveterani/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurareveterani/modifica.php">MODIFICA </a></div>
				</div>
				
				<div class="organizator"><strong>Categoria Elite:</strong> 
					<div class="adauga"><a href="configurareelite/adauga.php">ADAUGA</a></div> |
					<div class="modifica"><a href="configurareelite/modifica.php">MODIFICA </a></div>
				</div>
			
			</div> 

		</div>
		<div class="clearfix"></div>
	</div>
	<div class="footer">
			<?php include('footer.php'); ?>	
		</div>
</body>
</html>