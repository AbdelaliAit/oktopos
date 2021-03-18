<?php 

include("eve.php");
$active = "";
if(isset($_POST['active']) && !empty($_POST['active'])) {
$sql = "update serial_code set code='" . $_POST['active'] . "' where id=0";
$result = connexion::getConnexion()->query($sql);
}
if(isset($_POST['login']) && isset($_POST['pwd'])) {
$sql = "select count(*) as nbr,user.* from user WHERE login= '" . htmlspecialchars(addslashes($_POST['login'] )) . "' AND pwd= '" .htmlspecialchars(addslashes( $_POST['pwd'] )) . "'";
$query = $result = connexion::getConnexion()->query($sql);
$result = $query->fetch(PDO::FETCH_OBJ);
if($result->nbr == 1) {
auth::login($result);





  header("Location:index.php");

} else {
$error = "Login oder Passwort ist falsch ! ";
}
}

?>
<!DOCTYPE html>
<html lang="en" style="opacity: 1">
    <head>
        <meta charset="UTF-8">
        <title>Oktopos </title>
        <?php include('includes/style.php') ;?>
        
        
    </head>
    <body class="background">
        <div class="fixed-background"></div>
        <main>
            <input type="hidden" name="active" value="<?php echo $active;?>">
            <div class="container">
                <div class="row h-100">
                    <div class="col-12 col-md-4 mx-auto my-auto">
                        <div class="card auth-card">
                           
                            <div class="form-side">
                                <?php if (isset($error)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                                    <strong>  <?php echo $error; ?></strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <br><br>
                                <?php } ?>
                                <span class="logo-single"></span>
                                
                                <h6 class="mb-4">Login</h6>
                                <form method="POST">
                                    
                                    <label class="form-group has-float-label mb-4">
                                        <input class="form-control" name="login">
                                        <span>Nutzername</span>
                                    </label>
                                    <label class="form-group has-float-label mb-4">
                                        <input class="form-control" type="password" placeholder="" name="pwd">
                                        <span>Passwort</span>
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#">Passwort vergaß ?</a>
                                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">Anmeldung</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <?php include("includes/script.php") ;?>
      
    </body>
</html>