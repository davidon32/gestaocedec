<?php
    include_once "include_ex.php";
    
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 text-center"><img src="http://placehold.it/970x150" /></div>
            
        </div>
        <div class="row-fluid">
            <div class="span12 text-center"><br><br>Acesso Restrito ao Sistema </div>
            <div class="span4"></div>
            <div class="span4 fdo_corpo"><br /><br />
                <form action="sc.servico.ex.php" method="POST" name="frm_acesso">
                    <label>Usuário</label>
                    <input type="text" name="txt_usuario" id="txt_usuario" /><br>
                    <label>Senha</label>
                    <input type="password" name="txt_senha" id="txt_senha" /><br>
                    <a href="#" title="Recuperação da Senha"><small>Esquecí a Senha</small></a><br>
                    <a href="secao.php?secao=usuario&acao=cadastro" title="Recuperação da Senha"><small>Criar Conta</small></a><br>
                    <input type="submit" class="btn btn-primary" name="btn_enviar" id="btn_enviar" />
                </form>
            </div>
            <div class="span4"></div>
        </div>
        <div class="row-fluid">
            <div class="span12 text-center"><small>Rodape</small></div>
        </div>
    </div>

</body>
</html>