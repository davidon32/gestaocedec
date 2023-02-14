<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
    $_SESSION['cesta'] = array();
?>
<style>

    table th, td{
        text-align: center;
    }

</style>

<div class="row">
<div class="col-md-12">

    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=liberacao" class="btn btn-primary">Liberação de Materiais</a>
    
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=cancelar" class="btn btn-primary">Cancelar Liberação</a>
    
    <!--<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=correcao" class="btn btn-primary">Correção Liberação</a>-->
    
    
</div>
</div>
<div class="col-md-12">
    <br>
    <p class="text-center"><legend>Liberações Pendentes</legend>
    <?php
        $liberacao = new Liberacao();
        
        $dados = $liberacao->listLiberacao($_COOKIE['seguranca']['id_deposito']);
        
        if(count($dados) > 0) {
            
            print "<table class=\"table table-bordered table-striped table-responsive\">";
            print "<tr>";
            print "<th>#</th>";
            print "<th>Codigo</th>";
            print "<th>Data</th>";
            print "<th>Deposito de Saída</th>";
            print "<th>Munic. Destino</th>";
            print "<th>Usuario Lib.</th>";
            print "<th>Ações</th>";
            print "</tr>";
            foreach ($dados as $key => $value) {
                print "<tr>";
                print "<td>".($key+1)."</td>";
                print "<td>".$value['id_liberacao']."</td>";
                print "<td>".DataMysql::dataVisual($value['dataLibera'])."</td>";
                print "<td>". Deposito::PegaNomeDeposito($value['depDestino'])."</td>";
                print "<td><a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=vmateriallib&id=".$value['id_liberacao']."\" title='Mostra Materiais Liberados'>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</a></td>";
                print "<td>".Usuario::getNomeId($value['id_usuario'])."</td>";
                print "<td><a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=cancelar&id=".$value['id_liberacao']."\" title='Cancelar Liberacao'><img src='core/imagem/cancela.png' width='25'></a>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=rec_pgto&id=".$value['id_liberacao']."&m=Q\" title='Recibo Pagamento em Branco'><img src='core/imagem/impressao.png' width='25'></a>
                </td>";
                print "</tr>";
            }
            print "</table>";
        }
        ?>
    
</div>


<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index">Voltar</a>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
