<?php	include_once '../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();
	
	
	
	$dados = Decretacao::MostraProcesso(Decretacao::getSetor($_SESSION['seguranca']['login']));
	
	FuncaoBase::vd($dados);
	
	?>

	<br />
	Setor:<input type="text" name="setor" value="<?php print $dados['setor'];?>" />
	<br />
	Responsável:<input type="text" name="setor" value="<?php print $dados['responsavel'];?>" />
	<br />
	Município:<input type="text" name="setor" value="<?php print $dados['id_municipio'];?>" />


	
