<?php
class auth {

		  
	 public static function user()
	 {      
	 	if (isset($_SESSION['login__'])) {
	 	
	 	$user = array(

	 		"id" => $_SESSION['id__'],
			"login"  => $_SESSION['login__'],                         
			"nom"  => $_SESSION['nom__'],                           
			"prenom"  => $_SESSION['prenom__'],                        
			"pwd"  => $_SESSION['pwd__'],                           
			"privilege"  => $_SESSION['privilege__'],                     
			"email"  => $_SESSION['email__'],                         
			"idu"  => $_SESSION['idu__'],                           
			"client"  => $_SESSION['client__'],                        
			"siuser"  => $_SESSION['siuser__'],                        
			"addbon"  => $_SESSION['addbon__'],                        
			"config"  => $_SESSION['config__'],                        
			"pda"  => $_SESSION['pda__'],                           
			"conteneur"  => $_SESSION['conteneur__'],                     
			"operation"  => $_SESSION['operation__'],                     
		);

	 	return $user;
	 
	 	}
	 	return null;
	 }


	public static function login($user)
	 {      

	 	    
			$_SESSION['id__']=$user->id;
			$_SESSION['login__']=$user->login;
			$_SESSION['nom__']=$user->nom;
			$_SESSION['prenom__']=$user->prenom;
			$_SESSION['pwd__']=$user->pwd;
			$_SESSION['privilege__']=$user->privilege;
			$_SESSION['email__']=$user->email;
			$_SESSION['idu__']=$user->idu;
			$_SESSION['client__']=$user->client;
			$_SESSION['siuser__']=$user->siuser;
			$_SESSION['addbon__']=$user->addbon;
			$_SESSION['config__']=$user->config;
			$_SESSION['pda__']=$user->pda;
			$_SESSION['conteneur__']=$user->conteneur;
			$_SESSION['operation__']=$user->operation;

	 }

	
	public static function logout()
	 {  
            
                unset($_SESSION['id__']);
  				unset($_SESSION['login']);
  				unset($_SESSION['nom']);
  				unset($_SESSION['prenom']);
  				unset($_SESSION['pwd']);
  				unset($_SESSION['privilege']);
  				unset($_SESSION['email']);
  				unset($_SESSION['idu']);
  				unset($_SESSION['client']);
  				unset($_SESSION['siuser']);
  				unset($_SESSION['addbon']);
  				unset($_SESSION['config']);
  				unset($_SESSION['pda']);
  				unset($_SESSION['conteneur']);
  				unset($_SESSION['operation']);




	 }
 


}