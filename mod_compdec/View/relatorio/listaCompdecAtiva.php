<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>

<div class="container">
<div class="col-lg10 col-xs-12 text-center" style="height:100px;">
    <h4><b>Lista Municípios com Compdec Ativa</b></h4>
    <img src="/core/imagem/cedec.png" width="50px;" >
    <a class="btn btn-primary" href='javascript:history.back();'>Voltar</a>
</div>
<style>

  table, th, td {
    border: 0.1em solid ;
    margin-left:auto; 
    margin-right:auto;
    font-size:15pt;
  }

  td{
    padding:2px;
  }

</style>
<?php include_once 'core/include.php';

  $compdec = new Compdec();

$dados = $compdec->listaCompdecAtiva();

?>
<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      .wrap { max-width: 75em; min-height: 40em; height:100%; width:100%; margin: 0 auto; padding-top: 2.5%;}
      #map-canvas { height: 80%; }
    </style>
  </head>
  <body>
  <div class="col-lg10 col-xs-12 center">
    <p style='text-align:center;'><span>Atualizado em <?=date('d/m/Y h:i:s');?></span></p>
    <?php
      print "<table class=''";
      print "<tr>";
        print "<th style='width:5%; text-align:center'>#</th>";
        print "<th  style='width:30%; text-align:center'>Nome</th>";
        print "<th  style='width:20%; text-align:center'>Tel. Compdec</th>";
        print "<th  style='width:20%; text-align:center'>Tel. Coordenador</th>";
        print "<th  style='width:20%; text-align:center'>Tel. Prefeitura</th>";
        print "</tr>";
      foreach ($dados as $key=>$value) {
        $telCoordenador = $compdec->getTelCoordenador($value['id_municipio']);
        print "<tr>";
        print "<td style='text-align:center'>".($key+1)."</td>";
        print "<td style='text-align:left;padding-left:5px;'>".$value['nome']."</td>";
        print "<td style='text-align:center; font-size:11pt;'>".$value['tel_compdec1']." / ".$value['tel_compdec2']."</td>";
        print "<td style='text-align:center; font-size:11pt;'>".$telCoordenador."</td>";
        print "<td style='text-align:center; font-size:11pt;'>".(isset($value['tel_prefeitura']) ? $value['tel_prefeitura'] : "não cadastrado") ."</td>";
        print "</tr>";
      }

      print "</table>";
    ?>
  </div>

  </body>
</html>
<br>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePageSimplesFull.php";?>