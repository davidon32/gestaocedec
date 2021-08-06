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
					<div class="span9">
							<br />
							    <form>
								    <fieldset>
									    <legend>Montar Turma</legend>
									    <label>Número</label>
									    <input class="input-xlarge" type="text" placeholder="" name="numero">

									    <label>Órdem Serviço</label>
									    <input class="input-xlarge" type="text" placeholder="" name="os">

									    <label>Curso</label>
									    <select name="curso">
									    	<OPTION>cbco</OPTION>
									    </select>

									    <label>Carga Horária</label>
									    <input class="input-xlarge" type="text" placeholder="" name="cargaHoraria">

									    <label>Data Inicial</label>
									    <input class="input-xlarge" type="text" placeholder="" name="dtInicial">

									    <label>Data Final</label>
									    <input class="input-xlarge" type="text" placeholder="" name="dtFinal">

									    <label>Local</label>
										<input class="input-xlarge" type="text" placeholder="" name="local">

										<label>Endereço</label>
										<input class="input-xlarge" type="text" placeholder="" name="endereco">

										<label>Cidade</label>
										<input class="input-xlarge" type="text" placeholder="" name="cidade">

										<label>Professor</label>
										<input class="input-xlarge" type="text" placeholder="" name="local">

										<label>Materia</label>
										<input class="input-xlarge" type="text" placeholder="" name="materia">										

										<!-- ADICIONAR ALUNOS -->
									    <label>Aluno</label>
										 <button type="button" class="btn btn-primary" id="adicionaAluno">Adicionar Aluno</button>									    
										 <input type="button" id="adicionaAluno5" value="add">
										 


									    <span class="help-block"></span>

									    <button type="submit" class="btn btn-primary">Cadastrar</button>
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