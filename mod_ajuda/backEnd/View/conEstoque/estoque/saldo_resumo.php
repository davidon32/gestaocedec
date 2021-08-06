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

	$ids = isset($_GET['id']) ? $_GET['id'] :"";

	if(!empty($ids)){
	
		$arrIds = explode(",", $ids);
		$stri = "";

			foreach ($arrIds as $key => $value) {
				if(end($arrIds) == $value){
					$stri .=  "\"".$value."\"";
				}else {
					$stri .=  "\"".$value."\" ,";
				}
			}	
		
	}

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
			<a class='btn btn-success' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=salindex'>Voltar</a>
			<?php FuncaoBase::Imprimir(); ?>
	    </div>
		
		<div class="col-md-12 text-center" style="overflow: auto;">
			<legend>Posicao Geral dos Depositos</legend>
			<label> Remover Saldo Zerado
				<input type="checkbox" id="ck_remover" name="ch_remover">
			</label>
			<table class="table table-bordered table-striped table-condensed" id="tblSaldo">
				<tbody>
			
				<?php #$saldo->saldoProduto(1, 10);?>

				<?php $saldo->VisualizarSaldoIds($ids);?>
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

<script type="text/javascript">

$(document).ready(function(){

		/* remover coluna zerada */
		$("#ck_remover").click(function(){
			if($("#ck_remover").is(':checked')){
				for(var i=0; i<classe.length; ++i) {
					ocultar_coluna("col_"+classe[i])
				}
			}
		})

		/* totalizador de saldo coluna tabela */

		var sum = 0;
		var valor = [];
		var totalItens = 0;
		var produto = [];
		var linha = "<tr><td>-</td>";

		var classe = [];

		$("table tr th").each(function(){
			if($(this).text() != "Deposito") {
				var prod = $(this).text();
				var val = prod.replace(" ", "_");
				produto.push(val);
			}
		});
			for(var i=0; i<produto.length; ++i) {
				$("."+produto[i]+"").each(function() {
					var value = $(this).text();
					if(!isNaN(value) && value.length != 0) {
						sum += parseInt(value);
					}
				});
				valor.push(sum);
				totalItens +=sum;
				sum = 0;
			}
			/** coluna com total */
			for(var j=0; j<produto.length; ++j) {
				linha += "<td class='"+produto+"' style='color:blue;'><b>"+ valor[j]+ "</b></td>";
				if(valor[j] == 0){
					classe.push(produto[j]);
				}
			}

			linha +="</tr>";
			linhaTotal = "<tr><td colspan='"+(produto.length+1)+"'><b>Total de Itens : "+totalItens+"</b></td></tr>";
			$("#tblSaldo").append(linha);
			$("#tblSaldo").append(linhaTotal);

			console.log(classe[0]);

})

/* remover coluna */
	function ocultar_coluna(coluna)	{
		$(document.getElementsByClassName('th')[coluna]).hide();
		var linhas = document.getElementsByTagName('tbody')[0].querySelectorAll('tr');
				
		for (var i = 0; i < linhas.length; i++){
			var colunas = linhas[i].querySelectorAll('td');
			$(colunas[coluna]).hide();
		}
	}

</script>
