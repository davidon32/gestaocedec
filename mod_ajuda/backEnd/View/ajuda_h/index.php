<?php include_once 'core/include.php';?>
<?php include_once 'core/Model/indexModel.php';?>
<?php include_once 'mod_compdec/Model/Model.php';?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

    $id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] :"";
    
    $dados = H_pedido_pedidajuda_hModel::lista();
    $pedido_h = new H_pedido_pedidajuda_hModel();
    
    $id_usuario = $_COOKIE['seguranca']['idUser']
	
?>	
<div class="col-md-12 text-center">
<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&modulo=ajuda&controller=index&action=index">Voltar</a>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-6">
<!--<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro")?>">Novo Pedido</a>-->
<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index")?>">Pesquisa</a>
</div>
<div class="col-md-6">
    <p class="text-right"> <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "config_ajuda")?>" title="Cadastro Analistas">Configurações</a></p>
    </div>
</div>
    
    Total Registros : <span id='total_registro'></span>
<table class="table table-bordered">
        <tr>
            <th colspan="8">Pedidos Recentes</th>
        </tr>
     <tbody>
        <tr>
            <td>Nr</td>
            <td>Municipio</td>
            <td>Data</td>
            <td>Tipo</td>
            <td>Status</td>
            <td>Fase do Processo</td>
            <td>Data Envio Analise</td>
            <td>Ações</td>
            
        </tr>
        <?php
        
        $dadosConfig = Config::getConfig();
        
        $permissao[] = array('analista_drd'=>0, 'analista_dlog'=>0, 'analista_coord'=>0);
        
        
        
        if($dadosConfig['aju_h_alta_perf'] == 1){
            
            $permissao[0]['analista_drd'] = '1';
            $permissao[0]['analista_dlog'] = '1';
            $permissao[0]['analista_coord'] = '1';
                                
        }else {

            $permissao = $pedido_h->buscaAnalista($id_usuario);
                
        }
        
     
        $listaPedido = $pedido_h->buscaPedidoH();
        $total_reg = 0;

        foreach ($listaPedido as $key => $pedid) {
            # get permissao
            
            
            if(($pedid['tramit']== 'analise_drd' && $permissao[0]['analista_drd'] == '1') ||
            ($pedid['tramit']== 'analise_dlog' && $permissao[0]['analista_dlog'] == '1') || 
            ($pedid['tramit']== 'analise_coord' && $permissao[0]['analista_coord'] == '1')) {
            
                $total_reg++;
                $cor = $pedido_h->getCorStatus($pedid['status']);
                print "<tr style='background-color:".$cor."'>
                <td>".$pedid['numero']."-".substr($pedid['data_entrada_sistema'], 0, 4)."</td>
                <td>".Municipio::PegaNomeMunicipio($pedid['id_municipio'])."</td>
                <td>".$pedid['data_entrada_sistema']."</td>
                <td>". Decreto::getNomeCobrade($pedid['id_cobrade'])."</td>
                <td>".$pedido_h->enumStatus($pedid['status'])."</td>
                <td>".$pedido_h->enumFase($pedid['tramit'])."</td>
                <td>".$pedid['data_hora_envio']."</td>
                <td>";
                print "<a href='".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id'=> $pedid['id']))."' title='Editar Pedido'><img src='/core/imagem/editar.png'></a> |";
                print "<a href='".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "impressao", array('id'=> $pedid['id']))."' title='Visualiação e Impressa do Pedido'><img src='/core/imagem/impressao.png'></a> |";
                
                #prestação de contas
                if($pedid['status'] == 5){
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'pedido_itens', 'pcont')."' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a>";
                }
                
                # analise DRD
                if($permissao[0]['analista_drd'] == 1) {
                    
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar'=>'idx_recente', 'an'=>'analise_drd'))."' title='Analise DRD'><img width='25' src='/core/imagem/cedec.png'></a>";
                }
                
                # analise_dlog
                if($permissao[0]['analista_dlog'] == 1) {
                    
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'analise_dlog')."' title='Analise DLOG'><img width='25' src='/core/imagem/dlog.png'></a>";
                }
                
                # analise_coord
                if($permissao[0]['analista_coord'] == 1) {
                    
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'analise_coord')."' title='Analise Coord. Adjuto'><img width='25' src='/core/imagem/boss.png'></a>";
                }
                
                print "</td>";
                print "</tr>";
            }
        }
        ?>
        
    </tbody>
</table>

</div>

 <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

/* Criar novo plano de contingencia */
(function($) {

    $("#total_registro").text(<?=$total_reg;?>);
	

})(jQuery);

</script>
</body>
</html>
	  	
	