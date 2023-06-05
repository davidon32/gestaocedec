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

<!-- painel inicial sitema notificacoes -->
<div class="col-md-4 text-left"> 
    <a class="btn btn-success" href='index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')) ?>&ac=etn&modulo=index&controller=index&action=menue'>Acessar Módulos</a>  

    <?php
    
    $email = Compdec::get"";
    $telCoord = "";
    
    ?>
</div> 
<div class="col-md-4 text-center"> 
    <legend>Notificações</legend>
    <?php
    $login = new Login();
    /* $liberacoes = $login->acessoLembreteCompdec($_COOKIE['seguranca']['id_municipio']);


      foreach ($liberacoes as $key1 => $liberacao) {

      print "<ul class=\"todo-lis\">
      <li>

      <span class=\"handle\">
      " . ($key1 + 1) . ") - <i class=\"fa fa-ellipsis-v\"></i>
      <i class=\"fa fa-ellipsis-v\"></i>
      </span>
      <span class=\"text\">

      <a style=\"text-decoration:none;\" href=\"javascript:NovaJanela('index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=ajuda&controller=conestoque&action=lembrete_liberacao&id=" . $liberacao['id_liberacao'] . "', 700, 400)\">
      &nbsp;&nbsp;
      &nbsp;&nbsp;<span style='font-size:12px;'>
      Libera&ccedil;&atilde;o Nº: " . $liberacao['id_liberacao'] . " - " . DataMysql::dataVisual($liberacao['dataLibera']) . "</a>
      </span>
      </span>
      <small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - liberado há " . FuncaoBase::DiferencaDt(date('Y-m-d'), $liberacao['dataLibera'], 'd') . "  dia(s)</small>

      </li>
      </ul>";
      }

      //$login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']) */
    ?>
</div> 
<div class="col-md-4 text-center" style='color:red'> 
    <legend>AVISOS / MENSAGENS</legend>

    <?php
    MensagemSistema::mostraMensagem();
    
    
    ?>


</div> 


<!-- Modal Contatos -->
<div class="modal fade" id="contatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contatos</h5>
            </div>
            <div class="modal-body">
                <label>Email de contato:</label>
                <input class="form form-control" type="email" name="emailContato" id="emailContato" value="<?=$email?>" title="Email para contato da Defesa Civil Municipal" maxlength="110">
                <label>Tel. Coordenador Municipal de Defesa Civil:</label>
                <input class="form form-control" type="text" name="telContato" id="telContato" value="<?=$email?>" title="Telefone de contato da Defesa Civil Municipal" maxlength="16" data-mask="(99)9999-9999">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Continuar</button>
            </div>
        </div>
    </div>
</div>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script>

    $(document).ready(function () {


        /* grava dos dados de contatos */
        $('#contatos').on('hidden.bs.modal', function () {
            $.ajax({
                    type: 'POST',
                    url: 'mod_compdec/fronEnd/View/compdec/valida.php?v=<?= md5(VERSAO)?>',
                    data: dados,
                    //dataType: 'json',
                    success: function (response) {
                        //alert("Documento Validado com Sucesso");
                        //location.reload();
                        console.log(response);
                    },
                    error: function (e) {
                        console.log(JSON.stringify(e));
                    }
                });
            
        });

            /* var email = '<?= $_COOKIE['seguranca']['email_rec'] ?>';
             if((email.length > 0) && (email.match(/.com/))){
             Swal.fire({
             icon: 'error',
             title: 'Atualização de Email necessária...',
             width: 500,
             text: 'Favor atualiar seu email para um email institucional',
             footer: '<a href=\'<?= FuncaoBase::geraLink('compdec', 'compdec', 'index') ?>\'>Clique aqui acessar os dados cadatrais</a>'
             });
             }*/


            /*Swal.fire({
             title: '<strong>UPLOAD arquivos SDC</u></strong>',
             icon: 'info',
             html:
             'Antes de salvar seu documento WORD no formato PDF, faça a Compressão da Imagens, ' +
             '<br>' +
             '<a href="<?= FuncaoBase::geraLink('doc', 'doc', 'compdec') ?>">Clique aqui e Consulte o Manual</a>',
             showCloseButton: true,
             showCancelButton: true,
             focusConfirm: false,
             confirmButtonText:
             '',
             confirmButtonAriaLabel: 'Thumbs up, great!',
             cancelButtonText:
             '',
             cancelButtonAriaLabel: 'Thumbs down'
             });*/

//        Swal.fire({
//         title: '<strong>PEDIDOS DE AJUDA HUMANITÁRIA</u></strong>',
//         width: 700,
//         icon: 'info',
//         html:
//         'PREZADOS COORDENADORES, AGORA OS PEDIDOS DE AJUDA HUMANITÁRIA DEVERÃO SER ENVIADOS SOMENTE PELO SDC,  ' +
//         '<br>' +
//         ' ACESSE O MODULO <b>"PEDIDO DE AJUDA HUMANITÁRIA"</b> ' +
//         '<br>'+
//         '<a href="<?= FuncaoBase::geraLink('doc', 'doc', 'index') ?>">Clique aqui e Consulte o Manual </a>',
//         showCloseButton: true,
//         returnFocus: true,
//         confirmButtonAriaLabel: 'Thumbs up, great!',
//         cancelButtonText: 'Cancelar',
//         cancelButtonAriaLabel: 'Thumbs down'
//         });

            Swal.fire({
                title: '<strong>SENHA DE ACESSO E RECUPERAÇÃO</u></strong>',
                width: 700,
                icon: 'info',
                backdrop: true,
                html:
                        'PREZADOS COORDENADORES, <BR>  ' +
                        'EM BREVE NÃO SERÁ PERMITIDO EMAIL COM DOMÍNIO GMAIL E OUTROS QUE <B>NÃO</B> SEJAM DOMÍNIOS INSTITUCIONAIS/GOVERNAMENTAIS.' +
                        '<br>' +
                        '<i style=\'color:red\'>@seu_municipio.mg.gov.br<BR>' +
                        '@seu_municipio.gov.br<BR>' +
                        '@sua_secretaria.seu_municipio.mg.gov.br</i><BR>' +
                        'PREPAREM-SE !' +
                        '<br>' +
                        '',
                allowEscapeKey: false,
                keydownListenerCapture: true,
                showCloseButton: false,
                allowOutsideClick: false,
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: 'Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
        }).then((result) => {
            $('#contatos').modal('show');
        });

    });
</script>