<?php include_once('core/Controller/Controller.php');
//include_once('/mod_ajuda/classe/Classe.Fornecedor.php');

    class tdapController extends Controller
    {

        /* index */
        public function Index(){
            include_once 'mod_ajuda/backEnd/View/tdap/index.php';
        }


        /* Cadastro de fornecedores */
        public function cadfornec(){
            include_once 'mod_ajuda/backEnd/View/tdap/cad_fornecedor.php';
        }
        /* Cadastro de fornecedores */
        public function editarForn(){
            include_once 'mod_ajuda/backEnd/View/tdap/editar_fornecedor.php';
        }
        
        /* Gravar registro */
        public function gravFornec(){
            
            $dados = Fornecedor::Cadastro($_POST);
            
            return $dados;   
        }
        
        /* atualiar registro */
        public function editFornec(){
            
            $dados = Fornecedor::Atualizar($_POST);
            
            return $dados;   
        }
        /* Cadastro Dispositivo */
        public function cadisp(){
            include_once 'mod_ajuda/backEnd/View/tdap/cad_disp.php';
        }
        
        /* Gravar Dispositivo */
        public function gravDisp(){
            
            $dados = Fornecedor::cDispositivo($_POST);
            return $dados;   
        }
        
        
        /* gravar Code */
        public function lerqr(){
            
            include_once 'mod_ajuda/backEnd/View/tdap/lerqr.php';
            
            //$dados = Fornecedor::cDispositivo($_POST);
            //return $dados;   
        }
        
    
        /* deletar Celular Autorizado*/
        public function deleteAutorizado(){
            $id = isset($_GET['id']) ? $_GET['id'] : "";
            
            if(Fornecedor::deleteCel($id)){
                
                print "<script> alert('Registro Deletado com Sucesso');";
                print "window.location.href = '".FuncaoBase::geraLink("ajuda", "tdap", "index")."';
                        </script>";
            }   
        }
        
        
        /* acesso pagina processamento */
        public function processar(){
            include_once 'mod_ajuda/backEnd/View/tdap/processar.php';
        }
        /* declaracao de conformidade */
        public function deConf(){
            include_once 'mod_ajuda/backEnd/View/conformidade/indexDconf.php';
        }
        
        /* processar arquivo sms modem*/
        public function processarsms(){

    $btn = isset($_POST['btnProcessa']) ? true : false;
    $post = $_POST;
    $files = $_FILES;
      
    if($btn) {

        $smsModel = fopen($files['file']['tmp_name'], 'r');

        $linha1 = array();

        //lê o conteúdo do arquivo
        while (!feof($smsModel)) {
            //Mostra uma linha do arquivo
            $linha = fgets($smsModel, 1024);
            $linha1[] = str_replace('"','', explode(",", $linha));
        }

        // Fecha arquivo aberto
        fclose($smsModel);
        array_shift($linha1);
        array_pop($linha1);
        
        //var_dump($linha1);
        //die();

        /*$linhaXls[] = array('Author', 'Phone', 'Content', 'Msg Type', 'Read', 'Date');
        foreach ($linha1 as $key => $value) {
            $linhaXls[] = array(str_replace("\"","",$value[1]), str_replace("\"","",$value[1]), str_replace("\"","",$value[2]), 1, 0, str_replace("\"","",$value[3]));
        }
        
        $nomeFileExcel = sys_get_temp_dir()."/Exportacao_SMS_QRCode".ucfirst($_GET['controller'])."_dia_".date("d")."_de_".date("m")."_de_".date("Y")."_".date("his").".xlsx";
        
        $writer = new XLSXWriter();
        $writer->writeSheet($linhaXls);
        $writer->writeToFile($nomeFileExcel);

        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"" . basename($nomeFileExcel) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize($nomeFileExcel)); //Remove
        ob_clean();
        flush();
        readfile($nomeFileExcel);
        }*/
        
        /** Error reporting */
        
$nomeFileExcel = sys_get_temp_dir()."/Exportacao_SMS_QRCode".ucfirst($_GET['controller'])."_dia_".date("d")."_de_".date("m")."_de_".date("Y")."_".date("his").".xls";

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once PATH."/plugins/PHPExcel-1.8/Classes/PHPExcel.php";


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

/*str_replace("\"","",$value[1]),
str_replace("\"","",$value[1]),
str_replace("\"","",$value[2]),
1,
0,
str_replace("\"","",$value[3])
 */

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Author')
            ->setCellValue('B1', 'Phone')
            ->setCellValue('C1', 'Content')
            ->setCellValue('D1', 'Msg Type')
            ->setCellValue('E1', 'Read')
            ->setCellValue('F1', 'Date');
$row =1;
foreach ($linha1 as $key => $value) {
    
    $row++;
    $autor = str_replace('"','',$value[1]);
    $phone = str_replace('"','',$value[1]);
    $content = str_replace('"','',$value[2]);
    $date1 = str_replace('"','',$value[3]);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueExplicit('A'.($row), $autor)
            ->setCellValueExplicit('B'.($row), $phone)
            ->setCellValueExplicit('C'.($row), $content)
            ->setCellValueExplicit('D'.($row), 1)
            ->setCellValueExplicit('E'.($row), 0)
            ->setCellValueExplicit('F'.($row), $date1);

}

// Miscellaneous glyphs, UTF-8
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Plan1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.basename($nomeFileExcel).'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
        
    }
        }
        
        

}