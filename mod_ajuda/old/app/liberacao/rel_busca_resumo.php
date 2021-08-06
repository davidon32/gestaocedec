<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

//var_dump($_SESSION);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
    <!-- TOPO /system/topo.php-->
        <?php include_once(PATH.'/system/topo.php'); ?>
        
        <div class="container">

            <!-- MENU -->
            <div class="row-fluid">
                <div class="span3">
                    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>    
                </div>
<div class="span6">
   <legend>Resumo de Liberações</legend>
      
<form action="index.php?modulo=ajuda&secao=relatorio&acao=rel_resumo_liberacao" method="POST">
    <table class="table">
        
        <tr>
            <td colspan='2' class='alert alert-info'>Obs: A pesquisa é limitada a período máximo anual, desde que seja o ano de inicio igual ao ano final do filtro.</td>
        </tr>
        <tr>
            <td>
                Data Inicial :
                <input type="text" name="txtDtInicio" id="txtDtInicio" data-mask="99/99/9999" />
            </td>
            <td>
                Data Final :
                <input type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999"/>
            </td>
        </tr>
        <tr>
            <td>Depósito:
                <select name="selDeposito" disabled="disabled">
                    <option value="0">Todos</option>
                </select>
            </td>
            
            <td>Material
                <select name="sel_material" id="sel_material" disabled="disabled">
                    <option value="1">Cesta Básica</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label class="ckeckbox"><input type="checkbox" name="ckRegiao" id="ckRegiao" value="1" disabled="disabled" > Por Regiões</label>
            </td>
            
        </tr>
        <tr>
            <td style='text-align: center;' colspan="2">
                <button class="btn btn-primary"type="submit" name="btnFiltro" id="btnFiltro" value="btnFiltro">Visualizar</button>
            </td>
        </tr>
    </table>

</form>
</div>
</div>
</body>
<script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    <script src="/js/funcaobase.js"></script>
</html>