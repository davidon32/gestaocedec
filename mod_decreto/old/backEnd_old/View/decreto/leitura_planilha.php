<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';

require_once PATH."/plugins/PHPExcel-1.8/Classes/PHPExcel.php";

$fileName = PATH."/mod_decreto/app/decreto/decretos.xlsx";

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($fileName);


$teste = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

var_dump($teste);

foreach ($teste as $key=>$value){
	
	if($key > 1){
		
		//print $value['A']."<br>";
		//print $value['B']."<br>";
		
	}
	
	
}


//$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);



?>