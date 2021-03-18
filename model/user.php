<?php
class user extends table{

protected $id;
protected $login;
protected $nom;
protected $prenom;
protected $pwd;
protected $privilege;
protected $email;
protected $idu;
protected $client;
protected $siuser;
protected $addbon;
protected $config;
protected $pda;
protected $conteneur;
protected $operation;
public function selectAllUtilisateur($moi){
$result=connexion::getConnexion()->query("select * from utilisateur where id <>'".$moi."' order by idu desc");
return $result->fetchAll(PDO::FETCH_OBJ);
}
}
?>