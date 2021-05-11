<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 

    include_once PATH.'/include.php';
    
    $comunidade = new Comunidade();

    $id_comunidade = (int) isset($_GET['id']) ? $_GET['id'] : 0;
    $id_rota = (int) isset($_GET['r']) ? $_GET['r'] : 0;
    
    if($id_comunidade > 0){
        
        if($comunidade->AddComunidade($id_comunidade, $id_rota)){
            
                       
            FuncaoBase::vifs("sucesso", "?modulo=pipa&secao=comunidade&acao=cadastro&idrota=".$id_rota);
            
        }
    }
?>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print TITULO;?></title>
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    
    </head>
    <body>
        <!-- TOPO /system/topo.php-->
        <?php include_once(PATH.'/system/topo.php'); ?>
        <div class="container">
         <!-- MENU-->
    		<div class="row-fluid">
    			<div class="span3">
    			    <BR>
    				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
    			</div>
    				<div class="row-fluid">
    					<div class="span9 fdo_corpo">
    
<?php  
    $html = new Html();
    
    $html->form("#", "post", "frmMunicipio", "Busca Município");
    $html->input("text", "municipio", false, array('placeholder'=>'Digite o nome do Municipio'));
    $html->formEnd("Pesquisar", array("title"=>"Pesquisa de Municipio"));
    
    
    $municipio = new Municipio();
    $btnPesquisar = isset($_POST['btnPesquisar']) ? $_POST['btnPesquisar'] :"";
    $nomMuni =  isset($_POST['txtMunicipio']) ? $_POST['txtMunicipio'] :"";
    
    if($btnPesquisar == "Pesquisar"){
    	
    	$dados = $municipio->BuscaMunicipio($nomMuni);

    	
    	print "<table class='table'>";
    	print "<tr>";
    	print "<td>Código</td>";
    	print "<td>Municipio</td>";
    	print "<td>Opções</td>";
    	print "</tr>";
    	
    	
		foreach ($dados as $value) {
	    	print "<tr>";
	    	print "<td>".$value['id_municipio']."</td>";
	    	print "<td>".$value['nome']."</td>";
	    	print "<td>
	    				<a href='?modulo=pipa&secao=comunidade&acao=com&id=".$value['id_municipio']."' title='Adicionar Comunidade'>Adicionar / Alterar</a>
	    		
	    		</td>";
	    	print "</tr>";
		}
		print "</table>";
    }

?>

</div>
				</div>
		</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>
