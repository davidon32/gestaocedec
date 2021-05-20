<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php
//$_conexao = new ConexaoMysql();

$_login = new Login();

//$_login -> logado();

$_usuario = new Usuario();

$_diario = new Diario();
?>
<div class="col-md-12 text-center">
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=index"class="btn btn-success">Voltar</a>
</div>


					<form action="index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=relDiario" method="POST" name="cadastra_evento">
						
					   <legend>Relatório Diário </legend>
					   
					   <table  class="table">
					       <tr>
					           <td width="50%">
					               <label>Data Inicial</label>
					               <input type="text" class="span4 form-control" name="txt_dtInicial" id="txt_dtInicial" data-mask="99/99/9999" value="<?php print HOJE; ?>" />
					               <label>Data Final</label>
					               <input type="text" class="span4 form-control" name="txt_dtFinal" id="txt_dtFinal" data-mask="99/99/9999" />
                                   <br>  
                                </td>
                                <td>
                                    <label>Busca por Palavra-chave<label><br>
                                    <input class="form-control" type="text" name="txtPalavra" id="txtPalavra" />
                                </td>
                           </tr>
                           <tr>
                               <td colspan="2" style="text-align: center">
                                   <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Visualizar">
                               </td>
                           </tr>
                       </table>
					  
					   

				    </form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

        $("#txt_dtInicial").datepicker({ 
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                nextText: 'Proximo',
                prevText: 'Anterior'
        });

        $("#txt_dtFinal").datepicker({ 
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                nextText: 'Proximo',
                prevText: 'Anterior'
        });
    
</script>