<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 

include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';

$id_pmda = isset($_GET['doc']) ? $_GET['doc'] : null;

$pmda = new Pmda();


 $arquivo = $pmda->previewAnexo($id_pmda);

 ?>
 
 <html>
 
 </html>
 <body>
 
 <?php print "<a href='".$arquivo."' name='anexoPmda' id='anexoPmda'>Baixar</a>";?>
 
 </body>

	
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script type="text/javascript">

	$(document).load(function(){

		$("a").on("click", function(event){

			

		});

	});

</script>