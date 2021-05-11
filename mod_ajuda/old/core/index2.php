<?php include_once '../../include.php';

	//Login::logado();	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO; ?></title>
		<link href="<?php print PATH;?>/mod_ajuda/css/estilo.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/funcaobase.js"></script>
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="js/mascara.js"></script>
	</head>
	<body>
		
			<img src="<?php print PATH;?>/mod_ajuda/imagem/topo3.png" alt="" />
		
		</div>
		<!-- menu -->
		<div class="menu">
			<?php
			
			//FuncaoBase::vd($_SESSION);
						
			include_once PATH.'/'.'mod_ajuda/core/ajuda.menu.php';
			
			
			?>
		</div>
		<br />
		<div class="logout">
			<div class="logout">
				<a href="logout.php?logout=s">Logout</a>
			</div>
		</div>
		

    
	</body>
</html>
