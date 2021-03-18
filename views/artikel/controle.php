<?php
include('../../evr.php');

if ($_POST['act']=='insert') {
	try {
		
		$artikel=new artikel(); 
		$res = $artikel->insert();
		if ($res) {
			die('success');
		}
		die("Erreur");
		} catch (Exception $e) {
				die($e);
	}
}
elseif ($_POST['act']=='update') {
	try {
	
		$artikel=new artikel();
 		$artikel->update($_POST["id"]);
		die('success');
	} 
	catch (Exception $e) {
				die($e);
		
	}
}
elseif ($_POST['act']=='delete') {
	try {
		$artikel=new artikel();
		$artikel->delete($_POST["id"]);
		die('success');
		} catch (Exception $e) {
				die($e);
	}
}

?>