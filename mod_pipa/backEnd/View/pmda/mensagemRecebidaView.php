<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";


# id pmda
$id = "";
if(isset($_POST['id_pmda'])){
	$id = (int)$_POST['id_pmda'];
}elseif(isset($_GET['id_pmda'])){
	$id = (int)$_GET['id_pmda'];
}else {
	$id = null;
}

$idLista = isset($_GET['id']) ? (int)$_GET['id'] : null;

#status pmda
$status = "";
if(isset($_POST['status'])){
	$status = (int)$_POST['status'];
}elseif(isset($_GET['status'])){
	$status = (int)$_GET['status'];	
}else{
	$status = null;
}

$opcao = "";
if(isset($_POST['opcao'])){
	$opcao = isset($_POST['opcao']);
}elseif(isset($_GET['opcao'])){
	$opcao = $_GET['opcao'];
}else {
	$opcao = null;
}

$id_msg_post = isset($_POST['id_msg']) ? (int)$_POST['id_msg'] : null;

$id_mensagem = isset($_GET['id']) ? (int)$_GET['id'] : null;

$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : null;

$pmda = new Pmda();

#  mensagens novas 
if($opcao == "nv"){
 	$lista = $pmda->listaMensagem($id, $status);
	print "<table width='100%' class='table table-bordered table-striped'>";

	if(count($lista) > 0) {
		
		foreach ($lista as $key=> $value) {
			print "<tr>";
			print "<td>".($key+1)."</td>";
			if($status == "0"){
				print "<td><a onclick=\"mensagemLida(".$value['id'].", 'marcar_lida')\" title='Clique aqui para ler a Mensagem' name='msg' data-id_msg='".$value['id']."'>".$value['msg']."</a></td>";
			}else {
			print "<td><a onclick=\"mensagemLida(".$value['id'].", 'ler')\" title='Clique aqui para ler a Mensagem' class='thickbox' name='msg' data-id_msg='".$value['id']."'>".substr($value['msg'], 0, 30).".... &nbsp;&nbsp;&nbsp;&nbsp;Leia mais</a></td>";
			}
			print "<td></td>";
			print "</tr>";
		}
	}else {
		
		echo "não Existe mensagens para este PMDA";
		
	}
	print "</table>";

# ler mensagem
}elseif($opcao == 'ler'){
	
	$msg = $pmda->mensagem($id_msg_post);
	print "<p style='text-align:center'>";
	//print "<input type='button' value='voltar' onclick='javascript:history.back();'</p>";
	print "<table class='table table-bordered table-striped'>";
	print "<tr>";
	print "<td style='text-align: justify;'>".$msg['msg']."</td>";
	print "</tr>";

 # Todas mensagens de um PMDA 
}elseif((!is_null($id)) && ($status == '1')){
	
	$lista = $pmda->listaMensagem($id);
	print "<p>".Municipio::PegaNomeMunicipio($lista[0]['id_municipio'])."</p>";
	print "<br><h4><p style='text-align:center'>Histórico de Mensagens Recebidas</p></h4>";
	print "<table class='table table-bordered table-striped'>";
	
	print "<th>#</th>";
	print "<th>PMDA</th>";
	print "<th>Data/Autor</th>";
	print "<th>Mensagem</th>";
	print "<th>Situação</th>";
	
	foreach ($lista as $key=> $value) {
			
		if($value['status'] == 0){
			$situacao = 'Não Lida';
			$css = "font-weight:bold;";
		}else {
			$situacao = 'Lida';
			$css = "";
		}
			
		print "<tr>";
		print "<td style='".$css."'>".($key+1)."</td>";
		print "<td style='".$css."'>".$value['protocolo']."</td>";
		print "<td style='".$css."'>".DataMysql::dataCompletaVisual($value['dt_envio'])." / ".Usuario::getNomeId($value['id_usuario'])."</td>";
		print "<td style='".$css."'>".$value['msg']."</td>";
		print "<td style='".$css."'>".$situacao."</td>";
		print "</tr>";

	}

	print "</table>";
	print "</div>";

# Historico geral de Mensagens de todos os PMDA'S
}elseif ((is_null($opcao)) && (isset($id_municipio))){

	

 	$lista = $pmda->listaMsgMunicipio($id_municipio);
 	print "<br><p style='text-align:center'><input type='button' class='btn' onclick='javascript:history.back();' value='Voltar'></p>";
 	print "<br><h4><p style='text-align:center'>Histórico de Mensagens Recebidas</p></h4>";
 	print "<table class='table table-bordered table-striped'>";
 	
 	print "<th>#</th>";
 	print "<th>PMDA</th>";
 	print "<th>Data</th>";
 	print "<th>Mensegam</th>";
 	print "<th>Situação</th>";
 	
 	foreach ($lista as $key=> $value) {
 		
 		if($value['status'] == 0){
 			$situacao = 'Não Lida';
 			$css = "font-weight:bold;";
 		}else {
 			$situacao = 'Lida';
 			$css = "";
 		}
 		
 		print "<tr>";
 		print "<td style='".$css."'>".($key+1)."</td>";
 		print "<td style='".$css."'>".$value['protocolo']."</td>";
 		print "<td style='".$css."'>".DataMysql::dataCompletaVisual($value['dt_envio'])." / ".Usuario::getNomeId($value['id_usuario'])."</td>";
 		print "<td style='".$css."'>".$value['msg']."</td>";
 		print "<td style='".$css."'>".$situacao."</td>";
 		print "</tr>";
 	}
 	//
 	print "</table>";
 	//print "</div>";
 	//print "<link rel='stylesheet' href='css/bootstrap3.3.2.min.css' rel='stylesheet'/>";

 #todas mensagens	
 }elseif(!is_null($id)){
	
	$lista = $pmda->listaMensagem($id);
	print "<p>".Municipio::PegaNomeMunicipio($lista[0]['id_municipio'])."</p>";
	print "<br><h4><p style='text-align:center'>Histórico de Mensagens Recebidas</p></h4>";
	print "<table class='table table-bordered table-striped'>";
	
	print "<th>#</th>";
	print "<th>PMDA</th>";
	print "<th>Data/Autor</th>";
	print "<th>Mensagem</th>";
	print "<th>Situação</th>";
	
	foreach ($lista as $key=> $value) {
			
		if($value['status'] == 0){
			$situacao = 'Não Lida';
			$css = "font-weight:bold;";
		}else {
			$situacao = 'Lida';
			$css = "";
		}
			
		print "<tr>";
		print "<td style='".$css."'>".($key+1)."</td>";
		print "<td style='".$css."'>".$value['protocolo']."</td>";
		print "<td style='".$css."'>".DataMysql::dataCompletaVisual($value['dt_envio'])." / ".Usuario::getNomeId($value['id_usuario'])."</td>";
		print "<td style='".$css."'>".$value['msg']."</td>";
		print "<td style='".$css."'>".$situacao."</td>";
		print "</tr>";

	}

	print "</table>";
	print "</div>";
}

 if(isset($_GET['id'])){
	 print "<p name='imprimir' id='imprimir' style='text-align:center;'><a class='btn btn-primary' href='javascript:window.print();' >Imprimir</a>

	 <a class='btn btn-primary' href='javascript:history.back();'>Voltar</a>
	 </p>";
 }
?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ============================ -->
<?php include_once "template/page/rodape.php";?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

/* Marca Mensagem lida */
		function mensagemLida(id_msg, opcao){

			$.ajax({
				url : '/mod_index/app/login/ckLogin.php',
			    type : 'POST',
			    success : function(response) {
			      	if(response == "sucesso"){
						// codigo
			
			                var dados = {
			                        		"id_msg" : id_msg,
			                        		"opcao"  : opcao,
			                        	};
			    
			                $.ajax({
			                    type: 'POST',
			                    url: '/mod_pipa/View/pmda/funcAdm.php',
			                    data: dados,
			                    success: function(response) {
			                    	alert("Mensagem Lida")	;
			                    },
			                    error: function(e){
			    					console.log(dados+ 'erro'+JSON.stringify(e));
			                    }
			                    
			                });
			                
			      	}else {
				    	alert('Sessão expirada !')
						window.location.href ='index2.php';
					}
				},
				error : function(response){
				    	console.log(JSON.stringify(response));
				}
			});

		};
</script>