<?php
	
	#@ ############################## motorista #############################
	
	#@ Cadastro de Motorista
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
	    
	    include 'visao/MotoristaView/sc.motorista.cadastrar.php';
	    exit();
	}
	
	#@ Validar Cadastro Motorista
	if ((isset($_GET['secao']) && $_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarCadastrar")){
	     
	    include_once 'controle/motorista/valida.motorista.cadastrar.php';
	    exit();
	}

	#@ Pesquisa Motorista Alterar cadastro motorista
	if ((isset($_GET['secao']) && $_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")){
	    
	    include_once 'visao/MotoristaView/sc.motorista.buscar.alterar.php';
	    exit();
	}

	#@ Formulario Alterar cadastro motorista
	if ((isset($_GET['secao']) && $_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "alterar")){
	     
	    include_once 'visao/MotoristaView/sc.motorista.alterar.php';
	    exit();
	}

	#@ Validar Alteração Cadastro Motorista
	if ((isset($_GET['secao']) && $_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarAlterar")){
	     
	    include_once 'controle/motorista/valida.motorista.alterar.php';
	    exit();
	}

	#@ Pesquisa Motorista Base
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "motorista") && (isset($_GET['acao'])) && ($_GET['acao'] == "pesquisar")) {

		include_once 'visao/MotoristaView/sc.motorista.pesquisar.php';

	}
	
	
	#@ ############################## caminhao #############################
	
	#@ Cadastro de Caminhao
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
	    
	    include_once 'app/caminhao/cadastro.php';
	}

	#@ Validar Cadastro Caminhao
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "validar")) {
	    
	    include_once 'app/caminhao/validar.php';
	}

	
	#@ Busca Alterar Cadastro Caminhao
	if ((isset($_GET['secao']) && $_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")){
	    
	    include_once 'app/caminhao/busca_alterar.php';
	    exit();
	}

	#@ Formulario Alterar cadastro caminhao
	if ((isset($_GET['secao']) && $_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "alterar")){
	    
	    include_once 'app/caminhao/alterar.php';
	    exit();
	}

	#@ Validar Alterar Caminhao
	if ((isset($_GET['secao']) && $_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarAlterar")){
	    
	    include_once 'visao/sc.valida.caminhao.alterar..php';
	    exit();
	}


	#@ Pesquisar Caminhao Base
	if ((isset($_GET['secao']) && $_GET['secao'] == "caminhao") && (isset($_GET['acao'])) && ($_GET['acao'] == "pesquisar")){
	    
	    include_once 'app/caminhao/pesquisar.php';
	    exit();
	}
	
	#@ ############################## rota #############################
	
	#@ Cadastrar Rota
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
	 
	    include_once 'app/rota/cadastro.php';
	}
	
	#@ Validar Cadastro Rota
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarCadastrar")) {
	    
	   include_once 'app/rota/validar.php';
	}

	#@ Busca Alterar Cadastro Rota
	if ((isset($_GET['secao']) && $_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")){
	         
	        include_once 'app/rota/sc.rota.buscar.alterar.php';
	        exit();
	}

	#@ Formulario Alterar Cadastro Rota
	if ((isset($_GET['secao']) && $_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "alterar")){
	    
	    include_once 'app/rota/alterar.php';
	    exit();
	}

	#@ Validar Alterar rota
	if ((isset($_GET['secao']) && $_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarAlterar")){
	    
	    include_once 'app/rota/valida.rota.alterar.php';
	    exit();
	}


	#@ Pesquisar rota Base
	if ((isset($_GET['secao']) && $_GET['secao'] == "rota") && (isset($_GET['acao'])) && ($_GET['acao'] == "pesquisar")){
	    
	    include_once 'app/rota/pesquisar.php';
	    exit();
	}


	#@ ############################## contrato #############################
	
	#@ cadastro de contrato
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
	
	include_once 'app/contrato/cadastro.php';
	
	}

	#@ Validar Cadastro Contrato
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarCadastro")) {
	    
	    include_once 'controle/contrato/valida.contrato.cadastrar.php';
	}
	
	#@ Buscar Alterar Cadastro Contrato
	if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")){
	
	include_once 'app/contrato/sc.contrato.buscar.alterar.php';
	exit();
	}

	#@ Formulario Alterar Cadastro Contrato
	if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "alterar")){
	
	include_once 'app/contrato/sc.contrato.alterar.php';
	exit();
	}

	#@ Validar Alterar rota
	if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarAlterar")){
	    
	    include_once 'controle/contrato/valida.contrato.alterar.php';
	    exit();
	}


	#@ Pesquisar rota Base
	if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "pesquisar")){
	    
	    include_once 'app/contrato/sc.contrato.pesquisar.php';
	    exit();
	}

	
	#@ Formulario de Rescisao Contrato
	if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "rescindir")){
	
	    include_once 'app/contrato/sc.contrato.rescisao.php';
	    exit();
	}
    
    #@ Validar Rescisao Contrato
    if ((isset($_GET['secao']) && $_GET['secao'] == "contrato") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarRescindir")){
    
        include_once 'controle/contrato/valida.contrato.rescisao.php';
        exit();
    }
	
	

	
	#@ ############################## conta #############################
	
		
	#@ Formulário para preencher os valores (km ou valor) para gerar os impostos
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadConta")) {
	
	    include_once 'visao/ContaView/sc.acertar.conta.cadastrar.php';
	
	}

    #@ Formulário acerto de contas gerar contas (pessoa juridica)
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadContaPj")) {
            
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        include_once 'visao/ContaView/sc.acertar.conta.cadastrar.pj.php';
    
    }
    
	
	#@ Formulário para visualizar prévia de valores de impostos e gravação no banco
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "previaConta")) {
	
	    include_once 'visao/ContaView/sc.acertar.conta.previa.visualizar.php';
	
	}
    
    #@ Formulário para visualizar prévia de valores PJ e gravação no banco
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "gerarValorPj")) {
    
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        include_once 'visao/ContaView/sc.acertar.conta.visualizar.pj.php';
    
    }
	
	#@ Validar valores acerto de conta (grava banco)
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "validarCadConta")) {
	
	    header("Location:controller/valida.conta.acerto.php");
	
	}
	
	#@ Realiza o recalculo de valores
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "recalcular")) {
	
		$id_conta = $_GET['id'];
        $_pessoa = $_GET['pessoa'];
	    include_once "visao/ContaView/sc.acertar.conta.recalculo.php";
	    exit();
	
	}

	#@ Valida recalculo de valores
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "validaRecalcular")) {
	
		$id_conta = $_GET['id'];
	    include_once "controller/valida.correcao.acertar.php";
	    exit();
	
	}
    
    #@ Buscar contas para alterar (correção contabil incompatibilidade programa SETIP)
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscarAlterar")) {
    
        //$id_conta = $_GET['contrato'];
        include_once "visao/ContaView/sc.conta.buscar.alterar.php";
        exit();
    
    }
    
    #@ Formulario de conta para correção de valores (Incompatibilidade programa SETIP)
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "alterarConta")) {

        include_once "visao/ContaView/sc.conta.alterar.php";
        exit();
    
    }
    
    #@ Valida correcao de valores Impostos (Incompatibilidade Calculo SETIP)
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "validaCorrecao")) {

        include_once "controle/conta/valida.conta.correcao.php";
        exit();
    
    }
    

    
	#@ Impressao RPA
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "conta") && (isset($_GET['acao'])) && ($_GET['acao'] == "rpa")) {
	
	    header("Location:visao/voltar.php");
	
	}
	
	#@ ############################## relatorio #############################
	

	#@ Relatorio de RPA
	if ((isset($_GET['secao']) && $_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "rpa")){
	
	    include_once 'visao/ContaView/sc.busca.rpa.php';
	    exit();
	    }

	#@ Relatorio de Impostos
	if ((isset($_GET['secao']) && $_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "imposto")){
		
	    include_once 'visao/ContaView/sc.imposto.busca.impressao.php';
	    exit();
	    }

	#@ Consideração de Despesas
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "considera")) {
	
	    include_once 'visao/RelatorioBuscaView/consideracaoDespesa.php';
	
	}

	#@ Relatório de Conferência de Valores
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "conferencia")) {
	
	    include_once 'rel/rel.conta.conferencia.php';
	
	}

	#@ Relatorio de Resumo de Contratos
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "contrato")) {
	    
	    include 'app/contrato/sc.resumo.contrato.geral.php';
	    exit();

	}
    
    #@ Visualizar relatorio 
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "visualizar")) {
        
        include 'rel/rel.resumo.contrato.geral.php';
        exit();

    }

    #@ filtro para cadastro pipeiro
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroCadPipeiro")) {
    
        include 'sc.busca.impressao.pipeiro.php';
        exit();
    }
    #@ filtro para cadastro motorista
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroCadMotorista")) {
        
        include 'sc.busca.motorista.php?&op=1';
        exit();

    }
    
    #@ filtro para cadastro caminhao
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroCadCaminhao")) {
    
        include 'sc.busca.impressao.caminhao.php';
        exit();
        }

    #@ filtro para cadastro rota
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroCadRota")) {
    
        include 'sc.busca.impressao.rota.php';
        exit();
    }
    
    #@ filtro para cadastro contrato
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroCadContrato")) {
    
        include 'app/contrato/sc.busca.impressao.contrato.php';
        exit();
    }
    
    #@ relatorio cadastro contrato
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "relCadContrato")) {
    
        include 'rel/rel.cadastro.contrato.php';
        exit();
    }
     
    #@ filtro resumo de contas
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "filtroResumo")) {
    
        include 'visao/ContaView/sc.busca.resumo.contas.php';
        exit();
    }   
    
    #@ resumo de contas
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "relatorio") && (isset($_GET['acao'])) && ($_GET['acao'] == "resumo")) {
    
        include 'rel/rel.imposto.resumo.php';
        exit();
    }                                          
      

	?>