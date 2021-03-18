<?php
include('../../evr.php');

if ($_POST['act']=='insert') {
	try {
		$_POST["id_user"] = auth::user()["id"] ;
		$einheit=new einheit(); 
		$res = $einheit->insert();
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
		$einheit=new einheit();
 		$einheit->update($_POST["id"]);
		die('success');
	} 
	catch (Exception $e) {
				die($e);
		
	}
}
elseif ($_POST['act']=='delete') {
	try {
		$einheit=new einheit();
		$einheit->delete($_POST["id"]);
		die('success');
		} catch (Exception $e) {
				die($e);
	}
}

?>