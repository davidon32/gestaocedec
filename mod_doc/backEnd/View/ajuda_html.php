<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_doc/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    
    *{
        font-size: 15pt;
    }
    
    img {
        max-width: 400px;
    }
    
    span.destaque1{
        font-size: 15pt;
        color: red;
        font-weight: bold;
    }
    
    .zoom {
  transition: transform .2s; /* Animation */
  width: 200px;
  height: 200px;

}

.zoom:hover {
  transform: scale(2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
    
    
    
    
</style>
    

<div class="row">
    <div class="col-md-3">
        <a href="<?=FuncaoBase::geraLink("doc", "doc", "index")?>" class="btn btn-success">Voltar</a>
        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
            <legend><p>Indice</p></legend>
             
            <p><a href="#id_funcionalidade">Funcionalidades</a></p>
            
            <ul>
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">ACESSO EMAIL INSTITUCIONAL <span class="label label-default">Novo</span></a>
                    <ul>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#acessowebmail">Acesso WEB email</a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#caixasecao">Acesso caixa email diretoria </a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#trocasenha">Troca Senha acesso webmail </a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#redirecionar">Redirecionar email ( backup, enviar<br> email para outro lugar) </a></li>
                    </ul>
                </li>
                <br>
                
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">CIDADE ADMINISTRATIVA <span class="label label-default">Novo</span></a><br>
                    <ul>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Outlook 2016 ( CA )</a></li><br>
                        <!--<li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso caixa email diretoria </a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Redirecionar email </a></li>-->
                    </ul>
                </li>
            </ul>
        </nav>
    </div>    
    <div class="col-md-9">
        <div class="panel panel-default">
            <div id="acessowebmail" class="panel-heading">Acesso WebMail</div>
            <div class="panel-body">
                <p>1) Acesse : www.mail.ca.mg.gov.br </p>
                <p>2) no campo usuário coloque o <span class="destaque1">mesmo que é usado para acessar os computadores da CA</span><br>
                    <small>Ex: S00987 </small></p>
                <p class='zoom'><img src="anexo/doc/interno/infra/img_ajuda/webmail_01.png"></p><br><br>
                
                <legend id="caixasecao">Abrir email de seção </legend>
                <p>Após fazer o login, para Abrir uma caixa de Email da seção, ex: <span  class="destaque1">defesacivil@defesacivil.mg.gov.br</span>
                      <br>1) Clique no canto superior direito, conforme figura abaixo :</p>
                
                <p class='zoom'><img src="anexo/doc/interno/infra/img_ajuda/webmail_03.png"></p>
                <br><br>
                <legend id="trocasenha">Fazer a Troca de Senha do email</legend>
                Obs: A senha do email é integrada com o usuario dos Computadores da Cidade Administrativa, ou seja após a troca de senha, esta senha será usada para fazer login nos computadores da CA.
                <br><br>
                Sega os passos conforme figuras abaixo:
                <p class='zoom'><img src="anexo/doc/interno/infra/img_ajuda/webmail_05.png"></p><br><br>    
                <p class='zoom'><img src="anexo/doc/interno/infra/img_ajuda/webmail_04.png"></p><br><br>    
                <br><br>
                <legend id="redirecionar">Redirecionar email ( Backup para outro email )</legend>
                <p>em construção</p>
                <br><br>
                
            </div>
            <!-- # inicio grupo -->
            <div id="id_grupo" class="panel-heading">
                Outlook 2016 ( Estação de Trabalho )
            </div>
            <div class="panel-body">
                <p>informações</p>
                <p><img src="imagens"></p>
            </div>
             <!-- # fim grupo  -->
             
            <!-- # inicio funcionalidades -->
            <!--<div id="id_funcionalidade" class="panel-heading">
                Funcionalidades Disponíveis
            </div>
            <div class="panel-body">
                <p>informações</p>
                <p><img src="imagens"></p>
            </div>-->
             <!-- # fim funcionalidades  -->
        </div<br><br><br>
        

    </div>
</div>

<?php
/*
 * <!-- menu -->
<ul>
    <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">TITULO 1<span class="label label-default">Novo</span></a>
        <ul>
            <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opção 1</a></li><br>
            <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opção 2</a></li><br>
        </ul>
    </li>
    <br>
    <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">TITULO 2 <span class="label label-default">Novo</span></a></li><br>
    <ul>
        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opcao 1</a></li><br>
        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">opcao 2</a></li><br>
    </ul>
</ul>

/*<!-- conteudo informações -->
<div class="panel panel-default">
    <div class="panel-heading">Template Titulo</div>
    <div class="panel-body">
        Conteudo
    </div>
</div>*/
?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
