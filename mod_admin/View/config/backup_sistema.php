<!-- Backup Sistema -->
<div class="col-md-2">
        <p>
         Backup Sistema
        <form method="POST" action="#" name="">
            <input type="hiddem" name="" id="" size="" value="<?php print date('G.i.s_d-m-Y'); ?>" >
            <input type="submit" name="backup" id="backup" size="7" value="enviar" >
        </form>
        <?php
            #@ -- backup sistema -->
            $nome = isset($_POST['backup']) ? $_POST['backup'] : "";
            //FuncaoBase::Backup($nome);
            print FuncaoBase::TamanhoBase($nome);
        ?>
                
    </div>