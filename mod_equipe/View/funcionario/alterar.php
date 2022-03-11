<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
/* * **********************************************************************************+
  #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
  #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
  #  Autor       : Demetrio S. Passos     											 #
  #  Criação     : 21/01/2021														 #
  #	Descrição   :
  #
  +*********************************************************************************** */

$email_rec = Usuario::getDadoUsuario($_COOKIE['seguranca']['idUser']);

$voltar = isset($_GET['voltar']) ? ",".array('voltar' => $_GET['voltar']) : "";


?>

<!-- CORPO PAGINA  -->
<div class="span12">
    <legend>Dados Gerais</legend>
    <form action="<?= FuncaoBase::geraLink("equipe", "funcionario", "alterar" .$voltar) ?>" method="POST" name="frm_cad_funcionario">
        <input type="hidden" name="txt_id_funcionario" value="<?php print $dados['id_funcionario']; ?>">


        <label>Nº Policia/MASP</label>  
        <input class="form form-control" type="text" title="Número de Polícia ou Masp" name="txt_masp" placeholder="Nº Polícia/ Masp" value="<?php print $dados['num_masp']; ?>" readonly="readonly">  

        <label>Nome</label>
        <input class="form form-control" type="text" title="Nome do Funcionario" name="txt_nome" placeholder="Nome" value="<?php print utf8_encode($dados['nome']); ?>" required maxlength="70">
        
        <label>CPF</label>
        <input class="form form-control" type="text" title="CPF do Funcionário" name="txt_cpf" placeholder="CPF" data-mask="999.999.999-99" value="<?php print $dados['cpf']; ?>" required maxlength="14">    
   
        <label>C.I.</label>
        <input class="form form-control" type="text" title="Carteira de Identidade" name="txt_ci" placeholder="Carteira de Identidade" value="<?php print $dados['ci']; ?>" required maxlength="20">
        
        <label>Data Nascimento</label>
        <input class="form form-control" type="text" title="Data de Nascimento" name="txt_dt_nascimento" data-mask="99/99/9999" placeholder="Data de Nascimento" value="<?php print DataMysql::dataVisual($dados['dt_nasc']); ?>" required maxlength="10">
        
        <label>Endereço</label>
        <input class="form form-control" type="text" title="Endereço do Funcionário" name="txt_endereco" placeholder="Endereço" value="<?php print utf8_encode($dados['endereco']); ?>" required maxlength="70"> 
   
        <label>Bairro</label>
        <input class="form form-control" type="text" title="Bairro do Funcionário" name="txt_bairro" placeholder="Bairro" value="<?php print $dados['bairro']; ?>" required maxlength="40">
   
        <label>Municipio</label>
        &nbsp;<?php Municipio::PegaMunicipio($dados['cidade']); ?>
    
        <label>Telefone</label>
        <input class="form form-control" type="text" title="" name="txt_tel" data-mask="(99)9999-9999" placeholder="Telefone" value="<?php print $dados['telefone']; ?>" required maxlength="20">
    
        <label>Celular</label>
        <input class="form form-control" type="text" title="" name="txt_cel" data-mask="(99)99999-9999" placeholder="Celular" value="<?php print $dados['celular']; ?>" required maxlength="20">
        
        <label>Email</label>
        <input class="form form-control" type="email" title="Email do Funcionário" name="txt_email" placeholder="Email" value="<?php print $dados['email']; ?>" required maxlength="140">
    
        <label>Email2</label>
        <input class="form form-control" type="email" title="Email do Funcionário" name="txt_email2" placeholder="Email2" value="<?php print $dados['email2']; ?>" maxlength="140">
        
        <hr>
        <legend>Dados Cidade Adm </legend>
        <label>Telefone da Mesa</label>
        <input class="form form-control" type="text" title="Telefone da Mesa" name="txtTel_mesa" placeholder="Telefone da Mesa" value="<?php print utf8_encode($dados['ramal']); ?>" required maxlength="20">
 
        <label>Numero da Mesa</label>
        <input class="form form-control" type="text" title="Número da Mesa" name="txtNum_mesa" placeholder="Número Mesa" value="<?php print utf8_encode($dados['num_mesa']); ?>" required maxlength="20">

        <label>Ponto de Rede</label>
        <input class="form form-control" type="text" title="Ponto de Rede" name="txtPonto" placeholder="Ponto de Rede" value="<?php print utf8_encode($dados['ponto_rede']); ?>" required maxlength="20">
  
        
        <label>Email Recuperação de Senha</label>
        <input class="form form-control" type="email" title="Email recuperação de senha" name="txtEmailRec" placeholder="Email Recuperação de Senha" value="<?= $email_rec['email_rec'] ;?>" required maxlength="70">

        <?= EquipeFuncionario::postoGraduacao($dados['posto']); ?>

        <?= EquipeFuncionario::secaoDiretoria($dados['secao']); ?>
        
        <?= EquipeFuncionario::funcaoCargo($dados['funcao']); ?>
    
        <?= EquipeFuncionario::funcaoExercida($dados['desc_funcao']); ?>
        

        <!--<label>Abono</label><br>
        <label class="checkbox inline">ADT</label>
            <input type="checkbox" id="ck_adt" value="ADT" name="ck_adt" <?php print ($dados['tipo_abono'] == "ADT") ? "checked=\"checked\"" : ""; ?>> 
        
        <label class="checkbox inline">ADE</label>
            <input type="checkbox" id="ck_ade" value="ADE" name="ck_ade" <?php print ($dados['tipo_abono'] == "ADE") ? "checked=\"checked\"" : ""; ?>> 
       

        <label class="checkbox inline">DAD</label>
            <input type="checkbox" id="ck_dad" value="DAD" name="ck_dad" <?php print ($dados['tipo_abono'] == "DAD") ? "checked=\"checked\"" : ""; ?>> 
        <br>
        <br>

    <label>Quinquenio</label>
    <input class="form form-control" type="text" title="Números de Quinquênios/ ADE / DAD" name="txt_quinquenio" placeholder="Quinquênio" value="<?php print $dados['quinquenio']; ?>">
-->

        <label>Setor</label>
        <select class="form form-control" name="txt_orgao" title="Órgão">
            <option><?php print $dados['orgao']; ?></option>
            <option>GMG/CEDEC</option>
            <option>GMG/TIRADENTES</option>
            <option>GMG/DTA</option>
            <option>GMG/DTT</option>
            <option>GMG/SIS</option>
            <option>GMG/SPGF</option>
        </select>
        <label>RPM</label>
        <select class="form form-control" name="sel_rpm" title="Regional de PM">
            <option value='<?php print $dados['id_rpm'];?>'><?php print $dados['rpm']; ?></option>
            <?php
            
            
            foreach ($dados_rpm as $key => $rpm) {
                print "<option value='".$rpm['id']."'>".$rpm['nome']."</option>";
                
            }
            
            ?>
        </select>
    
        
    
        <label>Cursos Realizados na Cedec</label>
        <input class="form form-control" type="text" title="Curso" name="txt_curso" placeholder="Curso" value="<?php print $dados['curso']; ?>" maxlength="40"/>
    
        <!--<label>Situação</label>
        <select class="form form-control" title="Situação" name="selSituacao">
            <option value="<?php print $dados['situacao']; ?>"><?php print ($dados['situacao'] == "1") ? "Ativo" : "Inativo"; ?></option>
        </select>-->
        <br>

        <button class="btn btn-primary" type="submit" title="Alterar Dados de Funcionario" name="btn_envia">Continuar</button>    


</div>

</form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">
    $(document).ready(function () {

        $("#ck_adt").click(function () {

            $("#ck_ade").attr("checked", false);
            $("#ck_dad").attr("checked", false);
        });

        $("#ck_ade").change(function () {

            $("#ck_adt").attr("checked", false);
            $("#ck_dad").attr("checked", false);

        });

        $("#ck_dad").change(function () {

            $("#ck_adt").attr("checked", false);
            $("#ck_ade").attr("checked", false);

        });
    });
</script>
</body>
</html>