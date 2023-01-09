<?php include $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';

$registro = new Registro();

$dados = $_POST;

if (!empty($dados['desabrigado']) && !empty($dados['desalojado'])) {

    if ($registro->editar($dados)) {
        print 'sucesso';
    }
}
?>