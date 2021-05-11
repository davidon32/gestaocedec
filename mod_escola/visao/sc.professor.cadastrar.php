<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once "../include.php";

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login -> logado();

$_professor = new Professor();

$_id = isset($_GET['id']) ? FuncaoBase::noSqlInjection($_GET['id']) : false;

if($_id) {
    /* alteracao */
    $dados = $_professor->pesquisaProfessorAlterar($_id);
    $_url_form = "secao.php?secao=professor&acao=alterar";

}else {
    
    $dados = "";
    $_url_form = "secao.php?secao=professor&acao=validarCadastro"; 
}




?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php print TITULO; ?></title>
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<!-- TOPO -->
        <div class="row-fluid text-center">
            <img src="../imagem/topo_escola.png" />
            <hr>
        </div>
		<!-- BARRA -->
        <div class="row-fluid">
          <div class="span6 text-left"><small><?php print "Data :" . date("d/m/Y"); ?></small></div>
          <div class="span6 text-right"><small><?php print "Hora :" . date("H:i:s"); ?></small></div>
        </div>

        <!-- LOGOUT -->
        <div class="row-fluid">
          <div class="span12 text-right">
            <a class="btn btn-primary" href="../core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
            <p>
            <hr>
          </div>
        </div>

        <!-- MENU -->
        <div class="row-fluid">
            <div class="span3"><?php
            include_once 'visao/sc.escola.menu.php';
        ?>
        </div>
		<div class="span9 fdo_corpo">
		  <br />
			<form action="<?php print $_url_form;?>" method="POST" name="frmCadastroProf">
			<fieldset>
			    <legend>Cadastro Professor</legend>
			    
			    <fieldset>
			         Servidor GMG<br>
			             Sim :<input type="radio" name="func" value="0">
			             Não :<input type="radio" name="func" value="1"><br><br>
			    
			    </fieldset>
			    
			    

			    <label>Nome</label>
                <input class="span8" type="text" placeholder="" name="nome" value="<?php print ($dados) ? utf8_encode($dados['nome']) : "";?>">
                <input type="hidden" name="id_professor" value="<?php print ($dados != "") ? $dados['id_professor'] : "" ?>" />
			    
			    <label>CPF</label>
                <input class="input-xlarge" type="text" placeholder="" name="txt_cpf" data-mask="999.999.999-99" value="<?php print ($dados) ? utf8_encode($dados['cpf']) : "";?>">

			    <label>Número Polícia/Identidade</label>
			    <input class="input-xlarge" type="text" placeholder="" name="num_policia" value="<?php print ($dados) ? $dados['num_policia'] : "";?>">

			    <label>Profissão</label>
			    <input class="input-xlarge" type="text" placeholder="" name="profissao" value="<?php print ($dados) ? utf8_encode($dados['profissao']) : "";?>">

			    <label>Cargo / Posto / Graduação</label>
			    <input class="input-xlarge" type="text" placeholder="" name="posto" value="<?php print ($dados) ? utf8_encode($dados['posto']) : "";?>">

			    <label>Obs</label>
			    <textarea rows="5" placeholder="" name="obs" class="span8">
			        <?php print ($dados) ? utf8_encode($dados['obs']) : "";?>
			    </textarea>
			    <br>
			    <button type="submit" class="btn btn-primary" name="btn_cadastrar" value="btn_cadastrar"><?php print ($dados) ? "Alterar" : "Cadastrar";?></button>
        	    </fieldset>
		  </form>

		</div>
		</div>
		<!-- RODAPE -->
        <div>
            <div class="row-fluid text-center">
                <small><?php print RODAPE;?></small>
            </div>
        </div>
	</div>    
    <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
</body>
</html> 