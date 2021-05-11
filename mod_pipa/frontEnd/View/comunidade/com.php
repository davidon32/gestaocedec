<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 

    include_once PATH.'/include.php';
    
    $id_municipio = $_GET['id'] ? (int)$_GET['id']:"";
    
    $municipio = new Municipio();
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
    $html->form(" ", "post", "frmMunicipio", "Cadastro de Comunidades");
    $html->input("text", "comunidade", "Nome da Comunidade", array('placeholder'=>'Digite o nome da Comunidade'));
    $html->formEnd("Gravar");
    
    
    //var_dump($btnCadastrar);
    
    $comunidade = new Comunidade();
    
    $dadosCom = $comunidade->buscaComunidadeMunicipio($id_municipio);

    print "<table class='table'>";
    print "<tr><td colspan='3' style='text-align:center;'>Listagem de Comunidades Cadastradas</td></tr>";
    print "<tr>";
    print "<td colspan='2'><span><b>".$municipio->PegaNomeMunicipio($id_municipio)."</b></span></td><td>Total Comunidade :".count($dadosCom)."</td>";
    print "</tr>";
    print "<tr>";
    print "<td>Código</td>";
    print "<td>Comunidade</td>";
    print "<td>Opções</td>";
    print "</tr>";
     
     
    foreach ($dadosCom as $value) {
    	print "<tr>";
    	print "<td>".$value['id_comunidade']."</td>";
    	print "<td>".$value['comunidade']."</td>";
    	print "<td>
	    				<a href='javascript:deletar(".$value['id_comunidade'].")' title='Deletar Comunidade'><img width='30px' src='imagem/delete.png'></a>
	   
	    		</td>";
    	print "</tr>";
    }
    print "</table>";


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
	<script type="text/javascript">

		function deletar(id_comunidade){

			var dados = {

				"id_comunidade" : id_comunidade,
				"opcao"	: "delete", 

			};

			var result = confirm("Deseja Realmente Deletar esta Comunidade ?");

			if(result){
				$.ajax({
                    type: 'POST',
                    url: 'mod_pipa/app/comunidade/func.php',
                    data: dados,
                    success: function(response) {
                        $("#btnCadastar").val("");
                        if(response == 'sim'){
                            alert('Registro não pode ser Apagado porque a Comunidade faz parte de um PMDA !');
                        }else {
                            alert('Registro Apagado com Sucesso !');

                        }
                        location.reload();
                        //console.log(JSON.stringify(response));
                    },
                    error: function(e){
    					console.log(JSON.stringify(e));
                    }

				});
			}
		}

		// gravar comunidade
		$("#btnGravar").click(function(){

			if($("#txtComunidade").val() == ""){

				alert("O Nome da comunidade não pode ficar em Branco !");

			}else {

				var dados = {

						'txtComunidade' : $("#txtComunidade").val(),
						'id_municipio'  : <?=$id_municipio;?>,
						'opcao'         : "cadastro",

				};

				$.ajax({
                    type: 'POST',
                    url: 'mod_pipa/app/comunidade/func.php',
                    data: dados,
                    success: function(response) {
                        //alert("Comunidade Cadastrar com Sucesso !");
                        location.reload();

                    },
                    error: function(e){
    					console.log(JSON.stringify(dados));
                    },
                    
                });

			}

		})

	</script>
