<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";
 include_once "template/page/headerPageSimplesFull.php";


$id = isset($_GET['id']) ? $_GET['id'] :"1";

$defesaAgora = new DefesaAgora();

$lista = $defesaAgora->listaSite($id);


?>
<style>
    .view {
        text-align: justify;
        margin:0 auto;
    }
    
    body {
        padding:15px;
    }

    @media screen and (max-width: 500px) {
   h1 { font-size: 2rem; }
   h2 { font-size: 1.5rem; }
   h3 { font-size: 1rem; }
}
</style>

<body>
    <div class="col-sm-12 text-center">
        <img width="50" src="/core/imagem/defesa_civil_agora.png">
        <br><br>
    </div>
   <div class="container">
    <div class="col-sm-3 view"></diV>
    <div class="col-sm-6" align="center">
        <?php
            $extensao = strtoupper(substr($lista[0]['imagem1'], -3));
            if(($extensao != "PDF") && ($extensao != "DOC") && ($extensao != "OCX")){
                echo "<img width=\"350\" src=\"/anexo/def_civil_agora/".$lista[0]['imagem1']."\" class=\"img-rounded img-responsive\">";
            } else{
                echo "<span>Clique no documento para baixá-lo</span></br>";
                echo "<a href='/anexo/def_civil_agora/".$lista[0]['imagem1']."'>".$lista[0]['imagem1']."</a>";
            }
        ?>
        <br>
        <br>
    </diV>
    <div class="col-sm-3 view"></diV>
   </div>
    <div class="col-sm-3 view"></diV>
    <div class="col-sm-6 view">
        <?=$lista[0]['texto'];?>
        <br>
        <br>
        <?=DataMysql::dataCompletaVisual($lista[0]['data_hora']);?>
        <br><br>
        <p style="text-align:center">
            <a class="btn btn-primary" onclick="javascript:history.back();">Voltar</a>
        </p>
    </diV>
    <div class="col-sm-3 view"></diV>
   </div>
</body>