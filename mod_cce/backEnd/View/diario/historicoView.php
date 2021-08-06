<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>


<?php

//$_conexao = new ConexaoMysql();

$_diario = new Diario();

$_id_funcionario = isset($_GET['idf']) ? $_GET['idf'] : "";

$_plantao = isset($_GET['p']) ? $_GET['p'] : "";

$_id_diario = isset($_GET['id']) ? $_GET['id'] : "";

$_usuario = new Usuario();

?>
<style>
    table {
    
        font-size: 12px;
    }

    #img-ajuda {
    display:none;
  }
    
</style>
</head>

<br>
<div class="col-md-12">
            <?php $_lista = $_diario -> ListaHistorico($_id_diario);
                      
            if(count($_lista) > 0) {
            
                print "<table class=\"table table-bordered table-striped\">
                        <tr>
                            <td colspan=\"6\" style=\"text-align:center\">Diário de ".DataMysql::dataVisual($_lista[0]['dt_diario'])." - Plantão ".$_lista[0]['periodo']."</td>
                        </tr>
                        <tr>
                            <td width=\"60px\">nº</td>
                            <td>Hora</td>
                            <td>Histórico</td>
                            <td>Plantonista</td>
                            <td>Alterar</td>
                            <td>Complemento Inf.</td>
                        </tr>";
    
                for ($i = 0; $i < count($_lista); $i++) {
                    
                    if($_lista[$i]['id_funcionario'] == $pageSession['session']['seguranca']['idUser']) {
                        
                        
                        /* link para alterar o historico*/
                        $_linkAltera = "<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=cce&controller=cce&action=alterarHist&idh=".$_lista[$i]['id_historico']."\" title=\"Alterar\"><i class='fa fa-edit'></i></a>";
                        
                        
                    }else {
                        
                        $_linkAltera = "<i class='fa fa-edit'></i>";
                        
                    }
                    
                    $_dt_altera = ($_lista[$i]['dt_altera'] == null)? "" : "<br>".DataMysql::dataVisual($_lista[$i]['dt_altera']);
                        
                    
                         /* link para inclusao de sub historico se nao existir comeca do numero 1 */
                        if($_lista[$i]['num_sub'] == null){

                            
                                             
                            print "<tr>
                                      <td>" . $_lista[$i]['num'] . "</td>
                                      <td>".$_lista[$i]['hora'] . $_dt_altera."</td>
                                      <td style=\"text-align:justify\">" . $_lista[$i]['historico'] . "</td>
                                      <td>" . $_usuario->getNomeId($_lista[$i]['id_funcionario']) . "</td>
                                      <td>".$_linkAltera."</td>
                                      <td><a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=cce&controller=cce&action=lancDiario&idh=".$_lista[$i]['id_historico']."&n=".$_lista[$i]['num']."&idd=".$_lista[$i]['id_diario']."\" title=\"Complementar Informação\"><i class=\"fa fa-plus\"></i></a></td>
                                   </tr>";
                                  
                           
                        } else {
                            
                            /* link para inclusao de sub historico com incremento de sub_numero */
                            print "<tr>
                                      <td style=\"text-align:right\">" . $_lista[$i]['num'] .".". $_lista[$i]['num_sub']. "</td>
                                      <td>".$_lista[$i]['hora'].$_dt_altera."</td>
                                      <td style=\"text-align:justify\">" . $_lista[$i]['historico'] . "</td>
                                      <td>" . $_usuario->getNomeId($_lista[$i]['id_funcionario']) . "</td>
                                      <td>".$_linkAltera."</td>
                                      <td><a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=cce&controller=cce&action=lancDiario&idh=".$_lista[$i]['id_historico']."&n=".$_lista[$i]['num']."&idd=".$_lista[$i]['id_diario']."\" title=\"Complementar Informação\"><i class=\"fa fa-plus\"></i></a></td>
                                   </tr>";
                                   
                            
                            
                        }
    
                    }
            
            print "</table>";
            }else {
                print "<script>";
                                
                print "alert('Até o presente Momento não consta lançamento para este Plantão !');";
                                    
                print "window.close();";
                
                print "</script>";
            }

            
        ?>
       
        </div>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>