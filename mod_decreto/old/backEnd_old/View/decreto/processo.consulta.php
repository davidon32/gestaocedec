<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_login = new Login();

$_login -> logado();

$_municipio = new Municipio();

$_processo = new Decretacao();

$_id_processo = isset($_GET['id']) ? $_GET['id'] : "";

$_dados = $_processo -> ConsultaProcesso($_id_processo);

// $_total_d_humano = $_dados['morto']+
// $_dados['ferido']+
// $_dados['enfermo']+
// $_dados['desabrigado']+
// $_dados['desalojado']+
// $_dados['outro']+
// $_dados['afetado'];

//var_dump($_dados);

/* ****************************************************************************************
 *  	Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
 *	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
 *
 *	Autor        :  Demetrio Silva Passos
 *	Fun��o   : Tela de Executar Libera��o de Materiais
 *
 *******************************************************************************************/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

<style>

    table {
    
    width: 160px;
    font-size: 12px;

    }
    
   
    
    td.tit {
    
        font-weight: bold;
        text-align: center;
        background-color: #D4D4D4;

    }
    
    td.campo {
        
        text-align: center;
    }
    
    td.total {
        
        color: red;
        font-weight: bold;
        text-align: center;
        
    }
    
    .destaque {
        
        color: red;
        
        
    }

</style>

</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
    <div class="container">

        <!-- MENU -->
        <div class="row-fluid fdo_corpo">
            <div class="span2">
                 <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                
            </div>
                <div class="span10 fdo_corpo">

				<br>
			
                <table align="center" class="table table-bordered text-center">
                    <tr>
				        <td colspan="8" style="text-align: center"><legend>Dados do Processo </legend></td>
				    </tr>
				    <tr>
                        <td colspan="6" style="text-align: center"></td>
                        <td colspan="2" class="campo">Dias Restantes<br>
                            <legend class="destaque"><?php print $_processo->RestanteDecreto($_id_processo);?></legend>
                        </td>
                    </tr>
				    <tr>
				        <td colspan="3" class="campo">
				            <legend class="destaque"><?php print $_municipio->PegaNomeMunicipio($_dados['id_municipio']);?></legend>
				        </td>
				         <td colspan="2" class="campo">
                            <legend class="destaque"><?php print "Processo Nº" .$_dados['num_processo'];?></legend>
                        </td>
                         <td colspan="3" class="campo">
                            <legend class="destaque"><?php print "R$ ".$_dados['vl_total'];?></legend>
                        </td>
				    </tr>
                    <tr>
                        <td class="tit">Ano</td>                
                        <td class="tit">Data Entrada</td>         
                        <td class="tit">Número Processo</td>       
                        <td class="tit">Municipio</td>       
                        <td class="tit">Decreto Munic</td>        
                        <td class="tit">Data Dec Mun</td>         
                        <td class="tit">Vigência (Dias)</td>       
                        <td class="tit">Desastre</td>
                     </tr>
                     <tr>
                        <td class="campo"><?php print $_dados['ano']; ?></td>
                        <td class="campo"><?php print DataMysql::dataVisual($_dados['dt_entrada']); ?></td>
                        <td class="campo"><?php print $_dados['num_processo']; ?></td>
                        <td class="campo"><?php print $_municipio->PegaNomeMunicipio($_dados['id_municipio']); ?></td>
                        <td class="campo"><?php print $_dados['num_dec_mun']; ?></td>
                        <td class="campo"><?php print DataMysql::dataVisual($_dados['dt_dec_mun']); ?></td>
                        <td class="campo"><?php print $_dados['dec_vigencia']; ?></td>
                        <td class="campo"><?php print $_dados['desastre']; ?></td>
                      </tr>
                      <tr>
                      
                        <td class="tit">Data Venc.</td>
                        <td class="tit">Status Processo</td>
                        <td class="tit">Analista</td>
                        <td class="tit">Decreto Homolog</td>
                        <td class="tit">Dt Publicação Decr.</td>
                        <td class="tit">Num/Data Portaria</td>
                        <td class="tit">Num/Data D.O.U.</td>
                        <td class="tit">População</td> 
                      </tr>
                      <tr>
                        <td class="campo"><?php print DataMysql::dataVisual($_dados['dt_vencimento']); ?></td>
                        <td class="campo"><?php print ($_dados['status'] == 1)    ? "Homologado<br >"  : "";
                                  ?></td>
                        <td class="campo"><?php print $_dados['id_funcionario']; ?></td>
                        <td class="campo"><?php print $_dados['homo_num_dec']; ?></td>
                        <td class="campo"><?php print DataMysql::dataVisual($_dados['homo_dt_pub_dec']); ?></td>
                        <td class="campo"><?php print $_dados['homo_num_dt_port_dec_rec']; ?></td>
                        <td class="campo"><?php print $_dados['homo_num_dt_dou']; ?></td>
                        <td class="campo"><?php print $_dados['populacao']; ?></td>
                      </tr>
                      <tr>
                          <td class="tit">Pib <br>R$</td>
                          <td class="tit">Oorcamento <br>R$</td>
                          <td class="tit">Arrecadação <br>R$</td>
                          <td class="tit">Receita Anual <br>R$</td>
                          <td class="tit">Receita Mensal R$</td>
                          <td class="tit">Telefone</td>     
                          <td class="tit">Email</td> 
                          <td class="tit total">Valor Total <br>R$</td> 
                      </tr>
                      <tr>
                          <td class="campo"><?php print $_dados['pib']; ?></td>
                          <td class="campo"><?php print $_dados['orcamento']; ?></td>
                          <td class="campo"><?php print $_dados['arrecadacao']; ?></td>
                          <td class="campo"><?php print $_dados['rec_anual']; ?></td>
                          <td class="campo"><?php print $_dados['rec_mensal']; ?></td>
                          <td class="campo"><?php print $_dados['telefone']; ?></td>
                          <td class="campo"><?php print $_dados['email']; ?></td>
                          <td class="total"><?php print $_dados['vl_total']; ?></td>
                      </tr>
                        <tr>
                            <td colspan="8" style="text-align: center"><legend>Dano Humano</legend></td>
                        </tr>          
                            <td class="tit">Morto</td>                 
                            <td class="tit">Ferido</td>                
                            <td class="tit">Enfermo</td>               
                            <td class="tit">Desabrigado</td>           
                            <td class="tit">Desalojado</td>            
                            <td class="tit">Outro</td>                 
                            <td class="tit">Afetado</td>
                            <td class="tit">Total</td>               
                        </tr>
                        <tr>
                            <td class="campo"> <?php print $_dados['morto']; ?></td>
                            <td class="campo"> <?php print $_dados['ferido']; ?></td>
                            <td class="campo"> <?php print $_dados['enfermo']; ?></td>
                            <td class="campo"> <?php print $_dados['desabrigado']; ?></td>
                            <td class="campo"> <?php print $_dados['desalojado']; ?></td>
                            <td class="campo"> <?php print $_dados['outro']; ?></td>
                            <td class="campo"> <?php print $_dados['afetado']; ?></td>
                            <td class="campo"> <?php print $_total_d_humano=0;?></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: center"><legend>Dano Material</legend></td>
                        </tr>
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Saúde Pública Destruídas</td>
                            <td class="tit"></td>
                            <td class="tit">Saúde Pública Danificada</td>
                            <td class="tit"></td>
                            <td class="tit">Valor Dano Saúde R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_saude_destr']; ?></td>
                            <td class="campo"></td>
                            <td class="campo"> <?php print $_dados['mat_pub_saude_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_pub_saude']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Ensino Público Destruída</td>
                            <td class="tit"></td>
                            <td class="tit">Ensino Público Danificada</td>
                            <td class="tit"></td>
                            <td class="tit">Valor Dano Ensino R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_ensino_destr']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_ensino_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_pub_ensino']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Outros Público Destruído</td>
                            <td class="tit"></td>   
                            <td class="tit">Outros Público Dafinicado</td>
                            <td class="tit"></td>   
                            <td class="tit">Valor Danos Outros R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>     
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_outro_destr']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_outro_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_pub_outro']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Comunitário Público Destruído</td>
                            <td class="tit"></td>     
                            <td class="tit">Comunitário Público Danificado</td>
                            <td class="tit"></td>     
                            <td class="tit">Valor Comunitário Público R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>       
                        
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_com_destr']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_pub_com_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_pub_com']; ?></td>
                            <td></td>
                            <td></td>
                        
                        </tr>
                            <td class="tit"></td>
                            <td class="tit">Unidade Habit. Destruída</td>
                            <td class="tit"></td>    
                            <td class="tit">Unidade Habit. Danificada</td>
                            <td class="tit"></td>  
                            <td class="tit">Valor Dano Habit. R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>      
                        
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_unid_hab_destr']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_unid_hab_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_unid_hab']; ?></td>
                            <td></td>
                            <td></td>
                        
                        </tr>
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Obra Infr. Pública Destruída</td>
                            <td class="tit"></td>
                            <td class="tit">Obra Infr. Pública Danificada</td>
                            <td class="tit"></td>
                            <td class="tit">Valor Dano Obra Infra. R$</td>
                            <td class="tit"></td>
                            <td class="tit"></td>  
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['mat_obr_infr_pub_destr']; ?></td>
                            <td></td>
                            <td > <?php print $_dados['mat_obr_infr_pub_danif']; ?></td>
                            <td></td>
                            <td class="campo"> <?php print $_dados['val_mat_obr_infr_pub']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td colspan="8" style="text-align: center"><legend>Dano Ambiental</legend></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tit">Água<br> % Pop. Atingida</td>
                            <td colspan="2" class="tit">Solo<br> % Pop. Atingida</td>
                            <td colspan="2" class="tit">Ar<br> % Pop. Atingida</td>
                            <td colspan="2" class="tit">Incêndio APA - APP<br> % Pop. Atingida</td>
                        
                        </tr>
                        <tr>
                            <td colspan="2" class="campo"><?php print $_dados['agua_pop_atingida']; ?></td>
                            <td colspan="2" class="campo"><?php print $_dados['solo_pop_atingida']; ?></td>
                            <td colspan="2" class="campo"><?php print $_dados['ar_pop_atingida']; ?></td>
                            <td colspan="2" class="campo"><?php print $_dados['incendio_pop_atingida']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: center"><legend>Prejuízo Econômico Público</legend></td>
                        </tr>
                        
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Saúde <br>R$</td>  
                            <td class="tit">Água <br>R$</td>    
                            <td class="tit">Esgoto <br>R$</td>  
                            <td class="tit">Lixo <br>R$</td> 
                            <td class="tit">Praga <br>R$</td> 
                            <td class="tit">Energia <br>R$</td>
                            <td class="tit"></td> 
                        </tr>
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['eco_pub_saude']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_agua']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_esgoto']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_lixo']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_praga']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_energia']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="tit"></td>                       
                            <td class="tit">Telecomunicação <br>R$</td>  
                            <td class="tit">Transporte <br>R$</td>
                            <td class="tit">Combustível <br>R$</td>   
                            <td class="tit">Segurança <br>R$</td>    
                            <td class="tit">Ensino <br>R$</td>  
                            <td class="tit total">Total Prej. Eco <br>R$</td>
                            <td class="tit"></td>     
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['eco_pub_telec']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_transp']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_comb']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_segur']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_pub_ensino']; ?></td>
                            <td class="total"> <?php print $_dados['val_eco_pub']; ?></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td colspan="8" style="text-align: center"><legend>Prejuízo Econômico Privado</legend></td>
                        </tr>
                        
                        <tr>
                            <td class="tit"></td>
                            <td class="tit">Agricultura</td> 
                            <td class="tit">Pecuaria</td>     
                            <td class="tit">Indústria</td>
                            <td class="tit">Serviço</td>   
                            <td class="tit total">Total Danos Priv</td>
                            <td class="tit"></td>
                            <td class="tit"></td>       
                        </tr>

                        <tr>
                            <td></td>
                            <td class="campo"> <?php print $_dados['eco_priv_agricul']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_priv_pecuaria']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_priv_industria']; ?></td>
                            <td class="campo"> <?php print $_dados['eco_priv_servico']; ?></td>
                            <td class="total"> <?php print $_dados['val_eco_priv']; ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                                          
				</table>
				
			</div>
			<script src="/js/jquery.js"></script>
			<script src="/js/bootstrap.js"></script>
			<script src="/js/jasny-bootstrap.js"></script>

</body>
</html>


















