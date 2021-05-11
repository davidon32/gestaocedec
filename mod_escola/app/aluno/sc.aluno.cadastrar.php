<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once "../include.php";

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login -> logado();
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
							    <form action="sistema/controller/valida.aluno.cadastrar.php" method="POST" name="frmAlunoCad">
								    <fieldset>
									    <legend>Cadastro Aluno</legend>

									    <label class="radio">
										
										<input type="radio" name="optionsRadios" id="optionsRadios1" value="M" checked>
											Militar
										</label>
										
										<label class="radio">
										<input type="radio" name="optionsRadios" id="optionsRadios2" value="C">
											Civil
										</label>

										<label>Posto / Graduação</label>
									    <input class="input-xlarge" type="text" placeholder="" name="posto">

									    <label>Nome</label>
									    <input class="input-xlarge" type="text" placeholder="" name="nome">

									    <label>Endereço</label>
									    <input class="input-xlarge" type="text" placeholder="" name="endereco">

									    <label>CPF</label>
									    <input class="input-xlarge" type="text" placeholder="" name="cpf">

									    <label>Endereço</label>
									    <input class="input-xlarge" type="text" placeholder="" name="endereco">

									    <label>Bairro</label>
									    <input class="input-xlarge" type="text" placeholder="" name="bairro">

									    <label>Cidade</label>
									   <?php
									   		include_once 'bairro.php';
									   ?>

									   	<label>Cep</label>
									    <input class="input-xlarge" type="text" placeholder="" name="cep">

									    <label>Telefone</label>
									    <input class="input-xlarge" type="text" placeholder="" name="tel1">

									    <label>Telefone Com.</label>
									    <input class="input-xlarge" type="text" placeholder="" name="tel2">

									    <label>Celular</label>
									    <input class="input-xlarge" type="text" placeholder="" name="cel">

									    <label>Endereço Com.</label>
									    <input class="input-xlarge" type="text" placeholder="" name="endComercial">

									    <label>Profissão</label>
									    <input class="input-xlarge" type="text" placeholder="" name="profissao">

									    <label>Compdec</label>
									    <input class="input-xlarge" type="text" placeholder="" name="compdec">

									    <label>Cursos Realizados</label>
									    <textarea name="cursoRealizados"></textarea>

									    <label>Atividade Defesa Civil</label>
									    <input class="input-xlarge" type="text" placeholder="" name="atividade">

									    <label>Email</label>
									    <input class="input-xlarge" type="text" placeholder="" name="email">

									    <span class="help-block"></span>

									    <button type="submit" class="btn btn-primary" value="alunoCadastrar">Cadastrar</button>
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