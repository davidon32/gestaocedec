<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php

$saldo = new ControleSaldo();
$id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] :"";
$id_material = isset($_POST['id_produto']) ? $_POST['id_produto'] :"";
$id_entrada = isset($_POST['id_entrada']) ? $_POST['id_entrada'] :"";
$qtd = isset($_POST['qtd']) ? $_POST['qtd'] :"";

$txarObs    = isset($_POST['obs']) ? $_POST['obs'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

if(empty($opcao) && (empty($qtd))){
    
    die();
}else {
    
    # busca saldo material 
    if($opcao == "saldo"){
        print $saldo->buscaSaldoMaterialDeposito($id_deposito, $id_material);
    
    # grava entrada de saldo de materiais
    }elseif ($opcao == "gravar"){
        
        if($qtd > 0){
            # lancar entrada de material
            $ajusteSaldo = $saldo->CreditarSaldo($id_material, $id_deposito, $qtd);
            if($ajusteSaldo){
                $result = Material::Cadastrar($id_material,
                                            Unidade::PegaNomeId($id_material),
                                            date("Y-m-d"),
                                            "Correção Manual de Saldo",
                                            $txarObs,
                                            $qtd,
                                            Deposito::PegaNomeDeposito($id_deposito),
                                            "-",
                                            $id_deposito,
                                            $_COOKIE['seguranca']['idUser'],
                                            $id_entrada);
            }
            if($result){
                print "sucesso";
            };

        }elseif ($qtd < 0){
            
            # lancar entrada negativa material - ajuste saldo
            $ajusteSaldo = $saldo->DebitarSaldo($id_material, $id_deposito, abs($qtd));
            
            if($ajusteSaldo){
                $result = Material::Cadastrar($id_material,
                                            Unidade::PegaNomeId($id_material),
                                            date("Y-m-d"),
                                            "Correção Manual de Saldo",
                                            $txarObs,
                                            $qtd,
                                            Deposito::PegaNomeDeposito($id_deposito),
                                            "-",
                                            $id_deposito,
                                            $_COOKIE['seguranca']['idUser'],
                                            $id_entrada);
            }
            if($result){
                print "sucesso";
            };
        }
    }
}