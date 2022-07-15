<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';


$_usuario = $_COOKIE['seguranca']['idUser'];

/* Entrada de Materiais */
if($_POST['opcao'] == 'cad_material') {

	$_id_produto     = isset($_POST['id_produto'])     ? $_POST['id_produto']     : "";
	$_txtDtEntrada   = isset($_POST['txtDtEntrada'])   ? $_POST['txtDtEntrada']   : "";
	$_txtOrigem      = isset($_POST['txtOrigem'])      ? $_POST['txtOrigem']: "";
	$_txtValidade    = isset($_POST['txtValidade'])    ? $_POST['txtValidade']    : "";
	$_txtQtd         = isset($_POST['txtQtd'])         ? $_POST['txtQtd']         : "";
	$_id_deposito    = isset($_POST['id_deposito'])    ? $_POST['id_deposito']    : "";
	$_txarObs        = isset($_POST['txObs'])          ? FuncaoBase::tirarAcentos($_POST['txObs'])        : "";
	$_nota       = isset($_FILES['fl_nota']['name'])   ? $_id_produto."-".$_txtQtd."_nota_entrada.".Anexo::getExtensao($_FILES['fl_nota']['name']) : "";
	$_btnCadMaterial = isset($_POST['btnCadMaterial']) ? true 					  : "";
	$_complnota      = isset($_POST['complnota'])      ? $_POST['complnota']      : "";
        $hora = date('His');


	$campos = array("Produto"        => $_id_produto,    
					"Data Entrada"   => $_txtDtEntrada,
					"Origem Material"=> $_txtOrigem,     
					"Quantidade"     => $_txtQtd,
					"Deposito"       => $_id_deposito);  
					
			if(FuncaoBase::CampoBranco($campos)){
					
				if(Material::Cadastrar($_id_produto,
							Unidade::PegaNomeId($_id_produto)." ". str_replace("/",".",$_txtDtEntrada),
							DataMysql::dataForm($_txtDtEntrada),
							$_txtOrigem,
							$_txarObs,
							$_txtQtd,
							Deposito::PegaNomeDeposito($_id_deposito),
							DataMysql::dataForm($_txtValidade),
							$hora.$_nota,
                                                        $_id_deposito,
                                                        null,
                                                        $_usuario)) {
                                    
                                    Material::Complnota($_id_produto, $_complnota);

					/* LANCA ATUALIZACAO SALDO DO MATERIAL */
					Material::atualizarSaldo($_id_produto,$_id_deposito,$_txtQtd);
					
					/* LANCAMENTO DO CONTA CORRENTE */
					/* ControleSaldo::lancaCC($_txtDtEntrada, $_id_produto, 
											"ENTRADA NOTAS DE MATERIAL",
											$_txtOrigem,
											$_id_deposito,
											"ENTRADA NOTA",
											$_txtQtd,
											"C"); */

					if(!empty($_nota)){
						$result = Anexo::upload(PATH.'/anexo/entrada_nota',
												 $_FILES,
												 "fl_nota",
												 $hora.$_id_produto."-".$_txtQtd,
												 'nota_entrada');
						/*if($result) {
							//print "sucesso";
						}else {
							//print var_dump($result);
						}*/
					}
					
					Log::GravaLog("Cadastro de material id_produto:".$_id_produto." qtd:".$_txtQtd." dataEntrada: ".$_txtDtEntrada." validade: ".$_txtValidade. " depDestino:".$_id_deposito, "aju_log");
							
					print "sucesso";
				}
	
			}else {
                            print "s_dep";
                        }
}elseif ($_POST['opcao'] == 'editar_entrada'){
    
    //var_dump($_POST);
    
        $_id_produto     = isset($_POST['id_produto'])     ? $_POST['id_produto']     : "";
	$_txtOrigem      = isset($_POST['txtOrigem'])      ? $_POST['txtOrigem']: "";
	$_txtValidade    = isset($_POST['txtValidade'])    ? (empty($_POST['txtValidade']) ? null : $_POST['txtValidade'])    : null;
	$_id_deposito    = isset($_POST['id_deposito'])    ? $_POST['id_deposito']    : "";
	$_txarObs        = isset($_POST['txObs'])          ? FuncaoBase::tirarAcentos($_POST['txObs'])        : "";
	$_id_entrada     = isset($_POST['id_entrada'])     ? $_POST['id_entrada']    : "";
	$_btnCadMaterial = isset($_POST['btnAlteraMaterial']) ? true 					  : "";


	$campos = array("Produto"   => $_id_produto,    
				"Origem Material"=> $_txtOrigem);  
					
			if(FuncaoBase::CampoBranco($campos)){
                            
                            $post = array("id_produto" =>$_id_produto,
                                            "origem" =>	$_txtOrigem,
                                            "validade" =>$_txtValidade,
                                            "id_deposito" =>$_id_deposito,
                                            "obs" => $_txarObs,
                                            "id_entrada"=>$_id_entrada);
                           	
                                    var_dump(Material::Editar($post));
				if(Material::Editar($post)) {
					
                                    print "sucesso";
				}
	
			}
/* Cadastro produto (unidade) */
}elseif($_POST['opcao'] == 'cad_prod') {
    

		$_nome      = isset($_POST['nome'])      ? $_POST['nome']      : "";
		$_descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
		$_basico    = isset($_POST['singular']) ? $_POST['singular'] : "";
		$_uniMedida = isset($_POST['unidadeMedida']) ? $_POST['unidadeMedida'] : "";
		$_peso = isset($_POST['peso']) ? $_POST['peso'] : "";
		$_valor = isset($_POST['valor']) ? $_POST['valor'] : "";
		$_btnCadMaterial = isset($_POST['btnCadProduto']) ? true 	   : "";
	
		$campos = array("nome"        => $_nome);  
		
				if(FuncaoBase::CampoBranco($campos)){
						
					$ultimoID = Material::CadProd($_nome,$_descricao, $_uniMedida, $_peso, $_valor, $_basico);
					
					ControleSaldo::lancaSaldoGeralZerado($ultimoID);
					Log::GravaLog("Cadastro de Produto nome:".$_nome." descricao:".$_descricao, "aju_log");		
					print "sucesso";
				
				
				}
/* CADASTRO DE FONTE DE ENTRADA DE MATERIAIS */
}elseif($_POST['opcao'] == 'cad_fonte') {

	$_nome      = isset($_POST['nome'])      ? $_POST['nome']      : "";
	$_btnCadMaterial = isset($_POST['btnCadFonte']) ? true 	   : "";
	$_cad_por_mat = isset($_POST['cad_pelo_mat']) ? $_POST['cad_pelo_mat'] :"";

	$campos = array("nome"        => $_nome);
        
           
            $res = strpos($_nome, "ESTOQUE");
            if($res === false) {
	
			if(FuncaoBase::CampoBranco($campos)){
					
				if(Material::CadFonte($_nome)) {

					Log::GravaLog("Cadastro de Fonte material:".$_nome, "aju_log");		
					if(strlen($_cad_por_mat) > 0) {
						print "sucesso1";
					}else {
						print "sucesso";
					}

				}
			}
            }else {
                return "erro";
            }

/* CADASTRO DE EVENTOS */
}elseif($_POST['opcao'] == 'cad_evento') {

	$_nome     = isset($_POST['nome'])      ? $_POST['nome']      : "";
	$_btnCadMaterial = isset($_POST['btnCadEvento']) ? true 	   : "";

	$campos = array("nome"        => $_nome);       
	
			if(FuncaoBase::CampoBranco($campos)){
					
				if(Material::CadEvento($_nome)) {

					Log::GravaLog("Cadastro de Evento:".$_nome, "aju_log");		
					print "sucesso";

				}
			}
 /* remover entrada de materiais */                        
}elseif($_POST['opcao'] == 'del_entrada') {
    
    $id_entrada = $_POST['id_entrada'];
    $quantidade = $_POST['quantidade'];
    $_id_produto = $_POST['id_produto'];
    $_id_deposito = $_POST['id_deposito'];
        
    $saldo = Material::SaldoMaterial($_id_produto, $_id_deposito);
    
    if($quantidade > $saldo) {
        print "semsaldo";
    }else {
        Material::CancelaEntrada($id_entrada);
        ControleSaldo::DebitarSaldo($_id_produto, $_id_deposito, $quantidade);
        print "sucesso";
    }
    
    
}

?>