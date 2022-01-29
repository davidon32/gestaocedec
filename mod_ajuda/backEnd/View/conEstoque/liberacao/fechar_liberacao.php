<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<?php include_once "template/page/headerPageSimples.php";?>
	
<?php

	if(isset($_SESSION['cesta']) && (count($_SESSION['cesta']) > 0)){
		

		$libera = new Liberacao();

		$objMun = new Municipio();

		$saldo = new ControleSaldo();

		$_dataMysql = new DataMysql();
					
							
		#@ data atual (data que vai ser gerada a liberacao)
		$datalibera = date('d/m/Y') ;
                        
                $dataRecibo = isset($_POST['dt_libera']) ? $_POST['dt_libera'] : null;
                
                //var_dump($dataRecibo, $datalibera);
                //die();
										
		#@ id municipio
		$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : null;
							
		#@ id usuario 
		$id_usuario = $_COOKIE['seguranca']['idUser'];
					
		#@ data limite para pagar material
		$dtLimite = null;

		#@ evento
		$evento = isset($_POST['evento']) ? (htmlspecialchars($_POST['evento'])) : null;

		if($evento == "Selecione o Evento"){
			$evento = null;
		}
		
		$depDestino = isset($_SESSION['cesta'][0][0]) ? $_SESSION['cesta'][0][0] : null;
		
		$beneficiario = isset($_POST['beneficiario']) ? htmlentities(htmlspecialchars($_POST['beneficiario'])) : null;
		
		$obs = isset($_POST['obs']) ? FuncaoBase::tirarAcentos($_POST['obs']) : null;
		
		$resp = isset($_POST['responsavel']) ? htmlspecialchars($_POST['responsavel']) : null;
		
		$_entrega = isset($_POST['entrega']) ? $_POST['entrega'] : null;
		
		$fonte = isset($_POST['fonte']) ? $_POST['fonte'] : null;
		if($fonte == "Selecione a Fonte"){
			$fonte = null;
		}
							
		if ($_dataMysql->validaData($datalibera)) {
								
			#@ data de limite para pagamento de material
			$dtLimite = $_dataMysql->SomarData($datalibera, PRAZO, 0, 0);
								
		}
							
		#@ alimenta a opcao de busca de material 
		if($_entrega == null) {
			$_modo_entrega = 'Entrega no Local';
		}else {						
			$_modo_entrega = 'Vira Buscar';
		}

		if($id_municipio == 0){
			$id_municipio = "";
		}

		$campo = array("Municipio"=>$id_municipio,
			"Beneficiario"=>$beneficiario,
			"Evento"=>$evento,
			"Data"=>$datalibera,
			"Observação"=> $obs,
			"Responsável"=> $resp,
			"Fonte de Origem"=>$fonte);

							
			if(FuncaoBase::campoBranco($campo)) {
				#@ testar se tem liberacao para executar 
				if(count($_SESSION['cesta']) > 0) {
					// Lancar Liberacao do Banco
					$id_liberacao = $libera -> libera($_dataMysql->dataForm($datalibera), $id_municipio, $id_usuario, $depDestino, $beneficiario, Material::getNomeEvento($evento), $obs, $_dataMysql->dataForm($dtLimite), 0, 0, $resp, $_modo_entrega, $_dataMysql->dataForm($dataRecibo));
                                        
                                        						#@ pega o id da ultima liberacao e joga na sessao
						$_SESSION['idLibera'] = $id_liberacao[0];
												
						#@ abastece a sessao com os dados da liberacao
						$_SESSION['liberacao'] = array($datalibera, $id_municipio, $id_usuario, $depDestino, $beneficiario, Material::getNomeEvento($evento), $obs, $_SESSION['idLibera'], $resp);
										
						// Lancar Itens no Banco
						for ($i = 0; $i < count($_SESSION['cesta']); $i++) {
													
							$libera -> adItem($_dataMysql->dataForm($datalibera),
								$_SESSION['idLibera'],
								$_SESSION['cesta'][$i][2],
								$_SESSION['cesta'][$i][3],
								$_SESSION['cesta'][$i][1],
								0,
								$_SESSION['cesta'][$i][0],
								$_SESSION['cesta'][$i][4]);
													
						}
												
						# debitar do saldo do deposito
						for ($i = 0; $i < count($_SESSION['cesta']); $i++) {
							$saldo -> DebitarSaldo($_SESSION['cesta'][$i][1], $_SESSION['cesta'][$i][0], $_SESSION['cesta'][$i][3]);
						}
												
						FuncaoBase::alert("Liberacao Realizada com Sucesso !");
										
							$_SESSION['cesta'] = array();
											
						print "<br><br><div class='col-md-12 text-center'><br><br>";
						print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=comprov_lib&id=".$_SESSION['idLibera']."\" class='btn btn-success'>Impressao Recibo/PDF</a><br><br>";
						print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=liberacao\" class='btn btn-success'>Voltar</a><br><br>";
						print "</div>";
						
					}else {
						
						print "<br><br><div class='col-md-12 text-center'><br><br>";
						print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=comprov_lib&id=".$_SESSION['idLibera']."\" class='btn btn-success'>Impressao Recibo/PDF</a><br><br>";
						print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=liberacao\" class='btn btn-success'>Voltar</a><br><br>";
						print "</div>";
						
					}
				}
				
			}else {
				
				
				print "<br><br><div class='col-md-12 text-center'><br><br>";
				print "<span class=\"alert\">Gentileza Preencher os Campos</span><br><br>";
				//print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=comprov_lib&id=".$_SESSION['idLibera']."\" class='btn btn-success'>Impressao Recibo/PDF</a><br><br>";
				print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=liberacao\" class='btn btn-success'>Voltar</a><br><br>";
		print "</div>";
	}
								
								
?>