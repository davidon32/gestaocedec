<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_doc/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
$_funcaoBase = new FuncaoBase();

?>
<div class="col-md-12 text-center"><a href='<?= FuncaoBase::geraLink("doc", "doc", "index")?>' class='btn btn-success'>Voltar</a></div>
    
<br><br>

<h2><p>Troca de Senha</p></h2>
<p>1) Clique no nome do Usuario conforme figura abaixo, após clique em perfil :</p>
    <p style='vertical-align: text-top' class=""><img src="anexo/doc/interno/ajuda/senha_perfil/perfil.png"></p>
<br>
<p>2) Clique em editar </p>
<p><img src='/anexo/doc/interno/ajuda/senha_perfil/editar.png'></p>
<br>
<p>3) Após Alterar a senha ou editar as informações clique em Salvar</p>
<p><img src='/anexo/doc/interno/ajuda/senha_perfil/dados.png'></p>

<h2><p>Atualizar dados Gerais do Usuário</p></h2>
<p>1) Clique em Dados do Funcionário :</p>
    <p style='vertical-align: text-top' class=""><img src="anexo/doc/interno/ajuda/senha_perfil/dados_funcionario.png"></p>
    <p>Preencha as informações e no final do formulário, clicar em salvar.</p>
    <p>é importante manter as informações atualizadas de contatos eletrônicos e email, pois estas informações estaram disponiveis <br> na tela inicial do sistema em "Informações Rápidas" e também agilizando a abertura de chamados na Cidade Administrativa.</p>
    <br>
    <i>"Isto fica feliz em ser útil ! - Andrew Martin"</i>
    
</li>
<li>
    
</li>

    


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>