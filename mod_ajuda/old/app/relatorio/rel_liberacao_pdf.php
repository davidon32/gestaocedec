<?php session_start();
	include_once PATH.'/mod_ajuda/func/include_class_pdf.php';
		
		$_conexao = new ConexaoMysql();
		
		$_login = new Login();

		$_login->Logado();
		
		$dados = Liberacao::comprovanteLiberacao($_SESSION['idLibera']);

		//var_dump($dados);
		
		$material = Liberacao::listaProdutosSemPrint($dados['id_liberacao']);

		//var_dump($dados);
//FuncaoBase::vd($dados);
//FuncaoBase::vd($material);
define('FPDF_FONTPATH','mod_ajuda/plugins/fpdf/font/');
$pdf = new FPDF("P");
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetMargins(10,10,10);
$pdf->setY("2.25");
$pdf->setX("11.6");
$pdf->image("mod_ajuda/imagem/brasaoMG_80x77.png",20,15,15,15);
$pdf->Ln(10);
$pdf->Cell(0,7, "Estado de Minas Gerais",0,2,"C");
$pdf->Cell(0,5, "Gabinete Militar do Governador",0,2,"C");
$pdf->Cell(0,6, "Coordenadoria Estadual de Defesa Civil",0,1,"C");
$pdf->image("mod_ajuda/imagem/logodefesacivilpng80x77.png",180,15,15,15);
$pdf->Ln(20);
$pdf->Cell(0,0,"                           Em : ".DataMysql::dataVisual($dados['dataLibera'])."                                                          ".iconv('utf-8','iso-8859-1','Liberação') ." :" .$dados['id_liberacao'],0,1);
$pdf->Ln(5);
$pdf->Cell(0,0,"                           Ao ".iconv('utf-8','iso-8859-1','Depósito') ." :" .Deposito::PegaNomeDeposito($dados['depDestino']),0,1);
$pdf->Ln(5);
$pdf->Cell(0,0,"                           ".iconv('utf-8','iso-8859-1','Município') ." :" .Municipio::PegaNomeMunicipio($dados['id_municipio']),0,1);
$pdf->Ln(5);
$pdf->Cell(0,0,"                           ".iconv('utf-8','iso-8859-1','Benefíciário') ." :" .$dados['beneficiario'],0,1);
$pdf->Ln(5);
$pdf->Ln(20);
$pdf->Cell(0,0,"Proceder a ".iconv('utf-8','iso-8859-1','Liberação')." dos seguintes materiais:", 0,1, "C");
$pdf->Ln(15);
$pdf->Cell(50,5,"",0,0,"C");
$pdf->Cell(30,5,"Nome",1,0,"C");
$pdf->Cell(30,5,iconv('utf-8','iso-8859-1','Descrição'),1,0,"C");
$pdf->Cell(30,5,"Quantidade",1,0,"C");
$pdf->Ln(5);
	for($i=0; $i < count($material); $i++){
		$pdf->Cell(50,5,"",0,0,"C");
		$pdf->Cell(30,5,$material[$i][0],1,0,"C");
		$pdf->Cell(30,5,$material[$i][1],1,0, "C");
		$pdf->Cell(30,5,$material[$i][2],1,0, "C");
		$pdf->Ln(5);		
	}
$pdf->Ln(15);
$pdf->Cell(0,0,"                           ".iconv('utf-8','iso-8859-1','Observação').": ".$dados['observacao'], 0,1);
$pdf->Ln(5);
$pdf->Cell(0,0,"                           Modo de Entrega: ".$dados['entrega'], 0,1);
$pdf->Ln(20);
$pdf->Cell(0,0,"____________________________________________________", 0,1, "C");
$pdf->Ln(5);
$pdf->Cell(0,0,utf8_decode(Oficial::PegaNomeOficial($dados['responsavel'])), 0,1, "C");
$pdf->Ln(5);
$pdf->Cell(0,0,utf8_decode(Oficial::PegaCargoIdOficial($dados['responsavel'])), 0,1, "C");
$pdf->Ln(60);
$pdf->Footer(40,0,RODAPE, 0,1);
$pdf->Output("Liberacao_".$dados['id_liberacao']."_".$dados['dataLibera'].".pdf","D");
?>
