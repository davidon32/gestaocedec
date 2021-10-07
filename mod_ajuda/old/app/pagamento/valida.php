<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once PATH.'/include.php';

    $_conexao = new ConexaoMysql();

    $_compdec = new Compdec();

    $_funcaoBase = new FuncaoBase();
    
    $_pagamento = new Pagamento();
    
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body>
<?php 

    $secao = isset($_GET['secao']) ? $_GET['secao'] : "";
    $acao  = isset($_GET['acao'])  ? $_GET['acao']  : "";
    $cpf  = isset($_POST['cnpj'])  ? $_POST['cnpj'] : "";
    $cnpj = isset($_POST['cpf'])   ? $_POST['cpf']  : "";
        
        if($cpf == "") {
        
            $_cnpjcpf_b = $cnpj;
        }elseif ($cnpj == "") {
        
            $_cnpjcpf_b = $cpf;
        }
        
        #@ variaveis do post
        $_nRecibo   = 0;
        $_nLibera   = isset($_POST['nLibera'])      ? $_POST['nLibera']                                     : "";
        $_dtLibera  = isset($_POST['dtLibera'])     ? $_POST['dtLibera']                                    : "";
        $_dtPgto    = isset($_POST['dtPgto'])       ? htmlentities(htmlspecialchars($_POST['dtPgto']))      : "";
        $_benef     = isset($_POST['beneficiario']) ? $_POST['beneficiario']                                : "";
        $_endereco  = isset($_POST['endereco'])     ? $_POST['endereco']                                    : "";
        $_bairro    = isset($_POST['bairro'])       ? $_POST['bairro']                                      : "";

        $_resp      = isset($_POST['responsavel'])  ? htmlentities(htmlspecialchars($_POST['responsavel'])) : "";
        $_nDoc      = isset($_POST['nDoc'])         ? htmlentities(htmlspecialchars($_POST['nDoc']))        : "";
        $_dtLimite  = isset($_POST['dtLimite'])     ? $_POST['dtLimite']                                    : "";
        $_veiculo   = isset($_POST['veiculo'])      ? $_POST['veiculo']                                     : "";
        $_obs       = isset($_POST['obs'])          ? $_POST['obs']                                         : "";
        $_n_end_resp= isset($_POST['numero'])       ? $_POST['numero']                                      : "";
        $_municipio = isset($_POST['municipio'])    ? $_POST['municipio']                                   : "";
        $_cpfResp   = isset($_POST['cpfResp'])      ? $_POST['cpfResp']                                     : "";
        $_placa     = isset($_POST['placa'])        ? $_POST['placa']                                       : "";
        $_tel_dest  = isset($_POST['tel_dest'])     ? $_POST['tel_dest']                                    : "";
        $_cel_dest  = isset($_POST['cel_dest'])     ? $_POST['cel_dest']                                    : "";
        
                //FuncaoBase::vd($_nLibera);
        
                //var_dump($_POST);
        
        // cpf do beneficiario
        $campos = array('Número Liberação'=>$_nLibera,
                        'Data Liberação'=>$_dtLibera,
                        'Data Pagamento'=>$_dtPgto,
                        'Beneficiário'=>$_benef,
                        'Endereco'=>$_endereco,
                        'Bairro'=>$_bairro,
                        
                        'Responsável'=>$_resp,
                        'Nº Documento'=>$_nDoc,
                        'Data Limite Pagamento'=>$_dtLimite,
                        'Veículo'=>$_veiculo,
                        'Endereço Responsável'=>$_n_end_resp,
                        'Municipio'=>$_municipio,
                        'CPF_Responsável'=>$_cpfResp,
                        'Placa'=>$_placa);
        
        if(FuncaoBase::campoBranco($campos)){
        
                    if ($_pagamento->Pagar($_dtLibera,
                            $_nLibera,
                            $_dtLimite,
                            $_dtPgto,
                            $_benef,
                            $_resp,
                            $_nDoc,
                            $_nRecibo,
                            $_endereco,
                            $_bairro,
                            $_cnpjcpf_b,
                            $_veiculo,
                            $_obs,
                            $_n_end_resp,
                            $_municipio,
                            $_cpfResp,
                            $_placa,
                            $_tel_dest,
                            $_cel_dest)){
        
        
                        Log::GravaLog("Foi realizado o pagamento da liberacao : ".$_nLibera." Recibo Nr: ".$_nRecibo, "aju_log");
                        
                        print "<script text/javascript>";
        
                        print "alert('Pagamento Realizado com Sucesso !');";
                                
                        print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=ajuda&secao=pagamento&acao=recibo_pgto&id=".$_nLibera."';";
        
                        print "</script>";
        
        
        
                    }
        }