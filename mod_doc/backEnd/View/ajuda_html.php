<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_doc/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    
    img {
        width: 300;
    }
    
</style>
    

<div class="row">
    <div class="col-md-3">
        <a href="<?=FuncaoBase::geraLink("doc", "doc", "index")?>" class="btn btn-success">Voltar</a>
        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
            <legend><p>Indice</p></legend>
            <a href="#">Glossário</a>  
            <
            <ul>
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">ACESSO EMAIL INSTITUCIONAL <span class="label label-default">Novo</span></a>
                    <ul>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="#acessowebmail">Acesso WEB email</a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso caixa email diretoria </a></li><br>
                        <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Redirecionar email </a></li>
                    </ul>
                </li>
                <br>
                <li class="fa fa-yelp">&nbsp;&nbsp;&nbsp;<a href="">INFORMAÇÕES COMPDEC <span class="label label-default">Novo</span></a></li><br>
                <ul>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso WEB email</a></li><br>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Acesso caixa email diretoria </a></li><br>
                    <li class="fa fa-check">&nbsp;&nbsp;&nbsp;<a href="">Redirecionar email </a></li>
                </ul>
            </ul>
        </nav>
    </div>    
    <div class="col-md-9">
       
        <div class="panel panel-default">
            <div id="acessowebmail" class="panel-heading">Acesso WebMail</div>
            <div class="panel-body">
                Acesse : www.mail.ca.mg.gov.br <br>
                no campo usuário coloque o mesmo que é usado para acessar os computadores da CA<br> 
                <img width="400" src="core/imagem/img_ajuda/img1.jpg">
            </div>
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
