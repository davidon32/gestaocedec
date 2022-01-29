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

$dadosOrigem = Material::ListFonte(true);
?>
<style>	
	#frm_Entrada_mat .error {
    	color: red;
	}
</style>

	<legend> Entrada de Materiais no Estoque</legend>
	<div class="row">
		<div class="col-md-12 text-center">
			<br>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>
		</div>
	</div>
			<br>		
			
		<form id="frm_Entrada_mat" action="" method="">
			<div class="row">
				<div class="col-md-4">
						<label>Origem</label>
							<div class="input-group">
                                                            <input type="text" class="form-control" name='txtOrigem' id='txtOrigem'>
                                                            <input type="hidden" name='id_origem' id='id_origem'>
                                                            <span class="input-group-btn">
                                                              <button class="btn btn-default" id="add_fonte" type="button">Ad.Fonte</button>
                                                            </span>
                                                        </div><!-- /input-group -->
					</div>
				<div class="col-md-4">
					<label>Nome Material</label>
					<?php Produto::pegaProdutoEntradaMat();?>
				</div>
				<div class="col-md-4">
					<label>Data Entrada</label>
                                        <input class="form-control" name="txtDtEntrada" id="txtDtEntrada" type="text" data-mask="99/99/9999" value="<?php echo date('d/m/Y'); ?>" maxlength="10" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Validade ( Opcional )</label>
                                        <input class="form-control" name="txtValidade" type="text" id="txtValidade" data-mask="99/99/9999" maxlength="10"/>
				</div>
				<div class="col-md-4">
					<label>Quantidade</label>
                                        <input type="text" name="txtQtd" id="txtQtd" class="form-control" required maxlength="4"/>
				</div>
				<div class="col-md-4">		
					<label>Dep&oacute;sito Avan&ccedil;ado:</label>
					<?php Deposito::pegaDeposito();?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label>Observa&ccedil;&otilde;es:</label>
                                        <textarea class="form-control" name="txObs" id="txObs" cols="30" rows="4" maxlength="255"></textarea>
				</div>
				<div class="col-md-6">
				
					<label>Upload Nota Fiscal</label>
					<input type="file" name="fl_nota" id="fl_nota">
				</div>
				<div class="col-md-12 text-center">
					<br>
                                        <input type="hidden" name="complnota" id="complnota" value="0"/>
					<input type="submit" class="btn btn-primary"  name="btnCadMaterial" id="btnCadMaterial" value="Cadastrar"/>
				</div>
			</div>
		</form>
	</div>
	<br>
	<div class="row">

		<div class="col-md-1">
		</div>

		<div class="col-md-10">

			<table class="table table-bordered">
				<tr><th class="text-center">Cod</th>
				<th class="text-center">Data Entrada</th>
				<th class="text-center">Nome</th>
				<th class="text-center">Origem de Entrada</th>
				<th class="text-center">Deposito Destino</th>
				<th class="text-center">Obs</th>
				<th class="text-center">Qtd</th>
				<th class="text-center">Validade</th>
				<th class="text-center">Nota F</th>
				<th class="text-center">Opções</th>
			
			</tr>
				<?php

					$material = Material::listaEntradaMaterial(50);
                                        
                                        
                                        

					foreach ($material as $key => $value) {

                                                $nome_deposito = Deposito::PegaIdDeposito($value['depDestino']);
                                                
                                                $cancelado = ($value['cancelado'] == 1) ? "style='color:red' title='Entrada de Materiais Cancelada ! Este material foi removido do seu respectivo saldo !'" : "";
                                                
						print "<tr><td ".$cancelado.">".$value['id_produto']."</td>
								<td ".$cancelado.">". DataMysql::dataVisual($value['dtEntradaSaida'])."</td>
								<td ".$cancelado.">".$value['codProd']."-".$value['nome']."- ".$value['descricao']."</td>
								<td ".$cancelado.">".$value['origem']."</td>
								<td ".$cancelado.">".$value['depDestino']."</td>
								<td ".$cancelado.">".$value['obs']."</td>
								<td ".$cancelado.">".$value['quantidade']."</td>
								<td ".$cancelado.">".(empty($value['validade']) ? "n/a" : $value['validade'] )."</td>
                                                                <td ".$cancelado.">-</td>
                                                                <td ".$cancelado.">";
                                                                    //$countSaida = (int)Liberacao::CountLibera($value['id_produto'])+(int)Liberacao::CountTransferencia($value['id_produto']);
                                                                    
                                                                    if($value['cancelado'] == 0){
                                                                        //print "<a href='".FuncaoBase::geraLink("ajuda", "conestoque", "edEntMat", array('id' => $value['id_produto']))."'><img src=core/imagem/editar.png></a>";
                                                                        print "<a href='' name='lk_del_entrada' data-id_entrada='".$value['id_produto']."' data-id_produto='".$value['codProd']."' data-id_deposito='". $nome_deposito."' data-qtd='".$value['quantidade']."'><img src=core/imagem/delete.png></a>";
                                                                    }else {
                                                                        print "-";
                                                                    }
                                                                print "</td>
								</tr>";
					}
				?>
					</table>
		</div>
		<div class="col-md-1">
		</div>	
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
    
    $("a[name='lk_del_entrada']").click(function(e){
        
        var result = confirm("Confirmar o Cancelamento desta Entrada de Materiais !");
        
        e.preventDefault();
        
        if(result) {
            var form_data = new FormData();
            var id_entrada = $(this).data('id_entrada');
            var id_deposito = $(this).data('id_deposito');
            var id_produto = $(this).data('id_produto');
            var quantidade = $(this).data('qtd');


            form_data.append("opcao",       'del_entrada');
            form_data.append("id_entrada",   id_entrada);
            form_data.append("id_produto",   id_produto);
            form_data.append("id_deposito",  id_deposito);
            form_data.append("quantidade",   quantidade);

                $.ajax({
                    type: 'POST',
                    url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php?v=<?=md5(VERSAO)?>',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(response) {
                        if(response == 'sucesso'){
                            alert("Entrada removida com Sucesso !");
                            //console.log(response);
                            location.reload();
                        }else if(response == 'semsaldo') {
                            alert('Não foi possivel remover essa entrada pois não existe saldo para abatimento de materiais, \n gentileza cancelar alguma liberação para que o saldo seja suficiente !');
                        }
                    },
                    error: function(e){
                        console.log(JSON.stringify(form_data));
                        console.log(JSON.stringify(response));
                        alert("Ocorreu um Erro !");
                    }
                });
        }
                        
    });
    
    $("#id_produto").change(function(){
        
        Swal.fire({
            title: 'Operação necessária !',
            width: 600,
            allowOutsideClick: false,
            html: "Este material está dividido em mais de uma nota  \nou foi recebido fracionado ? \n\
                                      <br>\
                                      Ao confirmar esta opção, este material estara disponível para lancamento no mesmo código.<br>\
                                      <br>Certifique-se que:<br>\
                                      <br> O Material que será posteriormente Entrado no estoque é o mesmo que já está cadastrado no SDC.<br>\
                                      <br> Ou o material não foi entregue na sua totalidade. <br>\
                                      <br> Ou o material foi fracionado em mais de uma nota cujo Doador/Fornecedor são a mesma Pessoa/Entidade ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
          }).then((result) => {
            if (result.isConfirmed) {
                
                $("#complnota").val(1);
              /*Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )*/
            }else{
                $("#complnota").val(0);
            }
          })
});
    
    $("#id_origem").val("");
 
    $("#txtDtEntrada").datepicker({ 
        dateFormat: 'dd/mm/yy',
        maxDate: 5,
        minDate: -10,
    }).attr('readonly', 'readonly');
    $("#txtValidade").datepicker({ dateFormat: 'dd/mm/yy' });

	$("#frm_Entrada_mat").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
				txtOrigem:{ required: true, minlength: 3}, 		
				txtQtd:{ required: true, number: true, minlength: 1 }, 	
				id_produto:{ required: true, minlength: 1}, 	
				id_deposito:{ required: true, minlength: 1}, 	

			},
			messages: {
				txtQtd: { required: 'O campo Quantidade não pode ficar em Branco !', number: 'O valor precisa ser numerico', minlength: 'tamanho errado'},
				txtOrigem: { required: 'O campo Origem não pode ficar em Branco !'},
				id_produto: { required: 'O campo Material não pode ficar em Branco !'},
				id_deposito: { required: 'O campo Deposito não pode ficar em Branco !'}	,
			},
			
		submitHandler: function(form) { 

			var form_data = new FormData();

			var file_data = $("#fl_nota").prop("files")[0];
                        
                        var input_origem_ctr = $('#id_origem').val();
                        var input_form = $('#txtOrigem').val();
                        
                        if(input_origem_ctr != input_form){
                            alert("Gentileza escolher uma origem que conste na lista !");
                        }else {

                                    form_data.append("fl_nota",        file_data);
                                    form_data.append("opcao",       "cad_material");
                                    form_data.append("id_produto",  $("#id_produto").val())
                                    form_data.append("txtDtEntrada",$("#txtDtEntrada").val())
                                    form_data.append("txtOrigem",   $("#txtOrigem").val())
                                    form_data.append("txtValidade", $("#txtValidade").val())
                                    form_data.append("txtQtd",      $("#txtQtd").val())
                                    form_data.append("id_deposito", $("#id_deposito").val())
                                    form_data.append("txObs",       $("#txObs").val())
                                    form_data.append("complnota",   $("#complnota").val())

                            $.ajax({
                                    type: 'POST',
                                    url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php?v=<?=md5(VERSAO)?>',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,
                                    success: function(response) {
                                            if(response == 'sucesso'){
                                            alert("Cadastro realizado com Sucesso !");
                                            //console.log(response);
                                            $("#id_origem").val("");
                                            location.reload();
                                            }
                                    },
                                    error: function(e){
                                            console.log(JSON.stringify(form_data));
                                            console.log(JSON.stringify(response));
                                            alert("Ocorreu um Erro !");
                                    }
                            });
                        }

		}
	});


	$("#add_fonte").click(function(){
            var result = confirm("Deseja Cadastrar uma Fonte de Entrada de Materiais");
            if(result){
                window.location.href = "?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=origem&cad=true";
            }
	});

	$("#fl_nota").change(function(e){
		var fileName = e.target.files[0].name;
                var size = e.target.files[0].size;
                    
        
                /* verificar acendo no nome
                fileName.search() */


                /* verifica espaços no nome do arquivo */
		if ( fileName.length != fileName.replace(" ", "").length ) {
                    $("#btnCadMaterial").attr("disabled", "true");
                    alert("O Nome do arquivo não pode conter espacos !");
		/* verifica o tamanho do arquivo */
                }else if( size > 2097152 ) {
                    $("#btnCadMaterial").attr("disabled", "true");
                    alert("O Arquivo está com o seu tamanho acima do permitido ! \n Tamanho máximo 2mb ");
		}else {
                    $("#btnCadMaterial").removeAttr("disabled");
                
                }
                
	});
        
        
        var itemOrigem = {
            data:
                <?php print json_encode($dadosOrigem); ?>, // array com os dados
                getValue: "nome", /* alterar com nome do item BD */

                list: {
                    match: {
                    enabled: true,
                    },
                onSelectItemEvent: function () {
                    var nome = $("#txtOrigem").getSelectedItemData().nome;
                    $("#id_origem").val(nome);
                },
            }
        };
        /*********** autocomplete origem ***********/
        $("#txtOrigem").easyAutocomplete(itemOrigem);
        

});	
</script>