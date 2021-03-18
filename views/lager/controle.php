<?php
include('../../evr.php');

if ($_POST['act']=='insert') {
	try {
		$_POST["id_user"] = auth::user()["id"] ;
		$lager=new lager(); 
		$res = $lager->insert();
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
		$_POST["id_user"] = auth::user()["id"] ;       
		$lager=new lager();
 		$lager->update($_POST["id"]);
		die('success');
	} 
	catch (Exception $e) {
				die($e);
		
	}
}
elseif ($_POST['act']=='delete') {
	try {
		$lager=new lager();
		$lager->delete($_POST["id"]);
		die('success');
		} catch (Exception $e) {
				die($e);
	}
}

?>