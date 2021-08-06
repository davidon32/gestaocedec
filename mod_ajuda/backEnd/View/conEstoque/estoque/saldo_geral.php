<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<?php	
/* ****************************************************************************************
*   Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       :  Tela de consulta de Saldo Geral dos Dep�sitos
*
*******************************************************************************************/
		
	$saldo = new ControleSaldo();
	

?>

		<style type="text/css">

			@media print {
			    
			    *{
			        
			        margin: 0;
                    padding: 0;
			    }
			    
			    table tr th {
			        
			        font-size: 9px;
  
			    }
			    
			    table tr td {
                    
                    font-size: 9px; 
                    white-space: nowrap;
                    
                    
                }

				.imprimir{
					display: none;
				}
				
				img {
				    width: 50%;
				}


			}
				#img-ajuda{
					display:none;
				}
		</style>
	
	    <div class="col-md-12 text-center imprimir">
			<a class='btn btn-success' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index'>Voltar</a>
			<?php FuncaoBase::Imprimir(); ?>
	    </div>
		
		<div class="col-md-12 text-center" style="overflow: auto;">
			<legend>Posicao Geral dos Depositos</legend>
			<?php $saldo->VisualizarSaldoGeral();?>
		</div>
					

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
