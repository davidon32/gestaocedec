<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<?php

    $comunidade = new Comunidade();

    $id_comunidade = (int) isset($_GET['id']) ? $_GET['id'] : 0;
    $id_rota = (int) isset($_GET['r']) ? $_GET['r'] : 0;
    
	$id_municipio = $_COOKIE['seguranca']['id_municipio'];
	   

?>
   <br>
    				<h4>Solicitação de inclusão de Comunidade </h4>
    				<br>
    				<div class="col-md-12">
						<form action="#" method="post" name="frmPreCadCom">
							<div class="input_fields_wrap">
                                                            <input type="text" name="listCom[]" class="form-control col-md-10">
							    	<a class="add_field_button btn btn-primary">Adicionar &nbsp;&nbsp; <img alt="Adicionar Comunidade" src="core/imagem/add.png" width="25px;"></a>
							</div>
							<br>
                                                        <p style="text-align: right">
                                                            <input class="btn btn-primary btn-lg" type="submit" value="Gravar" name="btnEnviar">
                                                        </p>
						</form>
						
						</div>

	</div>

				
				<?php
				
					$btnEnviar = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
				if($btnEnviar == 'Gravar'){
					
					$post = $_POST;
					foreach ($post['listCom'] as $key=>$value) {
                                            if($key > 0){
						$dados = array('txtComunidade'=>$value,
									   'id_municipio'=>$id_municipio,
								       'tipo_cad'=>"pre",
								       'origem_cad'=>"pre");
						
						$comunidade->cadComunidade($dados);
                                            }

					}
					
				}
				
				?>
				
				<table class="table table-bordered">
					<tr>
						<td style="text-align:center;" colspan="2"><b>Histórico de Comunidades enviadas para Cadastro</b></td>
					</tr>
					<tr>
						<th>Comunidade</th>
						<th>Situacao</th>
					</tr>
					
					<?php 
					
						$list = $comunidade->listaComunidadePreCadastro($id_municipio);
						
						foreach ($list as $value) {
							print "<tr>";
    						print "<td>".$value['comunidade']."</td>";
    						print "<td>".(($value['tipo_cad'] =='pre') ? 'em Análise' : 'Comunidade Disponivel p/ PMDA')."</td>";
    						print "</tr>";
						}
					
					?>
				</table>
		</div>
	
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>
	<script type="text/javascript">

	$(document).ready(function() {
		    var max_fields      = 10; //maximum input boxes allowed
		    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		    var add_button      = $(".add_field_button"); //Add button ID
                    
		    
		    var x = 1; //initlal text box count
		    $(add_button).click(function(e){ //on add input button click
                        var val_com  = $(".add_field_button").parent().children().val();
		        e.preventDefault();
                        if(val_com != ""){
                            if(x < max_fields){ //max input box allowed
                                x++; //text box increment
                                console.log(val_com);
                                $(wrapper).append('<div><br><input class="form-control col-md-6" type="text" name="listCom[]" value="'+val_com+'" maxlength="45"/><a href="#" class="remove_field"><img alt="Adicionar Comunidade" src="/core/imagem/remove.png" width="25px;"></a></div>'); //add input box
                            }
                        }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
	});

	</script>
