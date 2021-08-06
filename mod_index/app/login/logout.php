<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	include_once 'include.php';

	if(session_id()){
	    
	    session_unset();   
	    print "<script type='text/javascript'>
	            window.location = 'index.php';
	            </script>";
	}else {
	    
	    print "<script type='text/javascript'>
	            window.location = 'index.php';
	            </script>";
	}

?>