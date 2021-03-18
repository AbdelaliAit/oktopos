<?php

class warenbewegungen extends table {

  
	protected $id ;
	protected $zeitpunkt ;
	protected $art ;
	protected $id_lager ;
	protected $id_artikel ;
	protected $menge ;
	protected $id_einheit ;
	protected $created_at ;
	protected $updated_at ;



public function selectAllbyclient($id){

	$result=connexion::getConnexion()->query("SELECT  * FROM conteneur 
		where id_client=".$id." order by id_conteneur desc");
	return $result->fetchAll(PDO::FETCH_OBJ);
	} 	

	public function selectAllbyCodeTag($code){

		$result=connexion::getConnexion()->query("SELECT  * FROM conteneur 
			where trim(code_tag)= trim('".$code."') ");

			if($result->fetch(PDO::FETCH_OBJ) !=null)
			{
				return "yes";
			}
			else{
				return "no";
			}
		 
		} 

		public function selectAllbyCodeC($code){

			$result=connexion::getConnexion()->query("SELECT  * FROM conteneur 
				where trim(code_id_conteneur)= trim('".$code."') ");
	
				if($result->fetch(PDO::FETCH_OBJ) !=null)
				{
					return "yes";
				}
				else{
					return "no";
				}
			 
			} 

	public function selectanything($array){


		$id = $array['rech'] ;


		$wheredate ="";
		if ($array['date']!=null ) {
			$wheredate = "and (    '".$array['date']."' between  date_add and   date_add_2 )";
		}

	$id_local = $array['id_local'];
	$id_allee = $array['id_allee'];
	$id_face = $array['id_face'];
	$id_niveau = $array['id_niveau'];
	$id_entrepot = $array['id_entrepot'];
	$id_alveole = $array['id_alveole'];
	
	$idclient = $array['id_client'];
	if($id_local != '0') {
	   $wheredate .= " and id_local =  '$id_local' ";
	}
	if($id_allee != '0') {
	   $wheredate .= " and id_allee =  '$id_allee' ";
	}
	if($id_face != '0') {
	   $wheredate .= " and id_face =  '$id_face' ";
	}
	if($id_niveau != '0') {
	   $wheredate .= " and id_niveau =  '$id_niveau' ";
	}
	if($id_entrepot != '0') {
	   $wheredate .= " and id_entrepot =  '$id_entrepot' ";
	}
	if($id_alveole != '0') {
	   $wheredate .= " and id_alveole =  '$id_alveole' ";
	}

	
 

	$result=connexion::getConnexion()->query("SELECT  * FROM conteneur 
		where id_client=".$idclient."  and (code_tag like '%".$id."%' or code_conteneur like '%".$id."%'  or code_emplacement like '%".$id."%' ) $wheredate order by id_conteneur desc");
	return $result->fetchAll(PDO::FETCH_OBJ);
	} 


}

?>