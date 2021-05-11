<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
/* ****************************************************************************************
 *   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : script para validacao do fechamento de liberacao
*
*******************************************************************************************/
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();

	$_dataMysql = new DataMysql();

	
	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO; ?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	</head>
	<body>
		
				
		<?php

			if(isset($_SESSION['cesta']) && (count($_SESSION['cesta']) > 0)){
		

				$libera = new Liberacao();

				$objMun = new Municipio();

				$saldo = new ControleSaldo();
				
						
						#@ data atual (data que vai ser gerada a liberacao)
						$datalibera = isset($_POST['dt_libera']) ? $_POST['dt_libera'] : null;
									
						#@ id municipio
						$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : null;
						
						#@ id usuario 
						$id_usuario = $_SESSION['seguranca']['idUser'];

						//var_dump($_SESSION);
				
						#@ data limite para pagar material
						$dtLimite = null;

						#@ evento
						$evento = isset($_POST['evento']) ? (htmlspecialchars($_POST['evento'])) : null;
		
						$depDestino = isset($_SESSION['cesta'][0][0]) ? $_SESSION['cesta'][0][0] : null;
		
						$beneficiario = isset($_POST['beneficiario']) ? htmlentities(htmlspecialchars($_POST['beneficiario'])) : null;
											
						$obs = isset($_POST['obs']) ? utf8_decode($_POST['obs']) : null;
						
						$resp = isset($_POST['responsavel']) ? htmlspecialchars($_POST['responsavel']) : null;
						
						$_entrega = isset($_POST['entrega']) ? $_POST['entrega'] : null;
						
						$fonte = isset($_POST['fonte']) ? $_POST['fonte'] : null;
						
						//var_dump($_POST);

						//var_dump($obs);

						
						if ($_dataMysql->validaData($datalibera)) {
							
							#@ data de limite para pagamento de material
							$dtLimite = $_dataMysql->SomarData($datalibera, PRAZO, 0, 0);
							
						}
						
						#@ alimenta a opcao de busca de material 
						if($_entrega == null) {
							
							$_modo_entrega = 'Entrega no Local';
						}
						else {
							
							$_modo_entrega = 'Vira Buscar';
						}

						if($id_municipio == 0){

							$id_municipio = "";
						}
						
						
						//var_dump($)
						
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
										$libera -> libera($_dataMysql->dataForm($datalibera), $id_municipio, $id_usuario, $depDestino, $beneficiario, $evento, $obs, $_dataMysql->dataForm($dtLimite), 0, 0, $resp, $_modo_entrega);
										
										#@ pega o id da ultima liberacao e joga na sessao
										$_SESSION['idLibera'] = $libera -> getIdLibera();
											
										#@ abastece a sessao com os dados da liberacao
										$_SESSION['liberacao'] = array($datalibera, $id_municipio, $id_usuario, $depDestino, $beneficiario, $evento, $obs, $_SESSION['idLibera'], $resp);
									
										// Lancar Itens no Banco
										for ($i = 0; $i < count($_SESSION['cesta']); $i++) {
												
											$libera -> adItem($_dataMysql->dataForm($datalibera),
														$_SESSION['idLibera'],
														$_SESSION['cesta'][$i][2],
														$_SESSION['cesta'][$i][3],
														$_SESSION['cesta'][$i][1],
														0,
														$_SESSION['cesta'][$i][0]);
												
										}
											
										# debitar do saldo do deposito
											for ($i = 0; $i < count($_SESSION['cesta']); $i++) {
									
											$saldo -> DebitarSaldo($_SESSION['cesta'][$i][1], $_SESSION['cesta'][$i][0], $_SESSION['cesta'][$i][3]);
										}
											
								
										FuncaoBase::alert("Liberacao Realizada com Sucesso !");
											
										$_SESSION['cesta'] = array();
										
										print "<div class='text-center cent'> 
												<br />
												<br />
												<a href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_liberacao_pdf\">Salvar Libera&ccedil;&atilde;o em pdf</a>
												<br />
												<a href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_liberacao_recibo&id=".$_SESSION['idLibera']."\";>Comprovante de Liberação</a>
												<br />	
												<a href='javascript: history.back(); this.form.reset();'>Voltar</a></div>";
										
									}else {
									    
                                        //var_dump($_SESSION);
										
										print "<div class='cent text-center'>
												<br />
												<br />
												<a href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_liberacao_pdf\">Salvar Libera&ccedil;&atilde;o em pdf</a>
												<br />
												<a href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_liberacao_recibo&id=".$_SESSION['idLibera']."\";>Comprovante de Liberação</a>
												<br />
												<a href=\"#\" onclick=\"javascript:window.location = 'secao.php?secao=liberacao&acao=liberar';\">Voltar</a></div>";	
									}
														
								
									
							}

			}else {

				print "<script type='text/javascript'>";

				print "alert('Gentileza Preencher os Campos');";

				print "history.back();";

				print "</script>";

			}
								
								
		?>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
	</body>
</html>