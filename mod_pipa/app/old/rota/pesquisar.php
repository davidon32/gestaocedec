<?php session_start();
include_once PATH.'/include.php';
print "<!DOCTYPE html>";

?>
<html>
<head>
<title>Pesquisa de Rota</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
    <div class="row-fluid">
    <img src="../imagem/topo_pipa.png">
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- LOGOUT -->
	    <div class="row-fluid">
	      <div class="span12 text-right">
	        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
	        <p>
	        <hr>
	      </div>
	    </div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
		<div class="span9">
    	
    <legend>Pesquisa de Rota</legend>
    <br>
	<form action="#" method="POST" name="" id="" class="" />
        <label>Nome da Rota</label>
        <input type="text" name="rota" id="rota">
        <i style="color: red;"> Digite o Nome ou parte do Municipio para pesquisar.</i>
        <br />
        <input type="submit" name="enviar" id="enviar" value="Pesquisar" class="btn btn-primary" />
        <input type="hidden" class='span8' />
        <a href='?modulo=pipa&secao=rota&acao=cadastro' class='btn btn-primary'>Cadastrar</a>
    	
	</form>


	<?php
	
	   /* nome da rota para pesquisa */
	   $_rota = isset($_POST['rota']) ? $_POST['rota'] : null;
    
        /**
         * 
         * Operacao para contratacao = 'cont'
         */
        $_op = isset($_GET['op']) ? $_GET['op'] : null;

    //var_dump($_POST);
	?>

	<table border="0" id="" class="" cellspacing="0" cellpadding="0" align="center">

		<tr>
			<td><?php
            if ($_rota != null) {

                #@ busca rota rescindida
                $dados = Rota::buscaRota($_rota, false);

                //var_dump($dados);

                print utf8_decode("<table border='0' width='400' class='table'>
                        <tr>
                            <th align='left'>Nome</th>
                            <th>Rota</th>
                            <th>Última Ano Contr.</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>");

                for ($i = 0; $i < count($dados); $i++) {

                    //var_dump($dados);
                    /* teste de consulta de rota cadastrada*/
                    if ($_op == null) {
                            
                        if($dados[$i]['situacao'] == "A"){
                            
                            print "<tr>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['nome']) . "</td>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['num_rota']) . "</td>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['ano']) . "</td>
                                    <td align='left' style='color:red'>Contrato Ativo</td>
                                    <td><a href='?modulo=pipa&secao=rota&acao=alterar&id=".$dados[$i]['id_rota']."'><i class='icon-edit' title='Editar'></a></td>
                                    <td><a href='?modulo=pipa&secao=rota&acao=visualizar&id=".$dados[$i]['id_rota']."&mun=".$dados[$i]['id_municipio']."'><i class='icon-eye-open' title='Visualizar Comunidades'></a></td>
                                   </tr>";
                            
                        }else {

                            print "<tr>
                                    <td align='left' style='color:blue'>" . htmlentities($dados[$i]['nome']) . "</td>
                                    <td align='left' style='color:blue'>" . htmlentities($dados[$i]['num_rota']) . "</td>
                                    <td align='left' style='color:blue'>" . htmlentities($dados[$i]['ano']) . "</td>
                                    <td align='left' style='color:blue'>Sem Contrato</td>
                                   </tr>";
                        }

                    } else {
                        /* teste consulta de rota para cadastrar contrato*/
                        
                        if($dados[$i]['situacao'] == "A"){
                                
                            print "<tr>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['nome']) . "</td>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['num_rota']) . "</td>
                                    <td align='left' style='color:red'>" . htmlentities($dados[$i]['ano']) . "</td>
                                    <td align='left' style='color:red'>Contrato Ativo </td>
                                    <td><a href='#'><i class='icon-edit' title='Editar'></a></td>
                                  </tr>";
                        }else {
                            
                            print "<tr>
                                    <td align='left'>" . htmlentities($dados[$i]['nome']) . "</td>
                                    <td align='left'>" . htmlentities($dados[$i]['num_rota']) . "</td>
                                    <td align='left'>" . htmlentities($dados[$i]['ano']) . "</td>
                                    <td>
                                        <a href=\"#\" id=\"nome_mot\" name=\"nome_mot\" onclick=\"levarcodigo('" . 
                                                                        htmlentities($dados[$i]['id_rota'])  . "', '" . 
                                                                        htmlentities($dados[$i]['nome'])     . "', '" .
                                                                        htmlentities($dados[$i]['num_rota']) . "');\">Adicionar</a>
                                    </td>
                                  </tr>";
                            
                        }

                    }

                }
            }
			?>
			
		<tr>
			<td colspan="3" align="center"><br /><br />
			    <?php FuncaoBase::Fechar(); ?></td>
		</tr>
	</table>
	</div>
	</div>
	<div class="row-fluid fdo_corpo"></div>
		<div class="row-fluid text-center">
			<small><?php print RODAPE;?></small>
		</div>
	
</body>
<script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>	
	<script>
		function levarcodigo(id_rota, nome, rota) {
			/** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
			 *    e a descricao para o <label>
			 */
			top.opener.document.getElementById("id_rota").value = id_rota;
			top.opener.document.getElementById("nome_rota").value = nome;
			top.opener.document.getElementById("num_rota").value = rota;
			window.close();
		}

    </script>
</html>



