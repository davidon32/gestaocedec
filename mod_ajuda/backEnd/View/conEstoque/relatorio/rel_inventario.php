<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<style type="text/css">

      
    .sem_quebra {
        white-space: nowrap !important;
    }
    
        
	@media print {
            .imprimir {
                display: none;
                
            }
           font-size: 9pt !important;
	}
        
        @media screen{
            
            table {
                
                width: 800px !important;
                
                
            }
            
        }
	
	*{
		font-family: Courier;
		font-size: 13px;
		color:#666666;
		vertical-align:text-top;
	}

	body {
		margin: auto;
	}

	table {
		border-collapse: collapse;
	}

	.cabecalho {
		background:#CCCCCC;
		text-align:center;	
	}

	.rodape {
		font-size: 10px;
		text-align: center;
	}

	#bg img { 
        height:100%; 
        opacity:.5; 
        z-index: -1;
        position: absolute;
        margin-left: 10%;
        width: 300px;
        height: 300px;         
	}
        
        
</style>
    
       
<br><br>
<div align="center" class="col-md-12">
    <a class="btn btn-success imprimir" href="<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "inventario")?>">Voltar</a>
</div>
    <table align="center" width="600">
   	<tr>
            <td>
		<div class="rTopoImagem1">
                    <img src="/mod_ajuda/imagem/brasaoMG_80x77.png" />
		</div>
		</td>
		<td class="text-center">
                    Estado de Minas Gerais<br />
		    Gabinete Militar do Governador<br />
		    Coordenadoria Estadual de Defesa Civil
		</td>
		<td>
                    <img src="/mod_ajuda/imagem/logodefesacivilpng80x77.png" />
                    
		</td>
        <tr>
            <td colspan="3">
                <p></p>
            </td>
        </tr>
        </tr>
    </table>
    <table align="center" width="700" class="table table-cell">
		<tr>
                    <th>OPÇÕES</th>
                    <th>CÓDIGO</th>
                    <th>NUM.NOTA</th>
                    <th>DESCRIÇÃO</th>
                    <th>UNIDADE</th>
                    <th>MARCA</th>
                    <th>ARMAZÉM</th>
                    <th>ALMOXARIFADO</th>
                    <th>ESTOQUE</th>
                    <th>CUSTO</th>
                    <th>TOTAL</th>
                </tr>  
                <?php

                if($_POST['rbSaldo'] == 2){
                    $saldo_zerado = true;
                }else {
                    $saldo_zerado = false;
                }
                
                 setlocale (LC_ALL, 'pt_BR');
                
                foreach ($dados as $key => $value) {
                    $impressao = (!$saldo_zerado) ? ($value['qtd']  > 0) : true; 
                    if($impressao) {
 
                        $total = $value['qtd']*$value['val_unit'];
                
                        print "<tr>";
                        print "<td class='sem_quebra'>
                                <!--<a href='' title='Gerar Pedido para este material'><img src='/core/imagem/envio_pedido.png' width='20'></a> |-->
                                <a href='#' name='lk_transferencia' 
                                    data-id_material='".$value['id_unidade']."'
                                    data-id_almoxarifado='".$value['id_almoxarifado']."' 
                                    data-id_tp_pedido='".$value['id_tp_pedido']."' 
                                    title='Transferencia de Materiais entre Depósitos !'><img src='/core/imagem/transferencia.png' width='20'></a>
                            </td>";
                        print "<td>".$value['id_unidade']."</td>";
                        print "<td>".$value['id_nota']."</td>";
                        print "<td class='sem_quebra'>".$value['nome']." - ".$value['descricao']."</td>";
                        print "<td>".$value['unid_med_nome']."</td>";
                        print "<td>".$value['marca_nome']."</td>";
                        print "<td class='sem_quebra'>".$value['armazem']."</td>";
                        print "<td>".$value['almoxarifado']."</td>";
                        print "<td>".$value['qtd']."</td>";
                        print "<td class='sem_quebra'>R$ ". FuncaoBase::real($value['val_unit'])."</td>";
                        print "<td class='sem_quebra'>R$ ".FuncaoBase::real($total)."</td>";
                    } 
                }
                ?>
		</table>


<?php include_once "template/page/rodapePage.php"; ?>
<script>

$(document).ready(function(){
    
    $('a[name="lk_transferencia"]').click(function(){
        
        /* ajax envia para form transferencia */
        
        var formData = new FormData();
	formData.append('id_material', $(this).data('id_material'));
        formData.append('id_almoxarifado', $(this).data('id_almoxarifado'));
        formData.append('id_tp_pedido', $(this).data('id_tp_pedido'));
        $.ajax({
		url : '/mod_ajuda/backEnd/View/conEstoque/transferencian/ajax.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success : function(response) {
                    
                },
		error : function(e) {
		}
            });
    });
      
});
</script>
					    